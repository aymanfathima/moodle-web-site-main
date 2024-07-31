@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Payment Management</div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Last Payment Date</th>
                    <th>Last Payment Month</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->payments->first()->payment_date ?? '-' }}</td>
                        <td>{{ $student->payments->first()->for_month ?? '-' }}</td>
                        <td class="actions">
                            <a href="{{ route('teacher_payment_add', ['id' => $student->id]) }}" class="view">New
                                Payment</a>
                            {{-- <form action="{{ route('teacher_lesson_delete', ['id' => $lesson->id]) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
