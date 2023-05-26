<footer class="bg-dark mt-5">
    <div class="container section">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <a class="d-inline-block mb-4 pb-2" href="{{ url('/') }}">
                    <img loading="prelaod" height="80" width="100" decoding="async" class="img-fluid"
                        src="{{ Storage::url('users/' . $settings->company_logo ?? '') }}"
                        alt="{{ $settings->name ?? '' }}">
                </a>
                <ul class="p-0 d-flex navbar-footer mb-0 list-unstyled">
                    <li class="nav-item my-0"> <a class="nav-link" href="{{ route('about.me') }}">About Me</a></li>
                    <li class="nav-item my-0"> <a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item my-0"> <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright bg-dark content">Designed &amp; Developed By <a href="{{ route('about.me') }}">Muhammad
            Sabir</a></div>
</footer>
