@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')
    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_quiz_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>
    <div class="quiz-attempt-wrap">

        @php
            $answers = json_decode($answer->answers, true);
            $counter = 1;

            $question_count = count($quiz->questions);
            $correct_count = 0;
            foreach ($answers as $answer) {
                if ($answer['result'] == 1) {
                    $correct_count++;
                }
            }
            $percentage = ($correct_count / $question_count) * 100;
        @endphp
        <div class="quiz-attempt-card">
            <div class="quiz-name">{{ $quiz->name }}</div>
            <div class="quiz-description mb-3">{{ $quiz->description }}</div>
            <div class="quiz-meta">All Questions : {{ $question_count }}</div>
            <div class="quiz-meta">Correct Answers : {{ $correct_count }}</div>
            <div class="quiz-meta">Preasentage : {{ round($percentage, 0) }}%</div>
        </div>

        @foreach ($quiz->questions as $question)
            @php
                $cardClass = $answers['q' . $counter]['result'] == 1 ? 'correct' : 'incorrect';
                $correct = $answers['q' . $counter]['correct'] ?? 0;
            @endphp
            <div class="quiz-attempt-card {{ $cardClass }}">
                <div class="question-text">{{ $question->question }}</div>
                <div class="options">
                    <div class="option @if ($correct == 1) correct @endif">
                        <input type="radio" name="question_{{ $question->id }}" readonly disabled
                            @checked($answers['q' . $counter]['given'] == 1)>
                        <label for="question_{{ $question->id }}_option_1">{{ $question->option1 }}</label>
                    </div>
                    <div class="option @if ($correct == 2) correct @endif">
                        <input type="radio" name="question_{{ $question->id }}" readonly disabled
                            @checked($answers['q' . $counter]['given'] == 2)>
                        <label for="question_{{ $question->id }}_option_2">{{ $question->option2 }}</label>
                    </div>
                    <div class="option @if ($correct == 3) correct @endif">
                        <input type="radio" name="question_{{ $question->id }}" readonly disabled
                            @checked($answers['q' . $counter]['given'] == 3)>
                        <label for="question_{{ $question->id }}_option_3">{{ $question->option3 }}</label>
                    </div>
                    <div class="option @if ($correct == 4) correct @endif">
                        <input type="radio" name="question_{{ $question->id }}" readonly disabled
                            @checked($answers['q' . $counter]['given'] == 4)>
                        <label for="question_{{ $question->id }}_option_4">{{ $question->option4 }}</label>
                    </div>
                </div>
            </div>
            @php
                $counter++;
            @endphp
        @endforeach


    </div>
@endsection
