@extends('layouts.app')
@section('class', 'home-page')
@section('content')
    <section class="section-1">
        <div class="left">
            <div class="wrap">
                <div class="t1">Royal Kids Academy</div>
                <div class="t2">Best English Class For Your Child</div>
                <div class="t3">Royal Kids Academy is an innovative online learning platform dedicated to providing
                    engaging and interactive educational experiences for children of all ages. With a focus on personalized
                    learning, our platform offers a diverse range of courses designed to inspire curiosity, creativity, and
                    critical thinking skills. From math and science to language arts and beyond, Royal Kids Academy empowers
                    young learners to explore, discover, and excel in a safe and supportive digital environment. </div>
                <div class="t3">Join us on
                    a journey of discovery where every child can unleash their full potential and reign as the king or queen
                    of knowledge!</div>
            </div>
        </div>
        <div class="right">
            <div class="d-block cc">
                @if (auth()->guard('student')->check())
                    <a href="{{ route('student_dashboard') }}" class="login-btn mb-3">Student Dashboard <i
                            class="bi bi-caret-right-fill"></i></a>
                    <a href="{{ route('logout') }}" class="login-btn">Logout <i class="bi bi-caret-right-fill"></i></a>
                @elseif (auth()->guard('teacher')->check())
                    <a href="{{ route('teacher_dashboard') }}" class="login-btn mb-3">Teacher Dashboard <i
                            class="bi bi-caret-right-fill"></i></a>
                    <a href="{{ route('logout') }}" class="login-btn">Logout <i class="bi bi-caret-right-fill"></i></a>
                @elseif (auth()->guard('admin')->check())
                    <a href="{{ route('admin_dashboard') }}" class="login-btn mb-3">Admin Dashboard <i
                            class="bi bi-caret-right-fill"></i></a>
                    <a href="{{ route('logout') }}" class="login-btn">Logout <i class="bi bi-caret-right-fill"></i></a>
                @else
                    <a href="{{ route('student_login') }}" class="login-btn mb-3">Student Login <i
                            class="bi bi-caret-right-fill"></i></a>
                    <a href="{{ route('teacher_login') }}" class="login-btn mb-3">Teachers Login <i
                            class="bi bi-caret-right-fill"></i></a>
                    <a href="{{ route('admin_login') }}" class="login-btn">Administrator Login <i
                            class="bi bi-caret-right-fill"></i></a>
                @endif
            </div>
        </div>
    </section>
@endsection
