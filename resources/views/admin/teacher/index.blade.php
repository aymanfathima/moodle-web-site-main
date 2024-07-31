@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Teacher Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_teacher_add') }}">Insert New Teacher</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Teacher Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Grade</th>
                    <th>State</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                        <td>{{ $teacher->address }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->grade }}</td>
                        <td>{{ $teacher->state == '1' ? 'ACTIVE' : 'INACTIVE' }}</td>
                        <td class="actions">
                            <a href="{{ route('admin_teacher_edit', ['id' => $teacher->id]) }}" class="edit">Edit</a>
                            <button onclick="deleteRecord(this, {{ $teacher->id }})" class="delete">Delete</button>

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
                                xhr.open('DELETE', '/admin/teacher-delete/' + id, true);
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
