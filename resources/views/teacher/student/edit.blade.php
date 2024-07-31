@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Student Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_student_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        @php
            $self_user = auth()->guard('teacher')->user();
        @endphp
        <form action="{{ route('teacher_student_update', ['id' => $student->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="id" name="id"
                            value="{{ old('id', $student->id) }}" readonly disabled>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="email" class="form-label">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ old('email', $student->email) }}">
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
                            value="{{ old('first_name', $student->first_name) }}">
                    </div>
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ old('last_name', $student->last_name) }}">
                    </div>
                    @error('last_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="parent_name" class="form-label">Parent Name</label>
                        <input type="text" class="form-control" id="parent_name" name="parent_name"
                            value="{{ old('parent_name', $student->parent_name) }}">
                    </div>
                    @error('parent_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="col-12 col-lg-6 col-xl-4">
                        <div>
                            <label for="grade" class="form-label">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade"
                                value="{{ $self_user->grade }}" readonly disabled>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone', $student->phone) }}">
                    </div>
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address', $student->address) }}">
                    </div>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" name="state">
                            <option value="1" {{ old('state', $student->state) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('state', $student->state) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Student</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
