@extends('backend.layouts.app')

@section('title', 'About Me')

@push('styles')
@endpush

@section('content')
    <div class="block-header"></div>
    <div class="row clearfix">
        <div class="col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>
                        About Me
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.about.save',$me->id??null) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <img src="" id="profile-imgsrc" class="img-responsive">
                            <input type="file" name="image" id="profile-image-input" style="display:none;">
                            <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="profile-image-btn">
                                <i class="material-icons">image</i>
                                <span>UPLOAD IMAGE</span>
                            </button>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" value="{{ $me->name ?? '' }}">
                                <label class="form-label">Name</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="description" rows="4" class="form-control no-resize">{{ $me->description ?? '' }}</textarea>
                                <label class="form-label">Description</label>
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
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function() {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
        });
    </script>
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
