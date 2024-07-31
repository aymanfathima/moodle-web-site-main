@extends('layouts.admin')
@section('class', 'dashboard admin')
@section('content')

    <div class="menu-title mb-4">Teacher Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('admin_teacher_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('admin_teacher_update', ['id' => $teacher->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="id" class="form-label">Teacher ID</label>
                        <input type="text" class="form-control" id="id" name="id"
                            value="{{ old('id', $teacher->id) }}" readonly disabled>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="email" class="form-label">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ old('email', $teacher->email) }}">
                    </div>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            value="{{ old('first_name', $teacher->first_name) }}">
                    </div>
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ old('last_name', $teacher->last_name) }}">
                    </div>
                    @error('last_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone', $teacher->phone) }}">
                    </div>
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="phone" class="form-label">Grade</label>
                        <select class="form-select" name="grade">
                            <option value="1" {{ old('grade', $teacher->grade) == 1 ? 'selected' : '' }}>Grade 1
                            </option>
                            <option value="2" {{ old('grade', $teacher->grade) == 2 ? 'selected' : '' }}>Grade 2
                            </option>
                            <option value="3" {{ old('grade', $teacher->grade) == 3 ? 'selected' : '' }}>Grade 3
                            </option>
                            <option value="4" {{ old('grade', $teacher->grade) == 4 ? 'selected' : '' }}>Grade 4
                            </option>
                            <option value="5" {{ old('grade', $teacher->grade) == 5 ? 'selected' : '' }}>Grade 5
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address', $teacher->address) }}">
                    </div>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" name="state">
                            <option value="1" {{ old('state', $teacher->state) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('state', $teacher->state) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Teacher</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
