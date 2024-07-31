@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Lesson Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_lesson_add') }}">Insert New Lesson</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lesson Title</th>
                    <th>Lesson Description</th>
                    <th>Has Uploads</th>
                    <th>File Types</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->description }}</td>
                        <td>{{ $lesson->has_uploads ? 'Yes' : 'No' }}</td>
                        <td>{{ $lesson->file_types }}</td>
                        <td class="actions">
                            @if ($lesson->has_uploads)
                                <a href="{{ route('teacher_lesson_activity_index', ['id' => $lesson->id]) }}"
                                    class="view">View</a>
                            @endif

                            <a href="{{ route('teacher_lesson_edit', ['id' => $lesson->id]) }}" class="edit">Edit</a>
                            <button onclick="deleteRecord(this, {{ $lesson->id }})" class="delete">Delete</button>
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
                                xhr.open('DELETE', '/teacher/lesson-delete/' + id, true);
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
