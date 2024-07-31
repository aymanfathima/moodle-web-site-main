<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Notice;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    function teacher_dashboard()
    {
        $notices = Notice::where('start_date', '<=', date('Y-m-d H:i:s'))->where('end_date', '>=', date('Y-m-d H:i:s'))->get();

        $grade = auth()->guard('teacher')->user()->grade;

        $st_count = Student::where('grade', $grade)->count();
        $q_count = Quiz::where('grade', $grade)->count();
        $l_count = Lesson::where('grade', $grade)->count();

        return view('teacher.dashboard', compact('notices', 'st_count', 'q_count', 'l_count'));
    }

    function teacher_profile()
    {

        $teacher = auth()->guard('teacher')->user();
        return view('teacher.profile', compact('teacher'));
    }

    function teacher_profile_update(Request $request)
    {
        $teacher_id = auth()->guard('teacher')->user()->id;
        $teacher = Teacher::find($teacher_id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'required',
        ]);

        if ($request->hasFile('upload_image')) {
            $image = $request->file('upload_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            if ($teacher->profile_picture != 'user.png') {
                $image_path = public_path('uploads/profiles/' . $teacher->profile_picture);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $image->move(public_path('uploads/profiles'), $image_name);
            $teacher->profile_picture = $image_name;
        }
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->address = $request->address;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    function teacher_change_password(Request $request)
    {
        $teacher_id = auth()->guard('teacher')->user()->id;
        $teacher = Teacher::find($teacher_id);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (password_verify($request->old_password, $teacher->password)) {
            $teacher->password = bcrypt($request->password);
            $teacher->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }
    }
}
