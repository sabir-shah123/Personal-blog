 @php
     use Illuminate\Support\Str;
 @endphp
 <div class="col-lg-4">
     <div class="widget-blocks">
         <div class="row">
             <div class="col-lg-12">
                 <div class="widget">
                     <div class="widget-body">
                         @if (Storage::disk('public')->exists('users/' . $me->image) && $me->image)
                             <img loading="lazy" decoding="async" src="{{ Storage::url('users/' . $me->image) }}"
                                 alt="{{ $me->name }}" class="w-100" width="420" height="280">
                         @else
                             <img loading="lazy" decoding="async" src="images/post/default-thumbnail.jpg"
                                 alt="Post Thumbnail" class="w-100" width="420" height="280">
                         @endif
                         <h2 class="widget-title my-3">{{ $me->name ?? '' }}</h2>
                         <p class="mb-3 pb-2">
                             {!! Str::limit($me->description, 100) !!}
                         </p>
                         <a href="{{ route('about.me') }}" class="btn btn-sm btn-outline-primary">Know More</a>
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
                                                     src="images/post/default-thumbnail.jpg" alt="Post Thumbnail"
                                                     class="w-100" width="420" height="280">
                                             @endif
                                         </div>
                                     </a>
                                     <div class="card-body px-0 pb-0">
                                         <ul class="post-meta mb-2">
                                             @foreach ($recommendedposts[0]->categories as $category)
                                                 <li>
                                                     <a
                                                         href="{{ route('blog.categories', $category->slug) }}">{{ $category->name }}</a>
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
                                                 src="images/post/default-thumbnail.jpg" alt="Post Thumbnail"
                                                 class="w-100" width="420" height="280">
                                         @endif
                                         <div class="media-body ml-3">
                                             <h3 style="margin-top: -5px">{{ $post->title }}</h3>
                                             <p class="mb-0 small">
                                                 {!! Str::limit($post->excerpt, 80) !!}
                                             </p>
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

             <div class="col-lg-12 col-md-6">
                 <div class="widget">
                     <h2 class="section-title mb-3">Tags</h2>
                     <div class="widget-body">
                         <ul class="widget-list">
                             @foreach ($tags as $tag)
                                 <li>
                                     <a href="#">{{ $tag->name }}
                                         <span class="ml-auto">({{ $tag->posts_count }})</span>
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
