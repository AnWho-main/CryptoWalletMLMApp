@extends('Site.master')
@section('title', 'Blog-Details')
@section('sitecontent')
	<!-- Page Content Start -->
	<div class="page-content">
			
		<!-- Banner  -->
		<div class="dz-bnr-inr style-1 text-center">

			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1 class="text-center">Blog Details</h1>
					<!-- Breadcrumb Row -->
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog Details</li>
						</ul>
					</nav>
					<!-- Breadcrumb Row End -->
				</div>
			</div>
			<img class="bg-shape1" src="{{asset('site/images/home-banner/shape1.png')}}" alt="">
			<img class="bg-shape2" src="{{asset('site/images/home-banner/shape1.png')}}" alt="">
			<img class="bg-shape3" src="{{asset('site/images/home-banner/shape3.png')}}" alt="">
			<img class="bg-shape4" src="{{asset('site/images/home-banner/shape3.png')}}" alt="">
		
		</div>
		<!-- Banner End -->
		
		<!-- Blog Details -->
		<section class="content-inner" style="background: white;">
			<div class="container">
				<div class="row ">
					<div class="col-xl-8 col-lg-8">
						<div class="blog-single dz-card sidebar">
							<div class="dz-media dz-media-rounded">
								<img @if (is_null($blogDetails->info_img)) src="{{ asset('/site/nophoto.jpg') }}"
								@elseif (File::exists(public_path('/site/blog/' . $blogDetails->info_img))) 
								src="{{ asset('/site/blog/' . $blogDetails->info_img) }}" 
								@else src="{{ asset('/site/nophoto.jpg') }}" @endif height="100%" width="100%">
							</div>
							<div class="dz-info m-b30">
								<div class="dz-meta">
									<ul>
										<li class="post-author">
											<a href="javascript:void(0);">
												{{-- <img src="{{asset('site/images/avatar/avatar3.jpg')}}" alt="" >  --}}
												<span>{{$blogDetails->posted_by}}</span>
											</a>
										</li>
										<li class="post-date"><a href="javascript:void(0);">{{$blogDetails->created_at}}</a></li>
			
									</ul>
								</div>
								<h3 class="dz-title">{{$blogDetails->title}}</h3>
								<div class="dz-post-text">
								<p>{{$blogDetails->description}}</p>
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-xl-4 col-lg-4">
						<aside class="side-bar sticky-top right">
							<div class="widget">
								<div class="widget-title">
									<h4 class="title">Search</h4>
								</div>
								<div class="search-bx">
									<form role="search" method="post">
										<div class="input-group">
											<div class="input-skew">
												<input name="text" class="form-control" placeholder="Search.." type="text">
											</div>
											<span class="input-group-btn">
												<button type="submit" class="btn btn-primary sharp radius-no disabled"><i class="fa-solid fa-magnifying-glass scale3"></i></button>
											</span>
										</div>
									</form>
								</div>
							</div>

						

							<div class="widget recent-posts-entry">
								<div class="widget-title">
									<h4 class="title">Recent Post</h4>
								</div>
								<div class="widget-post-bx">
                                    @foreach ($recentPost as $post)
										
									<div class="widget-post clearfix">
										<div class="dz-media">
											<img @if (is_null($post->info_img)) src="{{ asset('/site/nophoto.jpg') }}"
											@elseif (File::exists(public_path('/site/blog/' . $post->info_img))) 
											src="{{ asset('/site/blog/' . $post->info_img) }}" 
											@else src="{{ asset('/site/nophoto.jpg') }}" @endif>
										</div>
										<div class="dz-info">
											<h6 class="title"><a href="{{route('blogDetails',$post->id)}}">{{$post->title}}</a></h6>
											<div class="dz-meta">
												<ul>
													<li class="post-date"><a href="javascript:void(0);"> {{$post->created_at}}</a></li>
												</ul>
											</div>
										</div>
									</div>

									@endforeach
									
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</section>
		<!-- Blog Details -->

	</div>
	<!-- Page Content End -->
@endsection