@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Asset Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_asset_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('teacher_asset_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gy-2 gx-3">

                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="name" class="form-label">Asset Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="type" class="form-label">Asset Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="doc" @selected(old('type') == 'doc')>Document</option>
                            <option value="video" @selected(old('type') == 'video')>Video</option>
                            <option value="image" @selected(old('type') == 'image')>Image</option>
                            <option value="audio" @selected(old('type') == 'audio')>Audio</option>
                            <option value="zip" @selected(old('type') == 'zip')>Zip</option>
                        </select>
                    </div>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="file" class="form-label">Asset File</label>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const typeSelect = document.getElementById('type');
                                const fileInput = document.getElementById('file');

                                typeSelect.addEventListener('change', function() {
                                    const selectedType = typeSelect.value;
                                    let accept = '';
                                    if (selectedType === 'doc') { //d
                                        accept = '.doc,.docx,.pdf';
                                    } else if (selectedType === 'video') { // w
                                        accept = '.mp4,.avi,.mov';
                                    } else if (selectedType === 'image') { // w
                                        accept = '.jpg,.jpeg,.png';
                                    } else if (selectedType === 'audio') { // w
                                        accept = '.mp3,.wav';
                                    } else if (selectedType === 'zip') { // d
                                        accept = '.zip,.rar';
                                    }
                                    fileInput.setAttribute('accept', accept);
                                });
                            });
                        </script>
                        <input type="file" class="form-control" id="file" name="file" accept=".doc,.docx,.pdf">
                    </div>
                    @error('file')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="description" class="form-label">Asset Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description') }}">
                    </div>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="lesson_id" class="form-label">Lesson ID</label>
                        <select class="form-select" id="lesson_id" name="lesson_id">
                            @foreach ($lessons as $lesson)
                                <option value="{{ $lesson->id }}" @selected(old('lesson_id') == $lesson->id)>{{ $lesson->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('lesson_id')
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
                            Asset</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
