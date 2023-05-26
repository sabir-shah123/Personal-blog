@extends('backend.layouts.app')

@section('title', 'Settings')

@push('styles')
@endpush

@php
    $settings = App\Setting::where('user_id', Auth::id())->pluck('value', 'key');
    $settings = json_decode(json_encode($settings));
@endphp

@section('content')

    <div class="block-header"></div>
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>
                        GENERAL SETTING
                        <a href="{{ route('admin.profile') }}" class="btn waves-effect waves-light right headerightbtn">
                            <i class="material-icons left">person</i>
                            <span>PROFILE </span>
                        </a>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <img src="" id="profile-imgsrc" class="img-responsive" height="80" width="80">
                            <input type="file" name="company_logo" id="profile-image-input" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="profile-image-btn">
                                <i class="material-icons">image</i>
                                <span>Upload Company Logo</span>
                            </button>
                        </div>


                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control"
                                    value="{{ $settings->name ?? '' }}">
                                <label class="form-label">Site Title</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="email" class="form-control"
                                    value="{{ $settings->email ?? '' }}">
                                <label class="form-label">Site Email</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="phone" class="form-control"
                                    value="{{ $settings->phone ?? '' }}">
                                <label class="form-label">Phone</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="address" class="form-control"
                                    value="{{ $settings->address ?? '' }}">
                                <label class="form-label">Address</label>
                            </div>
                            <small class="col-red font-italic">HTML Tag allowed</small>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="aboutus" rows="4" class="form-control no-resize">{{ $settings->aboutus ?? '' }}</textarea>
                                <label class="form-label">About Site</label>
                            </div>
                        </div>

                        <h6>Social Links</h6>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="facebook" class="form-control"
                                    value="{{ $settings->facebook ?? '' }}">
                                <label class="form-label">Facebook Link</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="github" class="form-control"
                                    value="{{ $settings->github ?? '' }}">
                                <label class="form-label">Github Link</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="twitter" class="form-control"
                                    value="{{ $settings->twitter ?? '' }}">
                                <label class="form-label">Twitter Link</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="linkedin" class="form-control"
                                    value="{{ $settings->linkedin ?? '' }}">
                                <label class="form-label">LinkedIn Link</label>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="youtube" class="form-control"
                                    value="{{ $settings->youtube ?? '' }}">
                                <label class="form-label">Youtube Link</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')
    <script>
        $(function() {
            function showImage(fileInput, imgID) {
                if (fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(imgID).attr('src', e.target.result);
                        $(imgID).attr('alt', fileInput.files[0].name);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
            $('#profile-image-btn').on('click', function() {
                $('#profile-image-input').click();
            });
            $('#profile-image-input').on('change', function() {
                showImage(this, '#profile-imgsrc');
            });
        })
    </script>
@endpush
