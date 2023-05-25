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
                        <a href="#!">Articles</a>
                        <span class="mx-1">/</span>
                        <a href="#!">Travel</a>
                    </div>
                    <h1 class="mb-4 border-bottom border-primary d-inline-block">Travel</h1>
                </div>
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="row">
                        @foreach ($posts as $post)
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
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-blocks">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <img loading="lazy" decoding="async" src="images/author.jpg" alt="About Me"
                                            class="w-100 author-thumb-sm d-block">
                                        <h2 class="widget-title my-3">Hootan Safiyari</h2>
                                        <p class="mb-3 pb-2">
                                            Hello, I’m Hootan Safiyari. A Content writer, Developer, and Storyteller.
                                            Working as a Content writer at CoolTech Agency. Quam nihil …
                                        </p>
                                        <a href="about.html" class="btn btn-sm btn-outline-primary">Know More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="widget">
                                    <h2 class="section-title mb-3">Recommended</h2>
                                    <div class="widget-body">
                                        <div class="widget-list">
                                            @if (count($recommendedposts) > 0)
                                                <article class="card mb-5">
                                                    <a href="{{ route('blog.show', $recommendedposts[0]->slug) }}">
                                                        <div class="card-image">
                                                            <div class="post-info">
                                                                <span
                                                                    class="text-uppercase">{{ $recommendedposts[0]->created_at->format('d M Y') }}</span>
                                                                <span class="text-uppercase">{{ '0' }}
                                                                    minutes read</span>
                                                            </div>
                                                            @if (Storage::disk('public')->exists('posts/' . $recommendedposts[0]->image) && $recommendedposts[0]->image)
                                                                <img loading="lazy" decoding="async"
                                                                    src="{{ Storage::url('posts/' . $recommendedposts[0]->image) }}"
                                                                    alt="{{ $recommendedposts[0]->title }}" class="w-100"
                                                                    width="420" height="280">
                                                            @else
                                                                <img loading="lazy" decoding="async"
                                                                    src="images/post/default-thumbnail.jpg"
                                                                    alt="Post Thumbnail" class="w-100" width="420"
                                                                    height="280">
                                                            @endif
                                                        </div>
                                                    </a>
                                                    <div class="card-body px-0 pb-0">
                                                        <ul class="post-meta mb-2">
                                                            @foreach ($recommendedposts[0]->categories as $category)
                                                                <li>
                                                                    <a href="#">{{ $category->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <h2>
                                                            <a class="post-title"
                                                                href="{{ route('blog.show', $recommendedposts[0]->slug) }}">{{ $recommendedposts[0]->title }}</a>
                                                        </h2>
                                                        <p class="card-text">{!! Str::limit($recommendedposts[0]->body, 120) !!}</p>
                                                        <div class="content">
                                                            <a class="read-more-btn"
                                                                href="{{ route('blog.show', $recommendedposts[0]->slug) }}">Read
                                                                Full
                                                                Article</a>
                                                        </div>
                                                    </div>
                                                </article>
                                            @endif
                                            @if (count($recommendedposts) > 1)
                                                @foreach ($recommendedposts as $post)
                                                    <a class="media align-items-center" href="{{ $post->url }}">
                                                        @if (Storage::disk('public')->exists('posts/' . $post->image) && $post->image)
                                                            <img loading="lazy" decoding="async"
                                                                src="{{ Storage::url('posts/' . $post->image) }}"
                                                                alt="{{ $post->title }}" class="w-100" width="420"
                                                                height="280">
                                                        @else
                                                            <img loading="lazy" decoding="async"
                                                                src="images/post/default-thumbnail.jpg"
                                                                alt="Post Thumbnail" class="w-100" width="420"
                                                                height="280">
                                                        @endif
                                                        <div class="media-body ml-3">
                                                            <h3 style="margin-top: -5px">{{ $post->title }}</h3>
                                                            <p class="mb-0 small">We will put post excerpt here for all the
                                                                posts</p>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="widget">
                                    <h2 class="section-title mb-3">Categories</h2>
                                    <div class="widget-body">
                                        <ul class="widget-list">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="#">{{ $category->name }}
                                                        <span class="ml-auto">({{ $category->posts_count }})</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
