@extends('layouts.teacher')
@section('class', 'dashboard teacher')
@section('content')

    <div class="menu-title mb-4">Profile Management</div>
    <div class="btn-wrap mb-3">
        <a href="{{ route('teacher_dashboard') }}"><i class="bi bi-caret-left-fill"></i> Go Back</a>
    </div>

    <div class="form-wrap mb-3">
        <form action="{{ route('teacher_profile_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-4">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ $teacher->first_name }}">
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ $teacher->last_name }}">
                    @error('last_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacher->phone }}">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="grade" class="form-label">Grade</label>
                    <input type="text" class="form-control" value="{{ $teacher->grade }}" disabled readonly>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address">{{ $teacher->address }}</textarea>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- image upload start -->
                <div class="col-12 marg-b ">
                    <label for="parent_name" class="form-label d-block">Profile Image</label>
                    <label for="upload_image">
                        <div class="form-control upload text-center">
                            @php
                                $upload_image = '';
                                if ($teacher->profile_picture == 'user.png') {
                                    $upload_image = 'images/user.png';
                                } else {
                                    $upload_image = 'uploads/profiles/' . $teacher->profile_picture;
                                }
                            @endphp
                            <img class="upload-img" src="{{ asset($upload_image) }}" alt="">
                        </div>
                        <input type="file" name="upload_image" id="upload_image" class="d-none">
                    </label>
                </div>
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title crop-title">Crop Image Before Upload</h5>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="" id="sample_image" />
                                        </div>
                                        <div class="col-12 mt-3 d-flex justify-content-center">
                                            <div class="preview marg-r"></div>
                                            <div class="preview r marg-l"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="crop" class="btn btn-crop">Crop</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function dataURLtoBlob(dataURL) {
                        const byteString = atob(dataURL.split(',')[1]);
                        const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
                        const ab = new ArrayBuffer(byteString.length);
                        const ia = new Uint8Array(ab);

                        for (let i = 0; i < byteString.length; i++) {
                            ia[i] = byteString.charCodeAt(i);
                        }

                        return new Blob([ab], {
                            type: mimeString
                        });
                    }
                    var uploaded_image = "";
                    $(document).ready(function() {
                        var $modal = $('#modal');
                        var image = document.getElementById('sample_image');
                        var cropper;
                        $('#upload_image').change(function(event) {
                            var files = event.target.files;
                            var done = function(url) {
                                image.src = url;
                                $modal.modal('show');
                            };
                            if (files && files.length > 0) {
                                reader = new FileReader();
                                reader.onload = function(event) {
                                    done(reader.result);
                                };
                                reader.readAsDataURL(files[0]);
                            }
                        });
                        $modal.on('shown.bs.modal', function() {
                            cropper = new Cropper(image, {
                                aspectRatio: 1,
                                viewMode: 3,
                                dragMode: 'move',
                                preview: '.preview'
                            });
                        }).on('hidden.bs.modal', function() {
                            cropper.destroy();
                            cropper = null;
                        });
                        $('#crop').click(function() {
                            canvas = cropper.getCroppedCanvas({
                                width: 200,
                                height: 200
                            });
                            var dataURL = canvas.toDataURL("image/png");
                            console.log(dataURL);
                            uploaded_image = dataURL;
                            const blob = dataURLtoBlob(dataURL);
                            const file = new File([blob], 'upload.jpg', {
                                type: 'image/jpeg'
                            });
                            const fileList = new DataTransfer();
                            fileList.items.add(file);

                            // Set the value of the file input element
                            document.getElementById('upload_image').files = fileList.files;
                            $('.upload-img').attr('src', dataURL);
                            $modal.modal('hide');
                        });

                    });
                </script>
                <!-- image upload end -->

                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Update Profile
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="form-wrap">
        <form action="{{ route('student_password_update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-2 gx-3">
                <div class="col-4">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        autocomplete="new-password">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    @error('current_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i> Update Password
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
