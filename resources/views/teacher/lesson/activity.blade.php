@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Lesson Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_lesson_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>File Name</th>
                    <th>Uploaded Date</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ $activity->student_id }}</td>
                        <td>{{ $activity->student->first_name . ' ' . $activity->student->last_name }}</td>
                        <td>{{ $activity->uploads }}</td>
                        <td>{{ $activity->created_at }}</td>
                        <td class="actions">
                            <form action="{{ route('download') }}" method="post">
                                @csrf
                                <input type="hidden" name="file"
                                    value="{{ 'uploads/activities/' . $activity->uploads }}">
                                <button type="submit" class="view">Download</button>
                            </form>

                            <form action="{{ route('teacher_lesson_activity_delete', ['id' => $activity->id]) }}"
                                method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection
