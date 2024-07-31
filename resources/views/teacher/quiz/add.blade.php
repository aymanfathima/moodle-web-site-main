@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Quiz Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_quiz_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('teacher_quiz_store') }}" method="POST">
            @csrf
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description') }}">
                    </div>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="grade" class="form-label">Grade</label>
                        <input type="hidden" class="form-control" id="grade" name="grade" value="1">
                        <input type="text" class="form-control" value="Grade 1" disabled readonly>
                    </div>
                    @error('grade')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ old('end_date') }}">
                    </div>
                    @error('end_date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="attempts" class="form-label">Attempts</label>
                        <input type="number" class="form-control" id="attempts" name="attempts"
                            value="{{ old('attempts') }}">
                    </div>
                    @error('attempts')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" name="state">
                            <option value="1" @selected(old('state') == 1)>Active</option>
                            <option value="0" @selected(old('state') == 0)>Inactive</option>
                        </select>
                    </div>
                    @error('state')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Quiz</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
