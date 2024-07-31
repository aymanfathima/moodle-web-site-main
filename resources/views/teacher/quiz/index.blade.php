@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_quiz_add') }}">Insert New Quiz</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Quiz Name</th>
                    {{-- <th>Question Count</th> --}}
                    <th>Deadline</th>
                    <th>Completed Count</th>
                    <th>State</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->id }}</td>
                        <td>{{ $quiz->name }}</td>
                        {{-- <td>{{ $quiz->questions->count() }}</td> --}}
                        <td>{{ $quiz->end_date }}</td>
                        <td>{{ $quiz->attempts }}</td>
                        <td>{{ $quiz->state }}</td>
                        <td class="actions">
                            <a href="{{ route('teacher_question_index', ['id' => $quiz->id]) }}" class="view">
                                Questions</a>
                            <a href="{{ route('teacher_quiz_result', ['id' => $quiz->id]) }}" class="view">
                                Results</a>
                            <a href="{{ route('teacher_quiz_edit', ['id' => $quiz->id]) }}" class="edit">Edit</a>
                            <button onclick="deleteRecord(this, {{ $quiz->id }})" class="delete">Delete</button>


                        </td>
                    </tr>
                @endforeach
                <script>
                    function deleteRecord(element, id) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this! This will permenently delete the record form the database.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let xhr = new XMLHttpRequest();
                                xhr.open('DELETE', '/teacher/quiz-delete/' + id, true);
                                xhr.setRequestHeader('Content-Type', 'application/json');
                                let data = {
                                    id: id,
                                };
                                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                                xhr.send(JSON.stringify(data));
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        console.log(xhr.responseText);
                                        var data = JSON.parse(xhr.responseText);
                                        if (data.status == 'success' && data.deleted == true) {
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: "Your record has been deleted.",
                                                icon: "success"
                                            });
                                            element.closest('tr').remove();
                                        }
                                    }
                                }
                            }
                        });
                    }
                </script>
            </tbody>
        </table>
    </div>



@endsection
