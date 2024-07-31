<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class TeacherQuestionController extends Controller
{

    public function teacher_question_index(Request $request)
    {
        $id = $request->id;
        $questions = Question::where('quiz_id', $id)->get();
        return view('teacher.question.index', compact('id', 'questions'));
    }

    public function teacher_question_add(Request $request)
    {
        $id = $request->id;
        return view('teacher.question.add', compact('id'));
    }

    public function teacher_question_store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required',
        ]);

        $question = new Question();
        $question->quiz_id = $request->quiz_id;
        $question->question = $request->question;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->answer = $request->answer;
        $question->state = 1;
        $question->save();

        return redirect()->route('teacher_question_add', ['id' => $request->quiz_id])->with('success', 'Question added successfully');
    }

    public function teacher_question_edit(Request $request)
    {
        $question = Question::find($request->id);
        return view('teacher.question.edit', compact('question'));
    }

    public function teacher_question_update(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required',
        ]);

        $question = Question::find($request->id);
        $question->question = $request->question;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->answer = $request->answer;
        $question->save();

        return redirect()->route('teacher_question_index', ['id' => $question->quiz_id])->with('success', 'Question updated successfully');
    }

    public function teacher_question_delete(Request $request)
    {
        $question = Question::find($request->id);
        AppHelper::deleteQuestion($question->id);
        return response()->json(['status' => 'success', 'deleted' => true]);
    }
}
