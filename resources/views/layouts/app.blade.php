<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ !empty($meta_title) ? $meta_title.' - Magic Print' : 'Magic Print' }}</title>
    @if(!empty($meta_keywords))
    <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    @if(!empty($meta_description))
    <meta name="description" content="{{ $meta_description }}">
    @endif

    <link rel="shortcut icon" href="{{ url('assets/images/icons/favicon.ico') }}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/magnific-popup/magnific-popup.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    @yield('style')
    <style type="text/css">
        .btn-whishlist-add::before {
            content: "\f233" !important;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        @include('layouts._header')

        @yield('content')

        @include('layouts._footer')


    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>

    @include('layouts._mobile_menu')


    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    @if(!empty(session('error_signin')) || !empty(session('success_email')) || !empty(session('success')))
                                    @include('admin.layouts._message')
                                    @endif
                                    <form action="{{ url('login_user') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="singin_email">Username or email address <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="singin_email" name="singin_email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="singin_password">Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" id="singin_password" name="singin_password" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin_remember" name="is_remember">
                                                <label class="custom-control-label" for="signin_remember">Remember Me</label>
                                            </div>
                                            <a href="{{ url('forgot_password') }}" class="forgot-link">Forgot Your Password?</a>
                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    @if(!empty(session('error_register')) || !empty(session('success_register')))
                                    @include('admin.layouts._message')
                                    @endif
                                    <form action="{{ url('register')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name">Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your email address <span style="color:red">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            {{-- <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div> --}}
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Plugins JS File -->
    <script src="{{ url('assets/js/jquery.min.js')}}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{ url('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ url('assets/js/superfish.min.js')}}"></script>
    <script src="{{ url('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ url('assets/js/jquery.magnific-popup.min.js')}}"></script>
    @yield('scripts')
    <!-- Main JS File -->
    <script src="{{ url('assets/js/main.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            @if(session('error_signin') || session('success_email')) 
                $('#signin-modal').modal('show');
            @endif
            @if(session('error_register') || session('success_register'))
                $('#signin-modal').modal('show');
                $('#register-tab').tab('show');
            @endif
            @if(session('success_reset'))
                alert('Your password has been reset');
            @endif
        });

        $('body').delegate('.add_to_wishlist', 'click', function(e) {
            var product_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "{{ url('user/add_to_wishlist') }}",
                data: {
                    product_id: product_id,
                    _token: '{{ csrf_token() }}'

                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if (data.is_wishlisted == 1) {
                        $('.whislist_add' + product_id).addClass('btn-whishlist-add');
                    } else {
                        $('.whislist_add' + product_id).removeClass('btn-whishlist-add');
                    }
                }
            });
        })
        
    </script>
</body>



</html>