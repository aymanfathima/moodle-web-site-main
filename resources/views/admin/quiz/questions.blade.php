@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Question Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_quiz_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Answer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->option1 }}</td>
                        <td>{{ $question->option2 }}</td>
                        <td>{{ $question->option3 }}</td>
                        <td>{{ $question->option4 }}</td>
                        <td>{{ $question->answer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
