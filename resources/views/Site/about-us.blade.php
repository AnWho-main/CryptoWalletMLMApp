@extends('Site.master')
@section('title','About Us')
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
                    <h1>About Us</h1>
                    <p class="text">Transfer USD, EUR, or Crypto and start trading today!</p>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
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


        <!-- About Box style -1 start  -->
        <section class="content-inner about-sec bg-primary-light" style="background-image: url(images/background/bnr.png);">
            <div class="container">
                <div class="row about-bx2 style-1 align-items-center">
                    <div class="col-lg-6">
                        <div class="dz-media">
                            <div class="row align-items-end">
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="image-box image-box-1">
                                        <img src="{{ asset('site/images/about/about-4.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="image-box image-box-2">
                                        <img src="{{ asset('site/images/about/about-2.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="image-box image-box-3">
                                        <img src="{{ asset('site/images/about/about-3.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-6 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="image-box image-box-4">
                                        <img src="{{ asset('site/images/about/about-1.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 about-content ps-lg-5 m-b30 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="section-head">
                            <h2 class="title">About {{$org['organization_name']}}</h2>
                            <p class="m-0 lh-base">Welcome to {{$org['organization_name']}}, which started its operations in the year July
                                2023, Introducing a new technology of making money. It is Authorized India based program,
                                which is latest fully automated and highly secure with latest technology. Our highly
                                educated and skilled Developers are managing and upgrading this Program. Company running its
                                all servers and services from India having multiple branches in World to Provide powerful
                                customer support and services.</p>
                        </div>
                        <a href="#management" class="btn btn-sm btn-primary btn-shadow text-uppercase">Management</a>
                        <a href="{{ asset('contact-us') }}" class="btn btn-sm btn-primary btn-shadow text-uppercase"
						style="margin-left: 60px;">Contact
                            Us</a><br><br>
                        <a href="{{route('features')}}" class="btn btn-sm btn-primary btn-shadow text-uppercase">Business Opportunity</a>
                        <a href="{{route('index')}}" class="btn btn-sm btn-primary btn-shadow text-uppercase">Achiever</a>
                    </div>
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
            <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        </section>
        <!-- About Box style -1 end  -->

        <!--Our mission section start -->
        <section class="content-inner about-sec bg-primary-light" style="background-image: url(images/background/bnr.png);">
            <div class="container">
                <div class="row about-bx2 style-1 align-items-center">
                    <div class="col-lg-6 about-content ps-lg-5 m-b30 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="section-head">
                            <h2 class="title">Our Mission</h2>
                            <p class="m-0 lh-base">To provide competitive and premium-quality services to the clients, we
                                are working hard to increase our visibility and achieve rapid growth. The company continues
                                its legacy of striving to reach the top, and fortunately, it is improving every day. We will
                                always serve the clients and welcome their feedback to enhance our services and technology,
                                building trust in us. We are making every effort to develop further. The world's biggest
                                market awaits more profit for you. Join us and experience {{$org['organization_name']}}.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 about-content ps-lg-5 m-b30 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="section-head">
                            <h2 class="title">Our Vision</h2>
                            <p class="m-0 lh-base">Every single minute of every person should be dedicated to strengthening
                                the powerful system. We must believe in our completely transparent system. We aim for our
                                system to receive high recommendations from our investors and partners. We endeavor to
                                provide our clients with the best available options, requiring the lowest possible
                                investment while offering high returns. Let's turn the dream into reality with our
                                fast-growing worldwide program. Get true value for your money with us – the best advice from
                                our intelligent program and complete satisfaction.</p>
                        </div>
                    </div>
                </div>
            </div>
            <img class="bg-shape1" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape2" src="{{ asset('site/images/home-banner/shape1.png') }}" alt="">
            <img class="bg-shape3" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
            <img class="bg-shape4" src="{{ asset('site/images/home-banner/shape3.png') }}" alt="">
        </section>
        <!-- Our mission section End -->
		
		<!-- Blog Grid Starts -->
		<section class="content-inner" id="management">
			<div class="container">
				<div class="dz-bnr-inr-entry text-center">
                    <h1 class="text text-primary">Management</h1>
                    <p class="text">Awesome Team</p>
				</div>
				<div class="row">
                @foreach ($dData as $peo)
					<div class="col-md-6 col-xl-3 m-b30 text-center">
						<div class="dz-card style-1 blog-lg overlay-shine bg-primary-light">
							<div class="dz-media">
                            {{$peo->photo}}
								<img src="{{asset('site//svg/pic1.png')}}" alt="" height="50%" width="70%">
							</div>
							<div class="dz-info">
                            <h4 class="dz-title">{{$peo->name}}</h4>
								<h5 class="dz-title">{{$peo->designation}}</h5>
								<p>{!!$peo->description!!}</p>
							</div>
						</div>
					</div>
              @endforeach
              
					
				</div>
			</div>
		
		</section>
		<!-- blog grid code starts from here -->
                <!-- WhitePaper box -1 start  -->
                <section class="content-inner about-sec bg-primary"
                style="background-image: url(images/background/bnr.png);">
                <div class="container">
                    <div class="row about-bx2 style-1 align-items-center">
                        <div class="col-lg-6 col-xl-6">
                            <div class="blog-single sidebar">
                                <div class="dz-media dz-media-rounded">
                                    <img src="{{ asset('site/images/features/whitepaper.png') }}" alt="" style="opacity: 0.8">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 m-b30 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="dz-card style-1">
                                <div class="dz-info">
    
                                    <h2 class="dz-title">Downoad Our Whitepaper</h2>
                                    <div class="dz-meta">
                                        <p>Explore the intricacies of our cutting-edge cryptocurrency platform by downloading
                                            our comprehensive company white paper. Delve into the details of our innovative
                                            technologies, secure protocols, and forward-thinking strategies that power our
                                            crypto website. Our white paper provides a deep dive into the foundations of our
                                            platform, showcasing how we are revolutionizing the crypto landscape. Discover the
                                            unique features, benefits, and opportunities that await you. Stay informed and
                                            educated about the future of cryptocurrency – download our company white paper
                                            today.
                                        </p>
                                        <a class="btn btn-primary btn-gradient btn-shadow text-uppercase" href="{{asset('upload/gallery/llc.pdf')}}" target="blank">get whitepaper</a>
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
