@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Contact Us Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    {{-- <th class="actions">Actions</th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        {{-- <td class="actions">
                            <a href="{{ route('admin_quiz_result', ['id' => $quiz->id]) }}" class="view">Results</a>
                            <a href="{{ route('admin_quiz_question', ['id' => $quiz->id]) }}" class="view">Questions</a>
                        </td> --}}
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
