@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Notice Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_notice_add') }}">Insert New Notice</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Notice Title</th>
                    <th>Notice Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>State</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($notices as $notice)
                    <tr>
                        <td>{{ $notice->id }}</td>
                        <td>{{ $notice->title }}</td>
                        <td>{{ $notice->description }}</td>
                        <td>{{ $notice->start_date }}</td>
                        <td>{{ $notice->end_date }}</td>
                        <td>{{ $notice->state }}</td>
                        <td class="actions">
                            <a href="{{ route('admin_notice_edit', ['id' => $notice->id]) }}" class="edit">EDIT</a>
                            <button onclick="deleteRecord(this, {{ $notice->id }})" class="delete">Delete</button>
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
                                xhr.open('DELETE', '/admin/notices-delete/' + id, true);
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
