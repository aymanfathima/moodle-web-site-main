@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')
    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_quiz_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>
    <div class="quiz-attempt-wrap">
        <form action="{{ route('student_quiz_submit') }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <div class="quiz-attempt-card">
                <div class="quiz-name">{{ $quiz->name }}</div>
                <div class="quiz-description">{{ $quiz->description }}</div>


            </div>

            @foreach ($quiz->questions as $question)
                <div class="form-wrap quiz-attempt-card">
                    <div class="question-text">{{ $question->question }}</div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="question_{{ $question->id }}"
                                id="question_{{ $question->id }}_option_1" value="1">
                            <label for="question_{{ $question->id }}_option_1">{{ $question->option1 }}</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="question_{{ $question->id }}"
                                id="question_{{ $question->id }}_option_2" value="2">
                            <label for="question_{{ $question->id }}_option_2">{{ $question->option2 }}</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="question_{{ $question->id }}"
                                id="question_{{ $question->id }}_option_3" value="3">
                            <label for="question_{{ $question->id }}_option_3">{{ $question->option3 }}</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="question_{{ $question->id }}"
                                id="question_{{ $question->id }}_option_4" value="4">
                            <label for="question_{{ $question->id }}_option_4">{{ $question->option4 }}</label>
                        </div>
                    </div>
                    @error('question_' . $question->id)
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
            <div class="col-12 d-flex justify-content-end">
                <div>
                    <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> FINISH QUIZ</button>
                </div>
            </div>
        </form>
    </div>
@endsection
