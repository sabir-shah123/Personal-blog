@php
    use Illuminate\Support\Str;
@endphp
@extends('frontend.layouts.app')
@section('styles')
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
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-6 mb-4">
                                <article class="card article-card article-card-sm h-100">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <div class="card-image">
                                            <div class="post-info">
                                                <span class="text-uppercase">{{ $post->created_at->format('d M Y') }}</span>
                                                <span class="text-uppercase">{{ '0' }} minutes read</span>
                                            </div>
                                            @if (Storage::disk('public')->exists('posts/' . $post->image) && $post->image)
                                                <img loading="lazy" decoding="async"
                                                    src="{{ Storage::url('posts/' . $post->image) }}"
                                                    alt="{{ $post->title }}" class="w-100" width="420" height="280">
                                            @else
                                                <img loading="lazy" decoding="async" src="images/post/default-thumbnail.jpg"
                                                    alt="Post Thumbnail" class="w-100" width="420" height="280">
                                            @endif
                                        </div>
                                    </a>
                                    <div class="card-body px-0 pb-0">
                                        <ul class="post-meta mb-2">
                                            @foreach ($post->categories as $category)
                                                <li>
                                                    <a
                                                        href="{{ route('blog.categories', $category->slug) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul class="post-meta mb-2">
                                            @foreach ($post->tags as $category)
                                                <li>
                                                    <a class="bg-info text-white px-2 py-1 rounded"
                                                        href="{{ route('blog.tags', $category->slug) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <h2>
                                            <a class="post-title"
                                                href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h2>
                                        <p class="card-text">{!! Str::limit($post->body, 120) !!}</p>
                                        <div class="content">
                                            <a class="read-more-btn" href="{{ route('blog.show', $post->slug) }}">Read Full
                                                Article</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @empty
                            <div class="col-md-12 mb-4">
                                <div class="card article-card article-card-sm h-100">
                                    <div class="card-body px-0 pb-0">
                                        <h2 class="text-center">No Posts Found</h2>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                @include('frontend.partials.left-sidebar')
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
