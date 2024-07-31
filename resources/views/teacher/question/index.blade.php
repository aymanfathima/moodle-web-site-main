@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Question Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_quiz_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
        <a href="{{ route('teacher_question_add', ['id' => $id]) }}">Insert New Question</a>
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
                    <th class="actions">Actions</th>
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
                        <td class="actions">
                            <a href="{{ route('teacher_question_edit', ['id' => $question->id]) }}" class="edit">Edit</a>
                            <button onclick="deleteRecord(this, {{ $question->id }})" class="delete">Delete</button>
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
                                xhr.open('DELETE', '/teacher/question-delete/' + id, true);
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
