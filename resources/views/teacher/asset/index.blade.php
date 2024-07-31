@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Asset Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_asset_add') }}">Insert New Asset</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Asset Link</th>
                    <th>Asset Description</th>
                    <th>Lesson ID</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->type }}</td>
                        <td>{{ $asset->link }}</td>
                        <td>{{ $asset->description }}</td>
                        <td>{{ $asset->lesson_id }}</td>
                        <td class="actions">
                            <a href="{{ route('teacher_asset_edit', ['id' => $asset->id]) }}" class="edit">Edit</a>
                            <form action="{{ route('teacher_asset_delete', ['id' => $asset->id]) }}" method="POST">
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
