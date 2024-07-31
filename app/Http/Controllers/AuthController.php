<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function student_login()
    {
        return view('auth.student_login');
    }

    function student_login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->guard('student')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])) {
            $user = auth()->guard('student')->user();
            if ($user->state == 1) {
                return redirect()->route('student_dashboard')->with('success', 'You are Logged in sucessfully.');
            }
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
        return back()->with('status', 'Invalid login details');
    }

    function teacher_login()
    {
        return view('auth.teacher_login');
    }

    function teacher_login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->guard('teacher')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])) {
            $user = auth()->guard('teacher')->user();
            if ($user->state == 1) {
                return redirect()->route('teacher_dashboard')->with('success', 'You are Logged in sucessfully.');
            }
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
        return back()->with('status', 'Invalid login details');
    }

    function admin_login()
    {
        return view('auth.admin_login');
    }

    function admin_login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])) {
            $user = auth()->guard('admin')->user();
            if ($user->state == 1) {
                return redirect()->route('admin_dashboard')->with('success', 'You are Logged in sucessfully.');
            }
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
        return back()->with('status', 'Invalid login details');
    }

    function logout()
    {

        if (auth()->guard('student')->check()) {
            auth()->guard('student')->logout();
        } elseif (auth()->guard('teacher')->check()) {
            auth()->guard('teacher')->logout();
        } elseif (auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
        }
        auth()->logout();
        return redirect()->route('home');
    }
}