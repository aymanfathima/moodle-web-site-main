@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description Name</th>
                    <th>Grade</th>
                    <th>End Date</th>
                    <th>State</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->id }}</td>
                        <td>{{ $quiz->name }}</td>
                        <td>{{ $quiz->description }}</td>
                        <td>Grade {{ $quiz->grade }}</td>
                        <td>{{ $quiz->end_date }}</td>
                        <td>{{ $quiz->state == 1 ? 'Active' : 'Inactive' }}</td>
                        <td class="actions">
                            <a href="{{ route('admin_quiz_result', ['id' => $quiz->id]) }}" class="view">Results</a>
                            <a href="{{ route('admin_quiz_question', ['id' => $quiz->id]) }}" class="view">Questions</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
