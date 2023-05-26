<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0" href="{{ url('/') }}">
                <img loading="prelaod" height="60" width="60" decoding="async" class="img-fluid"
                    src="{{ Storage::url('users/' . $settings->company_logo ?? '') }}"
                    alt="{{ $settings->name ?? '' }}">
            </a>
            <div class="navbar-actions order-3 ml-0 ml-md-4">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button"
                    data-toggle="collapse" data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <form action="{{ route('search') }}" class="search order-lg-3 order-md-2 order-3 ml-auto">
                <input id="search-query" name="search" value="{{ old('search',request()->search??'') }}" type="search" placeholder="Search..." autocomplete="off" />
            </form>
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('about.me') }}">About Me</a>
                    </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Articles
                        </a>
                        <div class="dropdown-menu">
                            @foreach ($categories as $category)
                                <a class="dropdown-item"
                                    href="{{ route('blog.categories', $category->slug) }}">{{ $category->name ?? '' }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
