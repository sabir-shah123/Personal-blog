@extends('frontend.layouts.app')
@section('styles')
@endsection
@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4"> <a href="index.html">Home</a>
                        <span class="mx-1">/</span> <a href="#!">Contact</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pr-0 pr-lg-4">
                        <div class="content">{{ $settings->aboutus ?? '' }}
                            <div class="mt-5">
                                <p class="h3 mb-3 font-weight-normal"><a class="text-dark"
                                        href="mailto:hello@reporter.com">{{ $settings->email ?? '' }}</a>
                                </p>
                                <p class="mb-3"><a class="text-dark" href="tel:&#43;211234565523">&#43;211234565523</a>
                                </p>
                                <p class="mb-2">
                                    {{ $settings->address ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <form method="POST" action="{{ route('contact.message') }}" class="row">
                        @csrf
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-4" placeholder="Name" name="name"
                                id="name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control mb-4" placeholder="Email" name="email"
                                id="email">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-4" placeholder="Subject" name="subject"
                                id="subject">
                        </div>
                        <div class="col-12">
                            <textarea name="message" id="message" class="form-control mb-4" placeholder="Type You Message Here" rows="5"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-primary" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('textarea#message').characterCounter();

        $(function() {
            $(document).on('submit', '#contact-us', function(e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('contact.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function() {
                        $(btn).addClass('disabled');
                        $(btn).empty().append(
                            '<span>LOADING...</span><i class="material-icons right">rotate_right</i>'
                        );
                    },
                    success: function(data) {
                        if (data.message) {
                            M.toast({
                                html: data.message,
                                classes: 'green darken-4'
                            })
                        }
                    },
                    error: function(xhr) {
                        M.toast({
                            html: 'ERROR: Failed to send message!',
                            classes: 'red darken-4'
                        })
                    },
                    complete: function() {
                        $('form#contact-us')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append(
                            '<span>SEND</span><i class="material-icons right">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })
    </script>
@endsection
