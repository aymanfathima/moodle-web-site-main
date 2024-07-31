<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherQuizController extends Controller
{
    public function teacher_quiz_index()
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $quizzes = Quiz::where('grade', $grade)->get();
        return view('teacher.quiz.index', compact('quizzes'));
    }

    public function teacher_quiz_add()
    {
        return view('teacher.quiz.add');
    }

    public function teacher_quiz_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'end_date' => 'required',
            'attempts' => 'required',
        ]);

        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->grade = $request->grade;
        $quiz->end_date = $request->end_date;
        $quiz->attempts = $request->attempts;
        $quiz->state = $request->state;
        $quiz->save();

        return redirect()->route('teacher_quiz_index')->with('success', 'Quiz added successfully');
    }

    public function teacher_quiz_edit($id)
    {
        $quiz = Quiz::find($id);
        return view('teacher.quiz.edit', compact('quiz'));
    }

    public function teacher_quiz_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'end_date' => 'required',
            'attempts' => 'required',
        ]);

        $quiz = Quiz::find($request->id);
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->grade = $request->grade;
        $quiz->end_date = $request->end_date;
        $quiz->attempts = $request->attempts;
        $quiz->state = $request->state;
        $quiz->save();

        return redirect()->route('teacher_quiz_index')->with('success', 'Quiz updated successfully');
    }

    public function teacher_quiz_delete($id)
    {
        $quiz = Quiz::find($id);
        AppHelper::deleteQuiz($quiz->id);
        return response()->json(['status' => 'success', 'deleted' => true]);
    }

    public function teacher_quiz_result(Request $request)
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

        return view('teacher.quiz.results', compact('students', 'quiz'));
    }
}
