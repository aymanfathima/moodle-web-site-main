<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function get_all_users(Request $request)
    {

        $adminUsers = [];
        $teacherUsers = [];
        $studentUsers = [];

        if ($request->search != null) {
            $adminUsers =  Admin::where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhereRaw('CONCAT(first_name, " ", last_name) like ?', ['%' . $request->search . '%'])
                ->get();
            $teacherUsers = Teacher::where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhereRaw('CONCAT(first_name, " ", last_name) like ?', ['%' . $request->search . '%'])
                ->get();
            $studentUsers = Student::where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhereRaw('CONCAT(first_name, " ", last_name) like ?', ['%' . $request->search . '%'])
                ->get();
        } else {
            $adminUsers =  Admin::all();
            $teacherUsers = Teacher::all();
            $studentUsers = Student::all();
        }

        $user = [];
        foreach ($adminUsers as $adminUser) {
            $user[] = [
                'id' => $adminUser->id,
                'name' => $adminUser->first_name . ' ' . $adminUser->last_name,
                'image' => asset('uploads/profiles/' . $adminUser->profile_picture),
                'email' => $adminUser->email,
                'role' => 'Admin'
            ];
        }
        foreach ($teacherUsers as $teacherUser) {
            $user[] = [
                'id' => $teacherUser->id,
                'name' => $teacherUser->first_name . ' ' . $teacherUser->last_name,
                'image' => asset('uploads/profiles/' . $teacherUser->profile_picture),
                'email' => $teacherUser->email,
                'role' => 'Teacher'
            ];
        }
        foreach ($studentUsers as $studentUser) {
            $user[] = [
                'id' => $studentUser->id,
                'name' => $studentUser->first_name . ' ' . $studentUser->last_name,
                'image' =>  asset('uploads/profiles/' . $studentUser->profile_picture),
                'email' => $studentUser->email,
                'role' => 'Student'
            ];
        }
        return response()->json($user);
    }

    public function get_user_messages(Request $request)
    {
        $uid = $request->id;
        $srole = $request->srole;
        $guard = AppHelper::getGuard($request->urole);
        $userId = auth()->guard($guard)->user()->id;
        $urole = $request->urole;
        $messages = Message::selectRaw('*, CASE
                WHEN receiver_id = ? AND receiver_role = ? THEN "received"
                ELSE "sent"
                END AS type', [$userId, $urole])
            ->where(function ($query) use ($uid, $userId, $srole, $urole) {
                $query->where('sender_id', $uid)->where('sender_role', $srole)->where('receiver_id', $userId)->where('receiver_role', $urole)
                    ->orWhere(function ($query) use ($uid, $userId, $srole, $urole) {
                        $query->where('receiver_id', $uid)->where('receiver_role', $srole)->where('sender_id', $userId)->where('sender_role', $urole);
                    });
            })
            ->get();
        return response()->json($messages);
    }

    public function send_message(Request $request)
    {
        $message = new Message();
        $guard = AppHelper::getGuard($request->sender_role);
        $message->sender_id = auth()->guard($guard)->user()->id;
        $message->receiver_id = $request->receiver_id;
        $message->receiver_role = $request->receiver_role;
        $message->sender_role = $request->sender_role;
        $message->message = $request->message;
        $message->save();
        $message->type = 'sent';
        return response()->json($message);
    }

    public function send_msg_all_students(Request $request)
    {
        $guard = AppHelper::getGuard($request->sender_role);

        $students = null;

        if ($guard == 'admin') {
            $students = Student::all();
        } else if ($guard == 'teacher') {
            $students = Student::where('grade', auth()->guard($guard)->user()->grade)->get();
        }
        foreach ($students as $student) {
            $message = new Message();
            $message->sender_id = auth()->guard($guard)->user()->id;
            $message->receiver_id = $student->id;
            $message->receiver_role = 'Student';
            $message->sender_role = $request->sender_role;
            $message->message = $request->message;
            $message->save();
        }

        return response()->json(['state' => 'success']);
    }

    public function send_msg_all_teachers(Request $request)
    {
        $guard = AppHelper::getGuard($request->sender_role);

        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            $message = new Message();
            $message->sender_id = auth()->guard($guard)->user()->id;
            $message->receiver_id = $teacher->id;
            $message->receiver_role = 'Teacher';
            $message->sender_role = $request->sender_role;
            $message->message = $request->message;
            $message->save();
        }

        return response()->json(['state' => 'success']);
    }
}
