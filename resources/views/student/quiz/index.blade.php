@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')
    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>
    <div class="quiz-wrap">
        @php
            $mark = $_GET['mark'] ?? '';
        @endphp
        @foreach ($quizzes as $quiz)
            <div class="quiz-card @if ($mark == $quiz->id) marked @endif">
                <div class="quiz-name"> {{ $quiz->name }} </div>
                <div class="quiz-description"> {{ $quiz->description }} </div>
                <div class="row">
                    <div class="col-5">
                        <div class="quiz-deadline">Deadline: <span>{{ $quiz->end_date }}</span></div>
                    </div>
                    <div class="col-5">
                        {{-- <div class="quiz-attempts">Attempts: <span>{{ $quiz->attempts }}</span></div> --}}
                    </div>
                    <div class="col-2 d-flex justify-content-end">

                        @if ($answers->contains('quiz_id', $quiz->id))
                            <a class="btn btn-primary" href="{{ route('student_quiz_result', ['id' => $quiz->id]) }}"><i
                                    class="bi bi-floppy-fill"></i> View
                                Result</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('student_quiz_start', ['id' => $quiz->id]) }}"><i
                                    class="bi bi-floppy-fill"></i> Attempt
                                Quiz</a>
                        @endif



                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
