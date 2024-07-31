<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Answers;
use App\Models\ContactUs;
use App\Models\Lesson;
use App\Models\Notice;
use App\Models\Payment;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function admin_dashboard()
    {
        $notices = Notice::where('start_date', '<=', date('Y-m-d H:i:s'))->where('end_date', '>=', date('Y-m-d H:i:s'))->get();

        $st_count = Student::count();
        $t_count = Teacher::count();
        $q_count = Quiz::count();
        $l_count = Lesson::count();
        $t_income = Payment::sum('amount');
        return view('admin.dashboard', compact('notices', 'st_count', 't_count', 'q_count', 'l_count', 't_income'));
    }

    function admin_profile()
    {
        $admin = auth()->guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    function admin_profile_update(Request $request)
    {
        $admin_id = auth()->guard('admin')->user()->id;
        $admin = Admin::find($admin_id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'required',
        ]);

        if ($request->hasFile('upload_image')) {
            $image = $request->file('upload_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            if ($admin->profile_picture != 'user.png') {
                $image_path = public_path('uploads/profiles/' . $admin->profile_picture);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image->move(public_path('uploads/profiles'), $image_name);
            $admin->profile_picture = $image_name;
        }
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->address = $request->address;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    function admin_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'current_password' => 'required|min:6',
        ]);

        $admin_id = auth()->guard('admin')->user()->id;
        $admin = Admin::find($admin_id);

        if (!password_verify($request->current_password, $admin->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        $admin->password = bcrypt($request->password);
        $admin->save();
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    function admin_quiz_index()
    {
        try {
            $quizzes = Quiz::all();
            return view('admin.quiz.index', compact('quizzes'));
        } catch (\Exception $e) {
            AppHelper::instance()->s_log($e->getMessage(), "index", "Admin");
        }
    }

    function admin_quiz_result(Request $request)
    {
        $quiz = Quiz::find($request->id);
        $students = Student::where('grade', $quiz->grade)->get();
        $answers = Answers::where('quiz_id', $quiz->id)->with('student')->get();

        foreach ($students as $student) {
            $student->answer = null;
            foreach ($answers as $answer) {
                if ($answer->student_id == $student->id) {
                    $student->answer = $answer;
                    break;
                }
            }
        }

        $students = $students->sortByDesc(function ($student) {
            return $student->answer->precentage ?? 0;
        });

        return view('admin.quiz.results', compact('students', 'quiz'));
    }

    function admin_quiz_question(Request $request)
    {
        $questions = Question::where('quiz_id', $request->id)->get();
        return view('admin.quiz.questions', compact('questions'));
    }

    function admin_payment_index()
    {

        $payments = Payment::all();
        return view('admin.payment.index', compact('payments'));
    }

    function admin_contact_us_index()
    {

        $contacts = ContactUs::all();
        return view('admin.contact', compact('contacts'));
    }
}
