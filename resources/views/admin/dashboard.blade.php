@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')
    @foreach ($notices as $notice)
        <div class="alert alert-info" role="alert">
            <h5 class="alert-heading">Special Notice !</h5>
            <hr>
            <h6>{{ $notice->title }}</h6>
            <p class="mb-0">{{ $notice->description }}</p>
        </div>
    @endforeach
    <div class="menu-title mb-4">Dashboard</div>
    <div class="container-fluid">
        <div class="row g-3">

            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="dashboard-card">
                    <div class="amount">
                        {{ $st_count }}
                    </div>
                    <div class="name">
                        Students Count
                    </div>
                    <div class="description">
                        Total number of students in the lms for 2024 session
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="dashboard-card">
                    <div class="amount">
                        {{ $t_count }}
                    </div>
                    <div class="name">
                        Teachers Count
                    </div>
                    <div class="description">
                        Total number of teachers in the lms for 2024 session
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="dashboard-card">
                    <div class="amount">
                        {{ $q_count }}
                    </div>
                    <div class="name">
                        Quizes Count
                    </div>
                    <div class="description">
                        Total number of quizes in the lms for 2024 session
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="dashboard-card">
                    <div class="amount">
                        {{ $l_count }}
                    </div>
                    <div class="name">
                        Lessons Count
                    </div>
                    <div class="description">
                        Total number of lessons in the lms for 2024 session
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="dashboard-card">
                    <div class="amount">
                        {{ $t_income }}
                    </div>
                    <div class="name">
                        Total Payments
                    </div>
                    <div class="description">
                        Total income from students in the lms for 2024 session
                    </div>
                </div>
            </div>

        </div>

    @endsection
