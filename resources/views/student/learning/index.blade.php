@extends('layouts.student')
@section('class', 'dashboard student')
@section('content')
    <div class="menu-title mb-4">Lesson Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('student_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>
    <div class="lesson-wrap">

        @foreach ($lessons as $lesson)
            <div class="lesson-card">
                <div class="title">{{ $lesson->title }}</div>
                <div class="description">{{ $lesson->description }}</div>
                @if ($lesson->assets->count() > 0)
                    <div class="asset-wrap">
                        <div class="row g-2">

                            @foreach ($lesson->assets as $asset)
                                <div class="col-12 col-md-6 col-xl-4">
                                    <form action="{{ route('download') }}" method="post" onclick="this.submit()">
                                        @csrf
                                        <input type="hidden" name="file" value="{{ $asset->link }}">
                                        <div class="asset">
                                            <div class="image">
                                                @php
                                                    $image = '';
                                                    switch ($asset->type) {
                                                        case 'doc':
                                                            $image = 'images/doc.png';
                                                            break;
                                                        case 'video':
                                                            $image = 'images/video.png';
                                                            break;
                                                        case 'image':
                                                            $image = 'images/image.png';
                                                            break;
                                                        case 'audio':
                                                            $image = 'images/mp3.png';
                                                            break;
                                                        case 'zip':
                                                            $image = 'images/zip.png';
                                                            break;
                                                        default:
                                                            $image = 'images/zip.png';
                                                            break;
                                                    }
                                                @endphp

                                                <img src="{{ asset($image) }}" alt="">
                                            </div>
                                            <div class="wrap">
                                                <div class="text">
                                                    {{ $asset->name }}
                                                </div>
                                                <div class="description">{{ $asset->description }}</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif
                @if ($lesson->has_uploads && !$activity->contains('lesson_id', $lesson->id))
                    <div class="upload-wrap mt-2">
                        <form action="{{ route('student_lesson_upload', ['id' => $lesson->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="upload_file" class="form-label">Upload File</label>
                                        @php
                                            $accept = '';
                                            if ($lesson->upload_type === 'doc') {
                                                $accept = '.doc,.docx,.pdf';
                                            } elseif ($lesson->upload_type === 'image') {
                                                $accept = '.jpg,.jpeg,.png';
                                            } elseif ($lesson->upload_type === 'zip') {
                                                $accept = '.zip';
                                            }
                                        @endphp
                                        <input type="file" class="form-control" id="upload_file" name="upload_file"
                                            accept="{{ $accept }}">
                                    </div>
                                    @error('upload_file')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @elseif ($lesson->has_uploads && $activity->contains('lesson_id', $lesson->id))
                    <div class="upload-wrap mt-2">
                        <form action="{{ route('download') }}" method="post" onclick="this.submit()">
                            @csrf
                            <input type="hidden" name="file"
                                value="{{ 'uploads/activities/' . $activity->where('lesson_id', $lesson->id)->first()->uploads }}">
                            <div class="row g-2">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="upload_file" class="form-label">Uploaded File</label>
                                        <input type="text" class="form-control" id="upload_file" name="upload_file"
                                            value="{{ $activity->where('lesson_id', $lesson->id)->first()->uploads }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach




    </div>
@endsection
