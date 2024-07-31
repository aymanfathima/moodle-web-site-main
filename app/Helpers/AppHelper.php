<?php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\Answers;
use App\Models\Lesson;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\SiteLog;
use App\Models\Student;
use App\Models\Teacher;

class AppHelper
{
    public function s_log($s_msg, $func, $cont)
    {
        SiteLog::create([
            'short_message' => $s_msg,
            'function' => $func,
            'controller' => $cont,
        ]);
    }

    public static function instance()
    {
        return new AppHelper();
    }

    public static function deleteLessonAssets($lesson)
    {
        $assets = $lesson->assets;

        foreach ($assets as $asset) {
            $asset_path = public_path($asset->link);
            if (file_exists($asset_path)) {
                unlink($asset_path);
            }
            $asset->delete();
        }
        if ($lesson->has_uploads == 1) {
            $activities = $lesson->activities;

            foreach ($activities as $activity) {
                $asset_path = public_path('uploads/activities/' . $activity->uploads);
                if (file_exists($asset_path)) {
                    unlink($asset_path);
                }
                $activity->delete();
            }
        }
    }

    public static function getGuard()
    {
        $guard = null;
        if (auth()->guard('admin')->check()) {
            $guard = 'admin';
        } elseif (auth()->guard('teacher')->check()) {
            $guard = 'teacher';
        } elseif (auth()->guard('student')->check()) {
            $guard = 'student';
        }
        return $guard;
    }

    public static function deleteStudent($id)
    {
        $student = Student::find($id);
        $messages = Message::where('sender_id', $student->id)->where('sender_role', 'Student')
            ->orWhere('receiver_id', $student->id)->where('receiver_role', 'Student')->get();
        foreach ($messages as $message) {
            $message->delete();
        }
        $activities = Activity::where('student_id', $student->id)->get();
        foreach ($activities as $activity) {
            $asset_path = public_path('uploads/activities/' . $activity->uploads);
            if (file_exists($asset_path)) {
                unlink($asset_path);
            }
            $activity->delete();
        }
        $answers = Answers::where('student_id', $student->id)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $payments = Payment::where('student_id', $student->id)->get();
        foreach ($payments as $payment) {
            $payment->delete();
        }
        $student->delete();
    }

    public static function deleteTeacher($id)
    {
        $teacher = Teacher::find($id);
        $messages = Message::where('sender_id', $teacher->id)->where('sender_role', 'Teacher')
            ->orWhere('receiver_id', $teacher->id)->where('receiver_role', 'Teacher')->get();
        foreach ($messages as $message) {
            $message->delete();
        }
        $lessons = Lesson::where('teacher_id', $teacher->id)->get();
        foreach ($lessons as $lesson) {
            AppHelper::deleteLessonAssets($lesson);
            $lesson->delete();
        }
        $teacher->delete();
    }

    public static function deleteQuiz($id)
    {
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id', $quiz->id)->get();
        foreach ($questions as $question) {
            $question->delete();
        }
        $answers = Answers::where('quiz_id', $quiz->id)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $quiz->delete();
    }

    public static function deleteQuestion($id)
    {
        $question = Question::find($id);
        $answers = Answers::where('quiz_id', $question->quiz_id)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $question->delete();
    }

    public static function isLogged()
    {
        return auth()->guard('admin')->check() || auth()->guard('teacher')->check() || auth()->guard('student')->check();
    }

    public static function isAdmin()
    {
        return auth()->guard('admin')->check();
    }

    public static function isTeacher()
    {
        return auth()->guard('teacher')->check();
    }

    public static function isStudent()
    {
        return auth()->guard('student')->check();
    }
}
