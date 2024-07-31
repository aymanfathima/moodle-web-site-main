<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherStudentController extends Controller
{
    function teacher_student_index()
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $students = Student::where('grade', $grade)->get();
        return view('teacher.student.index', compact('students'));
    }

    function teacher_student_add()
    {
        return view('teacher.student.add');
    }

    function teacher_student_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'parent_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
        ]);
        $student = new Student();
        $student->email = $request->email;
        $student->password = bcrypt($request->password);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->parent_name = $request->parent_name;
        $student->grade = auth()->guard('teacher')->user()->grade;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->profile_picture = 'user.png';
        $student->created_by = auth()->guard('teacher')->user()->id;
        $student->created_by_role = 2;
        $student->state = $request->state;
        $student->save();
        return redirect()->route('teacher_student_index')->with('success', 'Student added successfully');
    }

    function teacher_student_edit(Request $request)
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $student = Student::where('grade', $grade)->find($request->id);
        return view('teacher.student.edit', compact('student'));
    }

    function teacher_student_update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email,' . $request->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'parent_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'state' => 'required',
        ]);
        $student = Student::find($request->id);
        $student->email = $request->email;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->parent_name = $request->parent_name;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect()->route('teacher_student_index')->with('success', 'Student updated successfully');
    }

    function teacher_student_delete(Request $request)
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $student = Student::where('grade', $grade)->find($request->id);
        AppHelper::deleteStudent($student->id);
        return response()->json(['status' => 'success', 'deleted' => true]);
    }
}
