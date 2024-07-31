@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Notice Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_notice_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('admin_notice_store') }}" method="POST">
            @csrf
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="title" class="form-label">Notice Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title') }}">
                    </div>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="description" class="form-label">Notice Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description') }}">
                    </div>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date') }}">
                    </div>
                    @error('start_date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                            value="{{ old('start_time') }}">
                    </div>
                    @error('start_time')
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
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                            value="{{ old('end_time') }}">
                    </div>
                    @error('end_time')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" name="state">
                            <option value="1" @selected(old('state') == 1)>Active</option>
                            <option value="0" @selected(old('state') == 0)>Inactive</option>
                        </select>
                    </div>
                    @error('state')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                        Notice</button>
                </div>

            </div>
        </form>
    </div>

@endsection
