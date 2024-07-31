<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    function admin_student_index()
    {

        $students = Student::all();
        return view('admin.student.index', compact('students'));
    }

    function admin_student_add()
    {

        return view('admin.student.add');
    }

    function admin_student_store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'grade' => 'required|numeric|digits:1',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|string|max:255',
            'state' => 'required|numeric|digits:1',
        ]);

        $student = new Student();
        $student->email = $request->email;
        $student->password = bcrypt($request->password);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->parent_name = $request->parent_name;
        $student->grade = $request->grade;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->profile_picture = 'user.png';
        $student->created_by = auth()->guard('admin')->user()->id;
        $student->created_by_role = 1;
        $student->state = $request->state;
        $student->save();

        return redirect()->route('admin_student_index')->with('success', 'Student added successfully');
    }

    function admin_student_edit(Request $request)
    {

        $student = Student::find($request->id);
        return view('admin.student.edit', compact('student'));
    }

    function admin_student_update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email,' . $request->id,
            'password' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->filled('password')) {
                        if (strlen($value) < 6) {
                            $fail('The password must have a minimum of 6 characters.');
                        }
                    }
                },
            ],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'grade' => 'required|numeric|digits:1',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|string|max:255',
            'state' => 'required|numeric|digits:1',
        ]);

        $student = Student::find($request->id);
        $student->email = $request->email;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->parent_name = $request->parent_name;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect()->route('admin_student_index')->with('success', 'Student updated successfully');
    }

    function admin_student_delete(Request $request)
    {
        $student = Student::find($request->id);
        AppHelper::deleteStudent($student->id);
        return response()->json(['status' => 'success', 'deleted' => true]);
    }
}
