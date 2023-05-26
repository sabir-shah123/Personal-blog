@extends('frontend.layouts.app')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
@endsection
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Gallery</h4>
            </div>
            <div class="row">
                @foreach ($galleries as $gallery)
                    @if (Storage::disk('public')->exists('gallery/' . $gallery->image) && $gallery->image)
                        <div class="col s12 m4">
                            <div class="card">
                                <div class="card-image">
                                    <div id="aniimated-thumbnials">
                                        <a href="{{ Storage::url('gallery/' . $gallery->image) }}" data-fancybox="gallery"
                                            data-caption="{{ $gallery->caption }}">
                                            <img src="{{ Storage::url('gallery/' . $gallery->image) }}"
                                                alt="{{ $gallery->caption }}" class="card-image-bg "
                                                data-lightbox="{{ Storage::url('gallery/' . $gallery->image) }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="m-t-30 m-b-60 center">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
@endsection
