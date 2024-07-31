<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    function admin_teacher_index()
    {

        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers'));
    }

    function admin_teacher_add()
    {

        return view('admin.teacher.add');
    }

    function admin_teacher_store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'grade' => 'required',
            'state' => 'required',
        ]);

        $teacher = new Teacher();
        $teacher->email = $request->email;
        $teacher->password = bcrypt($request->password);
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->phone = $request->phone;
        $teacher->address = $request->address;
        $teacher->profile_picture = 'user.png';
        $teacher->grade = $request->grade;
        $teacher->state = $request->state;
        $teacher->save();

        return redirect()->route('admin_teacher_index')->with('success', 'Teacher added successfully');
    }

    function admin_teacher_edit(Request $request)
    {

        $teacher = Teacher::find($request->id);
        return view('admin.teacher.edit', compact('teacher'));
    }

    function admin_teacher_update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:teachers,email,' . $request->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'grade' => 'required',
            'state' => 'required',
        ]);

        $teacher = Teacher::find($request->id);
        $teacher->email = $request->email;
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->phone = $request->phone;
        $teacher->address = $request->address;
        $teacher->grade = $request->grade;
        $teacher->state = $request->state;
        $teacher->save();

        return redirect()->route('admin_teacher_index')->with('success', 'Teacher updated successfully');
    }

    function admin_teacher_delete(Request $request)
    {

        $teacher = Teacher::find($request->id);
        AppHelper::deleteTeacher($teacher->id);
        return response()->json(['status' => 'success', 'deleted' => true]);
    }
}
