@php
    use Illuminate\Support\Str;
@endphp
@extends('frontend.layouts.app')
@section('styles')
    <style>
        .search-highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4">
                        <a href="index.html">Home</a>
                        <span class="mx-1">/</span>
                        <a href="{{ url('/') }}">Articles</a>
                        <span class="mx-1">/</span>
                        <a href="#!">
                            @php
                                $title = request()->segment(count(request()->segments())) ?? '';
                                $title = str_replace('-', ' ', $title);
                                $title = ucwords($title);
                            @endphp
                            {{ $title }}
                        </a>
                    </div>
                    <h1 class="mb-4 border-bottom border-primary d-inline-block">{{ $cat->name ?? '' }}</h1>
                </div>
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Search Result Against :
                                <span class="text-primary font-italic post-title"> {{ request()->search ?? '' }}</span>
                            </h2>

                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                    <div class="widget-body mt-3">
                                        <div class="widget-list">
                                            <a class="media align-items-center"
                                                href="{{ route('blog.show', $post->slug) }}">
                                                @if (Storage::disk('public')->exists('posts/' . $post->image) && $post->image)
                                                    <img loading="lazy" decoding="async"
                                                        src="{{ Storage::url('posts/' . $post->image) }}"
                                                        alt="{{ $post->title }}" class="w-100" width="420"
                                                        height="280">
                                                @else
                                                    <img loading="lazy" decoding="async"
                                                        src="images/post/default-thumbnail.jpg" alt="Post Thumbnail"
                                                        class="w-100" width="420" height="280">
                                                @endif
                                                <div class="media-body ml-3">
                                                    <h3 style="margin-top: -5px">{!! str_replace(
                                                        request()->search,
                                                        '<span class="search-highlight">' . request()->search . '</span>',
                                                        $post->title,
                                                    ) !!}</h3>
                                                    <p class="mb-0 small">
                                                        {!! str_replace(
                                                            request()->search,
                                                            '<span class="search-highlight">' . request()->search . '</span>',
                                                            Str::limit($post->excerpt, 80),
                                                        ) !!}
                                                    </p>

                                                    {{-- views count --}}
                                                    <div class="post-info">
                                                        <span
                                                            class="text-uppercase">{{ $post->created_at->format('d M Y') }}</span>
                                                        |
                                                        <span class="text-uppercase">
                                                            Total Views:
                                                            {{ $post->view_count }}
                                                        </span>

                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @include('frontend.partials.left-sidebar')
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
