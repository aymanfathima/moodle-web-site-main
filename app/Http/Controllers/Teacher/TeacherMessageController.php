<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherMessageController extends Controller
{
    function teacher_message_index()
    {
        $userId = auth()->guard('teacher')->user()->id;
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->where('sender_role', 'Teacher')
                ->orWhere('receiver_id', $userId)->where('receiver_role', 'Teacher');
        })->orderBy('created_at', 'desc')->get();

        $userList = [];
        foreach ($messages as $message) {
            $user = null;

            if ($message->sender_id == $userId && $message->sender_role == 'Teacher') {
                if ($message->receiver_role === 'Admin') {
                    $user = Admin::find($message->receiver_id);
                } elseif ($message->receiver_role === 'Teacher') {
                    $user = Teacher::find($message->receiver_id);
                } elseif ($message->receiver_role === 'Student') {
                    $user = Student::find($message->receiver_id);
                }
                $user->role = $message->receiver_role;
            } else {
                if ($message->sender_role === 'Admin') {
                    $user = Admin::find($message->sender_id);
                } elseif ($message->sender_role === 'Teacher') {
                    $user = Teacher::find($message->sender_id);
                } elseif ($message->sender_role === 'Student') {
                    $user = Student::find($message->sender_id);
                }
                $user->role = $message->sender_role;
            }

            $exists = false;
            foreach ($userList as $u) {
                if ($u[0]->id === $user->id && $u[0]->role === $user->role) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $userList[] = [$user];
            }

            if (count($userList) > 5) {
                break;
            }
        }
        return view('teacher.message', compact('userList'));
    }
}
