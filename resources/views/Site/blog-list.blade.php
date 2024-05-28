@extends('Site.master')
@section('title', 'Blog-list')
@section('sitecontent')

    	<!-- Page Content Start -->
	<div class="page-content">

		<!-- Banner  -->
		<div class="dz-bnr-inr style-1 text-center">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>Blog</h1>
					<p class="text">Transfer USD, EUR, or Crypto and start trading today!</p>
					<!-- Breadcrumb Row -->
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog</li>
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



		<!-- blog-list section start -->
		<section class="content-inner bg-white">
			<div class="container">
				<div class="row ">
					<div class="col-xl-8 col-lg-8">
						<div class="row">
							@foreach ($blogList as $blog)
				
							<div class="col-lg-12 m-b40">
								<div class="dz-card style-1 blog-half">
									<div class="dz-media">
										<a href="{{route('blogDetails',$blog->id)}}"><img @if (is_null($blog->info_img)) src="{{ asset('/site/nophoto.jpg') }}"
											@elseif (File::exists(public_path('/site/blog/' . $blog->info_img))) 
											src="{{ asset('/site/blog/' . $blog->info_img) }}" 
											@else src="{{ asset('/site/nophoto.jpg') }}" @endif></a>
										{{-- <ul class="dz-badge-list">
											<li><a href="javascript:void(0);" class="dz-badge">14 Fan 2022</a></li>
										</ul> --}}
										@if (strlen($blog->description) > 200)
										<a href="{{route('blogDetails',$blog->id)}}" class="btn btn-secondary">Read More</a>
									    @endif
									</div>
									<div class="dz-info">
										<div class="dz-meta">
											<ul>
												<li class="post-author">
													<a href="javascript:void(0);">
														{{-- <img src="images/avatar/avatar1.jpg" alt=""> --}}
														<span>{{$blog->posted_by}}</span>
													</a>
												</li>
												<li class="post-date"><a href="javascript:void(0);">{{$blog->created_at}}</a></li>
											</ul>
										</div>
										<h4 class="dz-title"><a href="{{route('blogDetails',$blog->id)}}">{{$blog->title}}</a></h4>
										<p class="m-b0">
											{{ Str::limit($blog->description, 200, '') }}
											@if (strlen($blog->description) > 200)
											<span class="m-b4"> ....</span>
											<a href="{{route('blogDetails',$blog->id)}}">Read More</a>
											@endif
										</p>
									
									</div>
								</div>
							</div>
							@endforeach
							<div class="col-xl-12 col-lg-12 m-b30 m-t30 m-lg-t10">
								<nav aria-label="Blog Pagination">
									{{ $blogList->render('pagination::bootstrap-4') }}
								</nav>
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
		<!-- blog-list section start -->

    </div>
	<!-- Page Content End -->
@endsection