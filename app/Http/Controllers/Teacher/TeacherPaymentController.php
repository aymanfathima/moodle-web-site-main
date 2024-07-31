<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherPaymentController extends Controller
{
    public function teacher_payment_index()
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $students = Student::where('grade', $grade)
            ->with(['payments' => function ($query) {
                $query->latest();
            }])
            ->get();
        return view('teacher.payment.index', compact('students'));
    }

    public function teacher_payment_add(Request $request)
    {
        $grade = auth()->guard('teacher')->user()->grade;
        $student = Student::where('id', $request->id)
            ->with(['payments' => function ($query) {
                $query->latest();
            }])
            ->first();

        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June',  'July', 'August', 'September',  'October', 'November', 'December'];

        $lastMonth = $student->payments->first()->for_month ?? null;

        if ($lastMonth) {
            $lastMonthIndex = array_search($lastMonth, $monthNames);
            $nextMonthIndex = $lastMonthIndex + 1;
            $nextMonth = $monthNames[$nextMonthIndex];
        } else {
            $nextMonth = $monthNames[0];
        }

        return view('teacher.payment.add', compact('student', 'nextMonth'));
    }

    public function teacher_payment_store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'for_month' => 'required',
            'amount' => 'required',
        ]);

        $payment = new Payment();
        $payment->student_id = $request->student_id;
        $payment->for_month = $request->for_month;
        $payment->amount = $request->amount;
        $payment->payment_date = date('Y-m-d');
        $payment->teacher_id = auth()->guard('teacher')->user()->id;
        $payment->state = 1;
        $payment->save();

        return redirect()->route('teacher_payment_index')->with('success', 'Payment added successfully');
    }
}
