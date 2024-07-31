@extends('layouts.app')
@section('class', 'login-page')
@section('content')
    <section class="section-1">

        <div class="form-container">
            <div class="form-header">
                <div class="title">Teacher Login</div>
                <div class="sub-title">Enter your credentials to access your account</div>
            </div>

            <form action="{{ route('teacher_login') }}" method="POST" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me">
                    <label class="form-check" for="remember_me">Remember me</label>

                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="form-footer">
                <div class="text">Don't have a membership? <a href="{{ route('home') }}">Contact Us</a></div>
                <div class="text">Forgot password? <a href="{{ route('home') }}">Reset</a></div>
            </div>
        </div>
    </section>
@endsection
