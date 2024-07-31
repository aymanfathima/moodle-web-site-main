@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_quiz_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Quiz State</th>
                    <th>Marks</th>
                    <th>Date Completed</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                        <td> {{ $student->answer ? 'Completed' : 'Not Completed' }} </td>
                        <td> {{ $student->answer ? $student->answer->precentage : '-' }}</td>
                        <td>{{ $student->answer ? $student->answer->created_at : '-' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
