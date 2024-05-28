@extends('Site.master')
@section('title', 'Contact Us')
@section('sitecontent')
    @php
        $org = \AppHelper::instance()->orgProfile();
    @endphp
    <!-- Page Content Start -->
    <div class="page-content">

        <!-- Banner start -->
        <div class="dz-bnr-inr style-1 text-center">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Contact Us</h1>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumb Row End -->
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
            <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        </div>
        <!-- Banner End -->


        <!-- Contact form sectio starts from here -->
        <section class="content-inner contact-form-wraper style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-5 m-b30">
                        <div class="info-box">
                            <div class="info">
                                <h2>Contact Information</h2>
                                <p class="font-18">Fill up the form and our team will get back to you within 24 hours.</p>
                            </div>

                            <div class="widget widget_about">
                                <div class="widget widget_getintuch">
                                    <ul>
                                        <li>
                                            <i class="fa fa-phone"></i>
                                            <span>{{ $org['mobile'] }}</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <span>{{ $org['email'] }}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $org['full_address'] }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="social-box dz-social-icon style-3">
                                <h6>Our Socials</h6>
                                <ul class="social-icon">
                                    <li><a class="social-btn" target="_blank" href="{{ $org['facebook'] }}"><i
                                                class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a class="social-btn" target="_blank" href="{{ $org['google_map'] }}"><i
                                                class="fa-solid fa-location-dot"></i></a></li>
                                    <li><a class="social-btn" target="_blank" href="{{ $org['twitter'] }}"><i
                                                class="fa-brands fa-twitter"></i></a></li>
                                    <li><a class="social-btn" target="_blank" href="{{ $org['youtube'] }}"><i
                                                class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-7">
                        <div class="contact-box">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h2 class="mb-0">Get In touch</h2>
                                        @if ($message = Session::get('success'))
                                            <p class="mb-0 font-18 text-success">{{ $message }}</p>
                                        @elseif (count($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                                <p class="mb-0 font-18 text-danger">{{ $error }}</p>
                                            @endforeach
                                        @else
                                            <p class="mb-0 font-18 text-primary">We are here for you. How can we help?</p>
                                        @endif
                                    </div>
                                    <form class="dzForm" method="POST" action="{{ route('contact-details') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6 mb-3 mb-md-4">
                                                <input name="name" required type="text" class="form-control"
                                                    placeholder="Full Name" required>
                                            </div>
                                            <div class="col-xl-6 mb-3 mb-md-4">
                                                <input name="subject" type="text" class="form-control"
                                                    placeholder="Subject" required>
                                            </div>
                                            <div class="col-xl-6 mb-3 mb-md-4">
                                                <input name="email" required type="email" class="form-control"
                                                    placeholder="Email Address" required>
                                            </div>
                                            <div class="col-xl-6 mb-3 mb-md-4">
                                                <input name="mobile" required type="text" class="form-control"
                                                    placeholder="Phone No." maxlength="10" required>
                                            </div>
                                            <div class="col-xl-12 mb-3 mb-md-4">
                                                <textarea name="msg" required class="form-control" placeholder="Message" maxlength="100"></textarea>
                                            </div>
                                            <div class="col-xl-12">
                                                <button name="submit" type="submit" value="Submit"
                                                    class="btn btn-primary">Submit Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact form section ends from here -->


    </div>
    <!-- Page Content End -->
@endsection
