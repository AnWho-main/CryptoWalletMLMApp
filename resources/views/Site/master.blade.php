<!DOCTYPE html>
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
<html lang="en">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="description" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>@yield('title') | {{$org['organization_name']}}</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('/upload/logo/' . $org['favicon']) }}">

    <!-- Stylesheet -->
    <link href="{{ asset('site/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/vendor/animate/animate.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="loader">
	</div> --}}
    <!--*******************
        Preloader end
    ********************-->

    <div class="page-wraper">

        <!-- Header -->
        <header class="site-header mo-left header header-transparent style-1">

            <!-- Main Header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix">
                    <div class="container clearfix">

                        <!-- Website Logo -->
                        <div class="logo-header">
                            <a href="{{ route('index') }}" class="logo-dark"><img
                                src="{{ asset('/upload/logo/' . $org['logo']) }}" alt=""></a>
                            <a href="{{ route('index') }}" class="logo-light"><img
                                src="{{ asset('/upload/logo/' . $org['logo']) }}" alt=""></a>
                        </div>

                        <!-- Nav Toggle Button Strat -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- Nav Toggle Button End -->

                        <!-- Extra Nav Start -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <a class="btn btn-outline-primary text-white"
                                    href="{{route('member-signin')}}">Login</a>
                                <a class="btn btn-primary btn-gradient btn-shadow"
                                    href="{{route('member-registration',['CTHUB100100'])}}">Register</a>
                            </div>
                        </div>
                        <!-- Extra Nav End -->

                        <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">

                            <!-- Mobile Sidebar Logo -->
                            <div class="logo-header mostion">
                                <a href="{{ route('index') }}" class="logo-dark"><img src="{{ asset('/upload/logo/'.$org['logo']) }}" alt="" height="100%" width="100%"></a>
                            </div>

                            <!-- Navbar nav -->
                            <ul class="nav navbar-nav navbar">
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('about-us') }}">About Us</a></li>
                                <li><a href="{{ route('features') }}">Features</a></li>
                                <li><a href="{{ route('blog-list') }}">Blog</a></li>
                                <!-- <li><a href="{{ route('FAQ') }}">FAQ</a></li> -->
                                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                                <li><a href="{{ route('Report') }}">Search</a></li> 
                            </ul>

                            <!-- Mobile Sidebar bottom -->
                            <div class="header-bottom">
                                <div class="dz-social-icon">
                                    <ul>
                                        <li><a target="_blank" class="fab fa-facebook-f"
                                                href="{{$org['facebook']}}"></a></li>
                                        <li><a target="_blank" class="fab fa-twitter" href="{{$org['twitter']}}"></a>
                                        </li>
                                       {{-- <li><a target="_blank" class="fab fa-linkedin-in"
                                                href="{{$org['twitter']}}"></a></li>--}}
                                        <li><a target="_blank" class="fab fa-youtube"
                                                href="{{$org['youtube']}}"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Main Header End -->

        </header>
        <!-- Header -->


        <!-- Page Content Start -->
       @yield('sitecontent')
        <!-- Page Content End -->

        <!-- Footer -->
        <footer class="site-footer style-1" id="footer">
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">

            <div class="footer-top background-luminosity" style="background-image: url(images/background/bg1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="widget widget_about">
                                <div class="footer-logo logo-white">
                                    <a href="{{route('index')}}"><img src="{{ asset('/upload/logo/' . $org['logo']) }}"
                                            alt=""></a>
                                </div>
                                <p>Every single minute of every person should be dedicated to strengthening the powerful system. We must believe in our completely transparent system.</p>
                                <div class="dz-social-icon transparent space-10">
                                    <ul>
                                        <li><a target="_blank" class="fab fa-facebook-f"
                                                href="{{$org['facebook']}}"></a></li>
                                        <li><a target="_blank" class="fa-solid fa-location-dot"
                                                href="{{$org['google_map']}}"></a></li>
                                        <li><a target="_blank" class="fab fa-twitter"
                                                href="{{$org['twitter']}}"></a></li>
                                        <li><a target="_blank" class="fab fa-youtube"
                                                href="{{$org['youtube']}}"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="widget widget_services">
                                <h4 class="widget-title">Other Links</h4>
                                <ul>
                                    <li><a href="{{ route('index') }}">Home</a></li>
                                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                                    <li><a href="{{ route('features') }}">Features</a></li>
                                    <li><a href="{{ route('FAQ') }}">FAQ</a></li>
                                    <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="widget recent-posts-entry">
                                <h4 class="widget-title">Blog Posts</h4>
                                <div class="widget-post-bx">
                                    <div class="widget-post clearfix">
                                        <div class="dz-info">
                                            <h6 class="title"><a href="blog-details.html">What is cryptocurrency and
                                                    how does it work.</a></h6>
                                            <span class="post-date"> JUNE 18, 2022</span>
                                        </div>
                                    </div>
                                    <div class="post-separator"></div>
                                    <div class="widget-post clearfix">
                                        <div class="dz-info">
                                            <h6 class="title"><a href="blog-details.html">A cryptocurrency is a
                                                    digital currency.</a></h6>
                                            <span class="post-date"> AUGUST 22, 2022</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-xl-3 col-lg-4 col-sm-12 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="widget widget_locations">
                                <h4 class="widget-title">Locations</h4>
                                <div class="clearfix">
                                    <h6 class="title">{{$org['full_address']}}</h6>
                                    <p></p>
                                    <img src="{{ asset('site/images/footer/world-map-with-flags1.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Footer Bottom Part -->
            <div class="footer-bottom text-center">
                <div class="container">
                    {{-- <span class="copyright-text">Copyright © 2022 <a href="https://dexignzone.com/"
                            target="_blank">DexignZone</a>. All rights reserved.</span> --}}
                            <span class="copyright-text">Copyright © 2022 {{$org['organization_name']}} All rights reserved.</span>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- Bottom to top -->
        <button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button>

    </div>

    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="{{ asset('site/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
    <script src="{{ asset('site/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script><!-- WOW.JS -->
    <script src="{{ asset('site/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('site/vendor/wow/wow.js') }}"></script><!-- WOW.JS -->
    <script src="{{ asset('site/js/custom.js') }}"></script><!-- CUSTOM JS -->
</body>

</html>
