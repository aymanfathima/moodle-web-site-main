@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Asset Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_asset_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('teacher_asset_update', ['id' => $asset->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-md-6">
                    <div>
                        <label for="name" class="form-label">Asset Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $asset->name) }}">
                    </div>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="description" class="form-label">Asset Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description', $asset->description) }}">
                    </div>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="lesson_id" class="form-label">Lesson ID</label>
                        <select class="form-select" id="lesson_id" name="lesson_id">
                            @foreach ($lessons as $lesson)
                                <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('lesson_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" name="state">
                            <option value="1" {{ $asset->state == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $asset->state == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @error('state')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Asset</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endsection
