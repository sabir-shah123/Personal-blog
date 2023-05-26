@extends('frontend.layouts.app')
@section('title', 'Detail')
@section('css')
    <script src="https://use.fontawesome.com/aef75501ab.js"></script>
    <style>
        .socialicon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 10px;
            padding: 10px;
            border-radius: 100%;
            height: 40px;
            width: 40px;
            text-decoration: none;
        }

        .facebook {
            background-color: #3b5998;
        }

        .twitter {
            background-color: #1da1f2;
        }

        .linkedin {
            background-color: #0077b5;
        }

        .telegram {
            background-color: #0088cc;
        }

        .whatsapp {
            background-color: #25D366;
        }

        .socialicon:hover {
            color: #000;
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <article>
                        <img loading="lazy" decoding="async" src="{{ Storage::url('posts/' . $post->image) }}"
                            alt="{{ $post->title }}" class="w-100">
                        <ul class="post-meta mb-2 mt-4">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                    <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z">
                                    </path>
                                    <path
                                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z">
                                    </path>
                                </svg> <span>{{ $post->created_at->format('d F, Y') }}</span>
                            </li>
                        </ul>
                        <h1 class="my-3">{{ $post->title }}</h1>
                        <ul class="post-meta mb-4">
                            <span>Category:</span>
                            @foreach ($post->categories as $pcat)
                                <li>
                                    <a href="{{ route('blog.categories', $pcat->slug) }}">{{ $pcat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="post-meta mb-4">
                            <span>Tags:</span>
                            @foreach ($post->tags as $pcat)
                                <li>
                                    <a href="{{ route('blog.tags', $pcat->slug) }}">{{ $pcat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="content text-left">
                            {!! $post->body !!}
                        </div>
                    </article>
                    <br>
                    <hr />
                    <div class="mt-5">
                        <div class="post-title">
                            Loved this article? Please Share it with your loved ones too!
                        </div>
                        <div class="sharethis mt-3">

                            @php
                                $url = route('blog.show', $post->slug);
                                $title = 'Check out this article I read on ' . $settings->name ?? 'Blogging Site' . ' titled ' . $post->title . ' by ' . $post->user->name . ' at ' . $url . '!';
                            @endphp

                            {{-- fontawesome icons --}}

                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank"
                                class="socialicon facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="https://wa.me/?text={{ $url }}" target="_blank" class="socialicon whatsapp">
                                <i class="fa fa-whatsapp"></i>
                            </a>

                            <a href="https://twitter.com/intent/tweet?text={{ $title }}" target="_blank"
                                class="socialicon twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="https://www.linkedin.com/shareArticle?url={{ $url }}" target="_blank"
                                class="socialicon linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>

                            <a href="https://telegram.me/share/url?url={{ $url }}&text={{ $title }}"
                                target="_blank" class="socialicon telegram">
                                <i class="fa fa-telegram"></i>
                            </a>
                        </div>

                        

                    </div>
                </div>
                @include('frontend.partials.left-sidebar')
            </div>
        </div>
    </section>

@endsection

@section('js')

    <script>
        $(document).ready(function() {

        });
    </script>

@endsection
