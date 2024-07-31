<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Lesson;
use App\Rules\AtLeastOneCheckboxSelected;
use Illuminate\Http\Request;

class TeacherLessonController extends Controller
{
    function teacher_lesson_index()
    {

        $grade = auth()->guard('teacher')->user()->grade;
        $lessons = Lesson::where('grade', $grade)->get();
        foreach ($lessons as $lesson) {
            $lesson->title = substr($lesson->title, 0, 60) . '...';
            $lesson->description = substr($lesson->description, 0, 40) . '...';
        }
        return view('teacher.lesson.index', compact('lessons'));
    }

    function teacher_lesson_add()
    {

        return view('teacher.lesson.add');
    }

    function teacher_lesson_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'state' => 'required',
        ]);
        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->grade = $request->grade;
        $lesson->teacher_id = auth()->guard('teacher')->user()->id;

        if ($request->has_uploads == 'ON' || $request->has_uploads == true) {
            $lesson->has_uploads = 1;
            $lesson->file_types = json_encode($request->input('file_types', []));
        } else {
            $lesson->has_uploads = 0;
            $lesson->file_types = '';
        }
        $lesson->state = $request->state;
        $lesson->save();
        return redirect()->route('teacher_lesson_index')->with('success', 'Lesson added successfully');
    }

    function teacher_lesson_edit($id)
    {

        $grade = auth()->guard('teacher')->user()->grade;
        $lesson = Lesson::where('grade', $grade)->find($id);
        return view('teacher.lesson.edit', compact('lesson'));
    }

    function teacher_lesson_update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'grade' => 'required',
            'state' => 'required',
        ]);

        $lesson = Lesson::find($request->id);
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->grade = $request->grade;
        $lesson->teacher_id = auth()->guard('teacher')->user()->id;
        if ($request->has_uploads == 'ON' || $request->has_uploads == true) {
            $lesson->has_uploads = 1;
            $lesson->file_types = json_encode($request->input('file_types', []));
        } else {
            $lesson->has_uploads = 0;
            $lesson->file_types = '';
        }
        $lesson->state = $request->state;
        $lesson->save();
        return redirect()->route('teacher_lesson_index')->with('success', 'Lesson updated successfully');
    }

    function teacher_lesson_delete(Request $request)
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $lesson = Lesson::where('grade', $grade)->find($request->id);
        if ($lesson) {
            AppHelper::deleteLessonAssets($lesson);
            $lesson->delete();
        }
        return response()->json(['status' => 'success', 'deleted' => true]);
    }

    function teacher_lesson_activity_index(Request $request)
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $lesson = Lesson::where('grade', $grade)->find($request->id);
        $activities = Activity::where('lesson_id', $lesson->id)->with('student')->get();

        return view('teacher.lesson.activity', compact('activities', 'lesson'));
    }

    function teacher_lesson_activity_delete(Request $request)
    {
        $activity = Activity::find($request->id);
        if ($activity) {
            $asset_path = public_path('uploads/activities/' . $activity->uploads);
            if (file_exists($asset_path)) {
                unlink($asset_path);
            }
            $activity->delete();
        }
        return response()->json(['status' => 'success', 'deleted' => true]);
    }
}
