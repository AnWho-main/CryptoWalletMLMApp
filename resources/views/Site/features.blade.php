@extends('Site.master')
@section('title','Features')
@section('sitecontent')
@php
    $org = \AppHelper::instance()->orgProfile();
@endphp
    <!-- Page Content Start -->
    <div class="page-content">

        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Our Services</h1>
                    <p class="text">{{$org['organization_name']}} Platform specialized in only your crypto related requirements ,</p>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
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

        <!-- Crypto From And Services Start -->
        <section class="content-inner bg-light icon-section section-wrapper2">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="title">{{$org['organization_name']}}Speciality,</h2>
                </div>
                <div class="row sp60">
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon9.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">The Minimum Pricing Facility (MPF) </h4>
                                <p class="m-b0">In our system guarantees that your earnings will never fall below a specified minimum level, providing financial security and
                                    stability for participants. Join our system today to benefit from this essential feature.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon10.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Crypto Education</h4>
                                <p class="m-b0">With the increasing interest in cryptocurrencies, educational services and courses have emerged to teach individuals about blockchain technology and trading strategies.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon11.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Investment</h4>
                                <p class="m-b0">I-Techniques managed funds that invest in a portfolio of cryptocurrencies. They are a way for investors to gain exposure to the crypto market without directly holding assets.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon12.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Security</h4>
                                <p class="m-b0">We prioritize the utmost security for both your data and currency. Our robust encryption measures and multi-layered security protocols ensure that your information remains confidential and your assets are safeguarded against any potential threats or breaches.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="1.0s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon12.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Fast Transaction</h4>
                                <p class="m-b0">Every minute counts when buying or selling in cryptocurrencies. Complete your transactions as quickly as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="1.0s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon12.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Wallet Services</h4>
                                <p class="m-b0">I-Techniques wallets store digital assets securely. There are different types, including your coins and tokens</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        </section>
        <!-- Crypto From And Services End -->
    </div>
    <!-- Page Content End -->
@endsection
