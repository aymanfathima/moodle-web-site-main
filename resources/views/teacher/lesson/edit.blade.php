@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Lesson Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_lesson_index') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap">
        <form action="{{ route('teacher_lesson_update', ['id' => $lesson->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $lesson->title) }}">
                    </div>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description', $lesson->description) }}">
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
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" name="state">
                            <option value="1" {{ old('state', $lesson->state) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('state', $lesson->state) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                    @error('state')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="has_uploads" name="has_uploads"
                            @checked(old('has_uploads', $lesson->has_uploads)) onclick="toggleUploads(this)">
                        <label class="form-label" for="has_uploads">Mark this lesson as a Assignment and
                            enable files uploding</label>
                    </div>
                </div>

                <div class="col-12">
                    <label for="file" class="form-label">Allowed File Types</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="zip" id="zip" name="file_types[]"
                            @checked((is_array(old('file_types')) && in_array('zip', old('file_types'))) || strpos($lesson->file_types, 'zip'))>
                        <label class="form-label" for="zip">
                            Zip Files [ .zip ]
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="doc" id="doc" name="file_types[]"
                            @checked((is_array(old('file_types')) && in_array('doc', old('file_types'))) || strpos($lesson->file_types, 'doc'))>
                        <label class="form-label" for="doc">
                            Documents [ .doc, .docx, .pdf ]
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="image" id="image" name="file_types[]"
                            @checked((is_array(old('file_types')) && in_array('image', old('file_types'))) || strpos($lesson->file_types, 'image'))>
                        <label class="form-label" for="image">
                            Images [ .jpg, .jpeg, .png ]
                        </label>
                    </div>
                    @error('file_types')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <script>
                    function toggleUploads(x) {
                        if (x.checked) {
                            document.getElementById('zip').removeAttribute('disabled');
                            document.getElementById('doc').removeAttribute('disabled');
                            document.getElementById('image').removeAttribute('disabled');
                        } else {
                            document.getElementById('zip').setAttribute('disabled', 'disabled');
                            document.getElementById('zip').checked = false;
                            document.getElementById('doc').setAttribute('disabled', 'disabled');
                            document.getElementById('doc').checked = false;
                            document.getElementById('image').setAttribute('disabled', 'disabled');
                            document.getElementById('image').checked = false;
                        }
                    }
                    toggleUploads(document.getElementById('has_uploads'));
                </script>
                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Save
                            Lesson</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
