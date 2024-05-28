@extends('Site.master')
@section('title', 'Home')
@section('sitecontent')
    @php
        $org = \AppHelper::instance()->orgProfile();
    @endphp
    <!-- Page Content Start -->
    <div class="page-content">

        <!-- Main Banner Start -->
        <div class="main-bnr style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <h1 class="wow fadeInUp" data-wow-delay="0.2s">What is Cryptocurrency?</h1>
                        <p class="text text-white wow fadeInUp" data-wow-delay="0.6s">A cryptocurrency is a
                            digital or virtual currency that is secured by cryptography, which makes it nearly
                            impossible to counterfeit or double-spend.
                           {{--  Many cryptocurrencies are decentralized
                            networks based on blockchain technology—a distributed ledger enforced by a distributed
                            network of computers. A defining feature of cryptocurrencies is that they are generally
                            not issued by any central authority, rendering them theoretically immune to government
                            interference or manipulation. --}}</p>
                        <a href="{{route('member-signin')}}"
                            class="btn space-lg btn-gradient btn-shadow btn-primary wow fadeInUp"
                            data-wow-delay="0.6s">Login</a>
                        <ul class="image-before">
                            <li class="left-img"><img src="{{ asset('site/images/home-banner/img1.png') }}" alt="">
                            </li>
                            <li class="right-img"><img src="{{ asset('site/images/home-banner/1.png') }}" alt="">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
            <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        </div>
        <!-- Main Banner End -->

        <!-- Crypto Coins Start -->
        {{-- <div class="clearfix bg-primary-light">
            <div class="container">
                <div class="currancy-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 m-b30 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-bx-wraper style-1 box-hover">
                                <div class="icon-media">
                                    <img src="{{ asset('site/images/coins/coin4.png') }}" alt="">
                                    <div class="icon-info">
                                        <h5 class="title">Bitcoin</h5>
                                        <span>BTC</span>
                                    </div>
                                </div>
                                <div class="icon-content">
                                    <ul class="price">
                                        <li>
                                            <h6 class="mb-0 amount">$16,048.40</h6>
                                            <span class="text-red percentage">-1.26%</span>
                                        </li>
                                        <li>
                                            <span>Latest price</span>
                                            <span>24h change</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 m-b30 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-bx-wraper style-1 box-hover">
                                <div class="icon-media">
                                    <img src="{{ asset('site/images/coins/coin3.png') }}" alt="">
                                    <div class="icon-info">
                                        <h5 class="title">Ethereum</h5>
                                        <span>ETH</span>
                                    </div>
                                </div>
                                <div class="icon-content">
                                    <ul class="price">
                                        <li>
                                            <h6 class="mb-0 amount">$1,122.44</h6>
                                            <span class="text-red percentage">-1.55%</span>
                                        </li>
                                        <li>
                                            <span>Latest price</span>
                                            <span>24h change</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 m-b30 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-bx-wraper style-1 box-hover">
                                <div class="icon-media">
                                    <img src="{{ asset('site/images/coins/coin1.png') }}" alt="">
                                    <div class="icon-info">
                                        <h5 class="title">Tether</h5>
                                        <span>USDT</span>
                                    </div>
                                </div>
                                <div class="icon-content">
                                    <ul class="price">
                                        <li>
                                            <h6 class="mb-0 amount">$1.00</h6>
                                            <span class="text-green percentage">0.0099%</span>
                                        </li>
                                        <li>
                                            <span>Latest price</span>
                                            <span>24h change</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Crypto Coins End -->

        <!-- Why Trust Us Start -->
        <section class="clearfix section-wrapper1 bg-primary-light">
            <div class="container">
                <div class="content-inner-1">
                    <div class="section-head text-center">
                        <h2 class="title">What Is BNB (BEP20) & USDT Coins?</h2>
                        <p>We are reinventing the global equity Blockchain -that is a smart, secure and easy – to use
                            platform BNB (BEP20) & BUSD Coins is a Decentralized, open-source Blockchain-based operating
                            system with smart contract functionality, proof-of-stake principles as its consensus algorithm
                            and a cryptocurrency native to the system, known as BNB (BEP20) & BUSD Coins.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 m-b30 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-bx-wraper style-2">
                                <div class="icon-media">
                                    <img src="{{ asset('site/svg/token1.svg') }}" alt="">
                                </div>
                                <div class="icon-content">
                                    <h4 class="title">SEMI DECENTERLIZED</h4>
                                    <p>The Project is Semi Decentralized Program.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 m-b30 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-bx-wraper style-2">
                                <div class="icon-media">
                                    <img src="{{ asset('site/svg/token2.svg') }}" alt="">
                                </div>
                                <div class="icon-content">
                                    <h4 class="title">Safe & Secured Cripto Wallets</h4>
                                    <p>We are Working with Safe Zone by using Higher Security.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 m-b30 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-bx-wraper style-2">
                                <div class="icon-media">
                                    <img src="{{ asset('site/svg/token3.svg') }}" alt="">
                                </div>
                                <div class="icon-content">
                                    <h4 class="title">P2P (Peer to Peer)</h4>
                                    <p>No need to withdrawal any of your income</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="container">
                <div class="form-wrapper-box style-1 text-center">
                    <div class="section-head wow fadeInUp" data-wow-delay="0.2s">
                        <h4 class="title m-t0">How to Purchase from us ?</h4>
                        <p>Fill out the below form and we will contact you via email & details</p>
                    </div>
                    <form method="POST" class="dz-form" action="#">
                        <div class="form-wrapper">
                            <div class="flex-1">
                                <div class="row g-3">
                                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                        <input name="dzName" type="text" required=""
                                            placeholder="Wallet Address" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                                        <select class="form-control custom-image-select-1 image-select">
                                            <option data-thumbnail="{{ asset('site/images/coins/coin4.png') }}">
                                                Bitcoin</option>
                                            <option data-thumbnail="{{ asset('site/images/coins/coin3.png') }}">
                                                Ethereum</option>
                                            <option data-thumbnail="{{ asset('site/images/coins/coin1.png') }}">
                                                Tether</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                                        <input name="dzName" type="text" required=""
                                            placeholder="How much worth in $?" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                                        <input name="dzName" type="text" required=""
                                            placeholder="Email Address" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-gradient btn-primary btn-shadow">Get
                                Strated</button>
                        </div>
                    </form>
                </div>
            </div> --}}
            {{-- <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt=""> --}}
        </section>
        <!-- Why Trust Us End -->

        <!-- Crypto From And Services Start -->
        {{-- <section class="content-inner bg-light icon-section section-wrapper2">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="title">One-stop solution to buy and sell <span class="text-primary">
                            cryptocurrency </span> with Cash</h2>
                </div>
                <div class="row sp60">
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon9.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Competitive Pricing</h4>
                                <p class="m-b0">Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon10.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Support</h4>
                                <p class="m-b0">Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-bx-wraper style-3 text-center">
                            <div class="icon-media">
                                <img src="{{ asset('site/images/icons/icon11.svg') }}" alt="">
                            </div>
                            <div class="icon-content">
                                <h4 class="title">Fast and Easy KYC</h4>
                                <p class="m-b0">Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer.</p>
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
                                <p class="m-b0">Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer.</p>
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
                                <p class="m-b0">Every minute counts when buying or selling in cryptocurrencies.
                                    Complete your transactions as quickly as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 m-b60 wow fadeInUp" data-wow-delay="1.2s">
                        <div class="icon-bx-wraper style-4" style="background-image: url(images/about/pic1.jpg);">
                            <div class="inner-content">
                                <div class="icon-media m-b30">
                                    <img src="{{ asset('site/images/icons/support1.png') }}" alt="">
                                </div>
                                <div class="icon-content">
                                    <a href="contact-us.html" class="btn btn-primary">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
        </section> --}}
        <!-- Crypto From And Services End -->
        <section class="content-inner bg-light icon-section section-wrapper2"
            style="background-image: url({{ asset('site/images/background/bnr.png') }});">
            <div class="container">
                <div class="row about-bx2 style-1 align-items-center">
                    <div class="col-lg-6">
                        <div class="dz-media">
                            <div class="row align-items-end">
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="image-box image-box-1">
                                        <img src="{{ asset('site/images/about/descn-3.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="image-box image-box-2">
                                        <img src="{{ asset('site/images/about/descn-4.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="image-box image-box-4">
                                        <img src="{{ asset('site/images/about/descn-1.jpeg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="image-box image-box-4">
                                        <img src="{{ asset('site/images/about/descn-2.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 about-content ps-lg-5 m-b30 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="section-head">
                            <h5 class="title text text-black">
                                Semi Decentralized Network ?</h5>
                            <h4 class="title">What does “Semi Decentralize "mean ?? What are the advantages and what are
                                the
                                benefits ?</h4>
                            <p class="m-0 lh-base">Semi Decentralized marketing is created with an automated contract that
                                offers you maximum security and sustainability. A smart contract is an automatic execution
                                algorithm. It exists within the BUSD blockchain , one of the TOP cryptographic currencies.
                            </p>
                        </div>
                        {{-- <a href="contact-us.html" class="btn btn-lg btn-primary btn-shadow text-uppercase">Contact Us</a> --}}
                    </div>
                </div>
            </div>
        </section>

        <!-- About Box style -1 start  -->
        <section class="content-inner about-sec bg-primary-light" style="background-image: url(images/background/bnr.png);">
            <div class="container">
                <div class="row about-bx2 style-1 align-items-center">
                    <div class="col-lg-6 col-xl-6">
                        <div class="blog-single sidebar">
                            <div class="dz-media dz-media-rounded">
                                <img src="{{ asset('site/images/about/about-2.png') }}" alt="" height="50%" width="50%"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4 m-b30">
                        <div class="dz-card style-1 blog-lg overlay-shine">
                            <div class="dz-info">
                                <div class="dz-meta">
                                    <h3 class="dz-title">{{ $org['organization_name'] }} Platform.</h3>
                                </div>

                                <p>We are dedicated to providing professional service with the highest level of honestt and
                                    integrity, and advisory services</p>
                                <ul class="pricingtable-features">
                                    <li class="mb-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M23 12L20.56 9.21L20.9 5.52L17.29 4.7L15.4 1.5L12 2.96L8.6 1.5L6.71 4.69L3.1 5.5L3.44 9.2L1 12L3.44 14.79L3.1 18.49L6.71 19.31L8.6 22.5L12 21.03L15.4 22.49L17.29 19.3L20.9 18.48L20.56 14.79L23 12ZM9.38 16.01L7 13.61C6.61 13.22 6.61 12.59 7 12.2L7.07 12.13C7.46 11.74 8.1 11.74 8.49 12.13L10.1 13.75L15.25 8.59C15.64 8.2 16.28 8.2 16.67 8.59L16.74 8.66C17.13 9.05 17.13 9.68 16.74 10.07L10.82 16.01C10.41 16.4 9.78 16.4 9.38 16.01Z"
                                                fill="#9467FE" />
                                        </svg>
                                        <span>Competent Professionals</span>
                                    </li>
                                    <li class="mb-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M23 12L20.56 9.21L20.9 5.52L17.29 4.7L15.4 1.5L12 2.96L8.6 1.5L6.71 4.69L3.1 5.5L3.44 9.2L1 12L3.44 14.79L3.1 18.49L6.71 19.31L8.6 22.5L12 21.03L15.4 22.49L17.29 19.3L20.9 18.48L20.56 14.79L23 12ZM9.38 16.01L7 13.61C6.61 13.22 6.61 12.59 7 12.2L7.07 12.13C7.46 11.74 8.1 11.74 8.49 12.13L10.1 13.75L15.25 8.59C15.64 8.2 16.28 8.2 16.67 8.59L16.74 8.66C17.13 9.05 17.13 9.68 16.74 10.07L10.82 16.01C10.41 16.4 9.78 16.4 9.38 16.01Z"
                                                fill="#9467FE" />
                                        </svg>
                                        <span>Affordable Prices</span>
                                    </li>
                                    <li class="mb-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M23 12L20.56 9.21L20.9 5.52L17.29 4.7L15.4 1.5L12 2.96L8.6 1.5L6.71 4.69L3.1 5.5L3.44 9.2L1 12L3.44 14.79L3.1 18.49L6.71 19.31L8.6 22.5L12 21.03L15.4 22.49L17.29 19.3L20.9 18.48L20.56 14.79L23 12ZM9.38 16.01L7 13.61C6.61 13.22 6.61 12.59 7 12.2L7.07 12.13C7.46 11.74 8.1 11.74 8.49 12.13L10.1 13.75L15.25 8.59C15.64 8.2 16.28 8.2 16.67 8.59L16.74 8.66C17.13 9.05 17.13 9.68 16.74 10.07L10.82 16.01C10.41 16.4 9.78 16.4 9.38 16.01Z"
                                                fill="#9467FE" />
                                        </svg>
                                        <span>High Successful Recovery</span>
                                    </li>
                                    <li class="mb-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M23 12L20.56 9.21L20.9 5.52L17.29 4.7L15.4 1.5L12 2.96L8.6 1.5L6.71 4.69L3.1 5.5L3.44 9.2L1 12L3.44 14.79L3.1 18.49L6.71 19.31L8.6 22.5L12 21.03L15.4 22.49L17.29 19.3L20.9 18.48L20.56 14.79L23 12ZM9.38 16.01L7 13.61C6.61 13.22 6.61 12.59 7 12.2L7.07 12.13C7.46 11.74 8.1 11.74 8.49 12.13L10.1 13.75L15.25 8.59C15.64 8.2 16.28 8.2 16.67 8.59L16.74 8.66C17.13 9.05 17.13 9.68 16.74 10.07L10.82 16.01C10.41 16.4 9.78 16.4 9.38 16.01Z"
                                                fill="#9467FE" />
                                        </svg>
                                        <span>A New Way Of Making Money</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xl-2 m-b30 text-center">
                        <div class="dz-info">
                            <div class="dz-meta">
                                <h3 class="dz-title">{{$activeMembers}}</h3>
                            </div>
                            <p>Total Active Member</p>
                        </div>
                        <div class="dz-info">
                            <div class="dz-meta">
                                <h3 class="dz-title">20</h3>
                            </div>
                            <p>Team Advisors</p>
                        </div>
                        <div class="dz-info">
                            <div class="dz-meta">
                                <h3 class="dz-title">5</h3>
                            </div>
                            <p>Years of Experience</p>
                        </div>
                    </div>
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
            <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        </section>
        <!-- About Box style -1 end  -->

        <!-- jouning report section start -->

        <section   class="dz-bnr-inr-entry text-center">
                    <h1> Join with us </h1>
        </section>
        
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6  wow fadeInUp" data-wow-delay="0.2s">
                         <div class="card">
                         <div class="card-header border-0 pb-0 d-block">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="heading">Reporting</h3>
                                    </div>
                                </div>
                            </div>
                            <style>
                                ul li{
                                   font-size: 100%; 
                                   padding-bottom: 11px;
                                }
                              
                            </style>
                            <ul class="pricingtable-features">
                                <!-- Modify topics -->
                                <li>
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                    <strong>Total joining - @if(!empty($joiningReport[0])) {{$joiningReport[0]}} @else No @endif Member</strong>
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                
                                    <strong>Total Today's joining -  @if(!empty($joiningReport[1])) {{$joiningReport[1]}} @else No @endif Member</strong>
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                    
                                    <strong>Total withdrawal - $ @if(!empty($joiningReport[2])) {{$joiningReport[2]}} @else 0 @endif</strong>
                                    
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                
                                    <strong>Total Today's withdrawal - $ @if(!empty($joiningReport[3])){{$joiningReport[3]}} @else 0 @endif</strong>
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                    
                                    <strong>Total Boosting -  @if(!empty($joiningReport[4])) {{$joiningReport[4]}} @else N/A @endif</strong>
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                
                                    <strong>Total Today's Boosting -  @if(!empty($joiningReport[5])) {{$joiningReport[5]}} @else N/A @endif</strong>
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                
                                    <strong>Total Boosting Received -  @if(!empty($joiningReport[6])) {{$joiningReport[6]}} @else N/A @endif</strong>
                                </li>
                                <li>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG path -->
                                    </svg>
                                    <!-- Change topic text -->
                                
                                    <strong>Total Today's Boosting Received -  @if(!empty($joiningReport[7])) {{$joiningReport[7]}} @else N/A @endif</strong>
                                </li>
                                
                                <!-- Add or modify other list items as needed -->
                            </ul>
                        
                        </div>
                  </div>
                        
                  <!-- recent joining st  -->
                  <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp">
                        <div class="card">
                            <div class="card-header border-0 pb-0 d-block">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="heading">Recent Joinings</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 pb-0 height450 dz-scroll">
                                <div class="contacts-list" id="RecentActivityContent" style="height: 300px; overflow-y: auto;">
                            @if(!is_null($rjoining))
                                    @php
                                    $i = 0;
                                    @endphp
                              @foreach($rjoining as $jon)
                                    <div class="d-flex justify-content-between mb-3 mt-3 pb-3">
                                        <div>
                                            <h6 class="mb-1">{{$jon->client_id}}</h6>
                                            <span class="text-">Joined on {{date('d-m-Y H:i:s',
                                    strtotime($jon->created_at));}} </span>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <!-- Repeat this structure for other recent joinings -->
                                </div>
                            </div>
                            <div class="card-footer border-0 pt-0">
                                <div class="text-center border-0 pt-3">
                                </div>
                            </div>
                        </div>
                    </div>
                  <!-- recent joining en  -->
                  </div>
            </div>
        </section>

        <!-- jouning report section end -->

        


        <!-- Business plan Starts -->
        <section class="content-inner">
            <div class="container">
                <div class="dz-bnr-inr-entry text-center">
                    <h4 class="text text-primary">Business Plan</h4>
                    <h1>Our I-Techniques Distribution</h1>
                    <p class="text">We are Giving 9 Types of Bonuses to our Valuable members. For more Details just need
                        to call and Contact our Executive or Read all the Plan Carefully in the Plan Chart below.</p>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-primary alert-dismissible alert-alt fade show">
                                    <strong>Sponsor Bonus – 25% - On Direct Joining</strong>
                                </div>
                                <div class="alert alert-secondary alert-dismissible alert-alt fade show">
                                    <strong>Level Income – 25% - On Level 01 up to Level 07</strong>
                                </div>
                                <div class="alert alert-success alert-dismissible alert-alt fade show">
                                    <strong>Autopool Bonus- 40% - On Direct Sponsor, to the Upline & Upline to Upline(Till
                                        3rd level)</strong>
                                </div>
                                <div class="alert alert-info alert-dismissible alert-alt fade show">
                                    <strong>Dividends Bonus :- 10% - On Nonworking</strong>
                                </div>
                                <div class="alert alert-warning alert-dismissible alert-alt fade show">
                                    <strong>Royality Bonus - 50%</strong>
                                </div>
                                <div class="alert alert-danger alert-dismissible alert-alt fade show">
                                    <strong>
                                        Package Income - 57%</strong>
                                </div>
                                <div class="alert alert-dark alert-dismissible alert-alt fade show">
                                    <strong>Package Level Bonus - 25%</strong>
                                </div>
                                <div class="alert alert-info alert-dismissible alert-alt fade show">
                                    <strong>Boosting Bonus - 300%</strong>
                                </div>
                                <div class="alert alert-primary alert-dismissible alert-alt fade show">
                                    <strong>Boosting Levelwise Income - 25%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- business plan end -->
        <!-- Latest News & Achievement  Starts -->

        <section class="content-inner bg-white blog-wrapper">
            <img class="bg-shape1" src="images/home-banner/shape1.png" alt="">

            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="section-head wow fadeInUp" data-wow-delay="0.2s">
                            <h2 class="title">Latest News</h2>
                        </div>
                        @foreach ($news as $new)
                        @if ($new->event_type == 'newsEvents' && $new->publish_date <= date('Y-m-d') && $new->valid_date >= date('Y-m-d'))
                        <div class="dz-card style-1 blog-half m-b30 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="dz-info">
                                <div class="dz-meta">
                                    <ul>
                                        <li class="post-date"><a href="javascript:void(0);">{{$new->pub_date}}</a></li>
                                    </ul>
                                </div>
                                <h4 class="dz-title"><a href="javascript:void(0);">{{$new->title}}</a></h4>
                                <p class="m-b0">
                                    @php
                                    echo html_entity_decode($new->descp, ENT_QUOTES);
                                  @endphp
                                </p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Latest News & achievment end -->

        <!-- Achievment Starts -->
        <section class="content-inner">
            <div class="container">
                <div class="dz-bnr-inr-entry text-center">
                    <h1>Achievers</h1>
                </div>
                <div class="row">
                    @foreach ($clientAchivers as $achiver)
                        <div class="col-md-6 col-xl-4 m-b30">
                            <div class="dz-card style-1 blog-lg overlay-shine">
                                <div class="dz-media">
                                    <a href="javascript:void(0);">
                                        <img @if (is_null($achiver->photo)) src="{{ asset('/site/nophoto.jpg') }}"
											@elseif (File::exists(public_path('/site/achivers/' . $achiver->photo))) 
											src="{{ asset('/site/achivers/' . $achiver->photo) }}" 
											@else src="{{ asset('/site/nophoto.jpg') }}" @endif
                                            height="100%" width="100%">
                                    </a>
                                </div>
                                <div class="dz-info">
                                    <div class="dz-meta">
                                        <ul>
                                            <li class="post-author">
                                                <a href="javascript:void(0);">
                                                    ID:
                                                    <span>{{ $achiver->client_id }}</span>
                                                </a>
                                            </li>
                                            <li class="post-date">
                                                <a href="javascript:void(0);">
                                                    Name:
                                                    <span>{{ $achiver->m_name }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h4 class="dz-title"><a href="javascript:void(0);">{{ $achiver->desg }}</a></h4>
                                    <p>{{ $achiver->achiv }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Achievment end -->
    </div>
    <!-- Page Content End -->
@endsection
