@extends('Site.master')
@section('title', 'FAQ')
@section('sitecontent')
    <!-- Page Content Start -->
    <div class="page-content">

        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Frequently Asked Questions</h1>
                    <p class="text">We Are Avilable For You 24/7..</p>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumb Row End -->
                </div>
            </div>
            <img class="bg-shape1" src="images/home-banner/shape1.png" alt="">
            <img class="bg-shape2" src="images/home-banner/shape1.png" alt="">
            <img class="bg-shape3" src="images/home-banner/shape3.png" alt="">
            <img class="bg-shape4" src="images/home-banner/shape3.png" alt="">
        </div>
        <!-- Banner End -->

        <!-- WhitePaper box -1 start  -->
        <section class="content-inner about-sec bg-primary" style="background-image: url(images/background/bnr.png);">
            <div class="container">
                <div class="row about-bx2 style-1 align-items-center">
                    <div class="col-lg-6 col-xl-6">
                        <div class="blog-single sidebar">
                            <div class="dz-media dz-media-rounded">
                                <img src="{{ asset('site/svg/faqs.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 m-b30 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">

                                        <div class="nav flex-column nav-pills mb-3">
                                            @foreach ($faqs as $faq)
                                                <a href="#v-pills-{{ $faq->id}}" data-bs-toggle="pill"
                                                    class="nav-link">{{ $faq->title }}</a>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="col-sm-8">
                                        <div class="tab-content">
                                            @foreach ($faqs as $faq)
                                                <div id="v-pills-{{ $faq->id }}" class="tab-pane fade">
                                                    <p> {{ $faq->description }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
            <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        </section>
        <!-- whitepaper Box style -1 end  -->
    </div>
    <!-- Page Content End -->
@endsection
