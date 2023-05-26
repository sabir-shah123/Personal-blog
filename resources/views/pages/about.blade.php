@extends('frontend.layouts.app')
@section('title', 'About Me')
@section('css')
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <article>
                        <img loading="lazy" decoding="async" src="{{ Storage::url('users/' . $me->image) }}"
                            alt="{{ $me->name??'' }}" class="w-100">
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
                                </svg> <span>{{ $me->updated_at->format('d F, Y') }}</span>
                            </li>
                        </ul>
                        <h1 class="my-3">{{ $me->name??'' }}</h1>
                        <div class="content text-left">
                            {!! $post->description ?? '' !!}
                        </div>
                    </article>
                    <div class="mt-5">

                    </div>
                </div>
                @include('frontend.partials.left-sidebar')
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection
