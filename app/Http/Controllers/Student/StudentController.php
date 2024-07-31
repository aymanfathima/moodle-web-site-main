<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Answers;
use App\Models\Lesson;
use App\Models\Notice;
use App\Models\Quiz;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    function student_dashboard()
    {
        $notices = Notice::where('start_date', '<=', date('Y-m-d H:i:s'))->where('end_date', '>=', date('Y-m-d H:i:s'))->get();
        return view('student.dashboard', compact('notices'));
    }

    function student_profile()
    {
        $student = auth()->guard('student')->user();
        return view('student.profile', compact('student'));
    }

    function student_profile_update(Request $request)
    {
        $student_id = auth()->guard('student')->user()->id;
        $student = Student::find($student_id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'parent_name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required',
        ]);

        if ($request->hasFile('upload_image')) {
            $image = $request->file('upload_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            if ($student->profile_picture != 'user.png') {
                $image_path = public_path('uploads/profiles/' . $student->profile_picture);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image->move(public_path('uploads/profiles'), $image_name);
            $student->profile_picture = $image_name;
        }
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->parent_name = $request->parent_name;
        $student->address = $request->address;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    function student_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'current_password' => 'required|min:6',
        ]);

        $student_id = auth()->guard('student')->user()->id;
        $student = Student::find($student_id);

        if (!password_verify($request->current_password, $student->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        $student->password = bcrypt($request->password);
        $student->save();
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    function student_learning_index()
    {
        $grade = auth()->guard('student')->user()->grade;
        $lessons = Lesson::where('grade', $grade)->with('assets')->get();
        $activity = Activity::where('student_id', auth()->guard('student')->user()->id)->get();
        return view('student.learning.index', compact('lessons', 'activity'));
    }

    function student_lesson_upload(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
        ]);
        $lesson = Lesson::find($request->lesson_id);
        $student_id = auth()->guard('student')->user()->id;

        if (strpos($lesson->file_types, 'doc')) {
            $request->validate([
                'upload_file' => 'required|mimes:pdf',
            ]);
        } else if (strpos($lesson->file_types,  'image')) {
            $request->validate([
                'upload_file' => 'required|mimes:jpeg,png,jpg',
            ]);
        } else if (strpos($lesson->file_types,  'zip')) {
            $request->validate([
                'upload_file' => 'required|mimes:zip',
            ]);
        }
        $activity = new Activity();
        $activity->student_id = $student_id;
        $activity->lesson_id = $request->lesson_id;

        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/activities'), $file_name);
            $activity->uploads = $file_name;
        }
        $activity->save();
        return redirect()->back()->with('success', 'Activity uploaded successfully');
    }

    function student_calender_index(Request $request)
    {

        $quizzes = Quiz::where('grade', auth()->guard('student')->user()->grade)->get();

        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');
        $currentMonth = $month;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $year);
        $firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $year);
        $dayOfWeek = date('w', $firstDayOfMonth);
        $calendar = [];
        $week = [];
        for ($i = 0; $i < $dayOfWeek; $i++) {
            $week[] = ['day' => '', 'currentMonth' => false, 'qdeadline' => false, 'quiz' => false];
        }
        for ($day = 1; $day <= $daysInMonth; $day++) {
            if (count($week) == 7) {
                $calendar[] = $week;
                $week = [];
            }
            $qdeadline = $quizzes->contains('end_date', Carbon::createFromFormat('Y-m-d', "$year-$currentMonth-$day")->format('Y-m-d'));
            $quiz = $quizzes->where('end_date', Carbon::createFromFormat('Y-m-d', "$year-$currentMonth-$day")->format('Y-m-d'))->first();
            $tooltip = '';
            $week[] = ['day' => $day, 'currentMonth' => true, 'qdeadline' => $qdeadline, 'quiz' => $quiz];
        }
        if (count($week) > 0) {
            while (count($week) < 7) {
                $week[] = ['day' => '', 'currentMonth' => false, 'qdeadline' => false, 'quiz' => false];
            }
            $calendar[] = $week;
        }
        $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1, $year));
        return view('student.calender', compact('calendar', 'monthName', 'year', 'month'));
    }

    function student_payment_index()
    {
        $student = auth()->guard('student')->user();
        $payments = $student->payments;
        return view('student.payment', compact('payments'));
    }


    function student_quiz_index()
    {
        $grade = auth()->guard('student')->user()->grade;
        $quizzes = Quiz::where('grade', $grade)->get();
        $answers = Answers::where('student_id', Auth::guard('student')->user()->id)->get();
        return view('student.quiz.index', compact('quizzes', 'answers'));
    }

    function student_quiz_start(Request $request)
    {
        $quiz = Quiz::where('id', $request->id)->with('questions')->first();
        return view('student.quiz.attempt', compact('quiz'));
    }

    function student_quiz_submit(Request $request)
    {
        $answer = Answers::where('student_id', Auth::guard('student')->user()->id)->where('quiz_id', $request->quiz_id)->first();
        $quiz = Quiz::where('id', $request->quiz_id)->with('questions')->first();
        if ($answer) {
            return view('student.quiz.result', compact('answer', 'quiz'));
        }
        $total_questions = count($quiz->questions);
        $correct_answers = 0;
        foreach ($quiz->questions as $question) {
            $request->validate([
                'question_' . $question->id => 'required'
            ]);
            if ($request->input('question_' . $question->id) == $question->answer) {
                $correct_answers++;
            }
        }
        $precentage = ($correct_answers / $total_questions) * 100;
        $quiz_result = [];
        foreach ($quiz->questions as $question) {
            $quiz_result['q' . $question->id] = [
                'correct' => (int)$question->answer,
                'given' => (int)$request->input('question_' . $question->id),
                'result' => $question->answer == $request->input('question_' . $question->id) ? 1 : 0
            ];
        }
        $quiz_result = json_encode($quiz_result);
        $answer = Answers::create([
            'student_id' => Auth::guard('student')->user()->id,
            'quiz_id' => $request->quiz_id,
            'answers' => $quiz_result,
            'precentage' => $precentage
        ]);
        return view('student.quiz.result', compact('answer', 'quiz'));
    }

    function student_quiz_result(Request $request)
    {
        $answer = Answers::where('student_id', Auth::guard('student')->user()->id)->where('quiz_id', $request->id)->first();
        $quiz = Quiz::where('id', $request->id)->with('questions')->first();
        return view('student.quiz.result', compact('answer', 'quiz'));
    }
}
