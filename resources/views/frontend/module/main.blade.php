@extends('frontend.master')
@section('content')

<!--================ Home Banner Area =================-->
<section class="home_banner_area">
		<div class="owl-carousel owl-theme" id="home-owl">
			<div class="slide-item owl-lazy" data-src="{{asset('assets/frontend/img/banner/home-banner.jpg')}}">
				<div class="container">
					<div class="row">
						<div class="col-lg-5"></div>
						<div class="col-lg-7">
							<div class="blog_text_slider">
								<div class="blog_text">
									<img class="img-fluid" src="{{asset('assets/frontend/img/banner/banner-img.png')}}" alt="">
									<div class="blog-meta bottom d-flex justify-content-between align-items-center flex-wrap">
										<div class="meta">
											<span class="icon fa fa-calendar"></span> March 14, 2018
											<span class="icon fa fa-comments"></span> 05
										</div>
										<div>
											<a class="read_more" href="#">Read More</a>
											<i class=""></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slide-item owl-lazy" data-src="{{asset('assets/frontend/img/banner/home-banner2.jpg')}}">
				<div class="container">
					<div class="row">
						<div class="col-lg-5"></div>
						<div class="col-lg-7">
							<div class="blog_text_slider">
								<div class="blog_text">
									<img class="img-fluid" src="{{asset('assets/frontend/img/banner/banner-img2.png')}}" alt="">
									<div class="blog-meta bottom d-flex justify-content-between align-items-center flex-wrap">
										<div class="meta">
											<span class="icon fa fa-calendar"></span> March 14, 2018
											<span class="icon fa fa-comments"></span> 05
										</div>
										<div>
											<a class="read_more" href="#">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slide-item owl-lazy" data-src="{{asset('assets/frontend/img/banner/home-banner3.jpg')}}">
				<div class="container">
					<div class="row">
						<div class="col-lg-5"></div>
						<div class="col-lg-7">
							<div class="blog_text_slider">
								<div class="blog_text">
									<img class="img-fluid" src="{{asset('assets/frontend/img/banner/banner-img3.png')}}" alt="">
									<div class="blog-meta bottom d-flex justify-content-between align-items-center flex-wrap">
										<div class="meta">
											<span class="icon fa fa-calendar"></span> March 14, 2018
											<span class="icon fa fa-comments"></span> 05
										</div>
										<div>
											<a class="read_more" href="#">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Home Banner Area =================-->

	<!--================ Travel Category Area =================-->
	<section class="travel_category">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main_title">
						<h1>Best Travel Experience Within the Universe.</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row owl-carousel" id="travel_cat">
				<div class="single_travel wow fadeIn" data-wow-duration="1s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t1.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t2.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".6s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t3.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".9s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t1.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".6s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t2.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".9s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t3.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".6s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t1.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="single_travel wow fadeIn" data-wow-duration="1s" data-wow-delay=".9s">
					<figure>
						<img class="img-fluid" src="{{asset('assets/frontend/img/travel/t2.jpg')}}" alt="">
					</figure>
					<div class="overlay"></div>
					<div class="text-wrap">
						<h3>
							<a href="#">Waterfall Travel</a>
						</h3>
						<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
							<div class="meta">
								<a href="#">
									<span class="icon fa fa-calendar"></span> March 14, 2018
									<span class="icon fa fa-comments"></span> 05
								</a>
							</div>
							<div>
								<a class="read_more" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Travel Category Area =================-->

	<!--================ Latest Blog Area =================-->
	<section class="latest_blog_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main_title">
						<h1>Latest
							<br> Blog Posts.</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="single_travel wow fadeInUp" data-wow-duration="1s">
						<figure>
							<img class="img-fluid w-100" src="{{asset('assets/frontend/img/blog-post/b1.jpg')}}" alt="">
						</figure>
						<div class="overlay"></div>
						<div class="text-wrap">
							<h3>
								<a href="#">Waterfall Travel</a>
							</h3>
							<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> March 14, 2018
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
								<div>
									<a class="read_more" href="#">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single_travel wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
						<figure>
							<img class="img-fluid w-100" src="{{asset('assets/frontend/img/blog-post/b2.jpg')}}" alt="">
						</figure>
						<div class="overlay"></div>
						<div class="text-wrap">
							<h3>
								<a href="#">Waterfall Mountain Island</a>
							</h3>
							<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> March 14, 2018
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
								<div>
									<a class="read_more" href="#">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single_travel wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
						<figure>
							<img class="img-fluid w-100" src="{{asset('assets/frontend/img/blog-post/b3.jpg')}}" alt="">
						</figure>
						<div class="overlay"></div>
						<div class="text-wrap">
							<h3>
								<a href="#">Waterfall Mountain Island</a>
							</h3>
							<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> March 14, 2018
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
								<div>
									<a class="read_more" href="#">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="single_travel wow fadeInUp mt--60" data-wow-duration="1s" data-wow-delay=".6s">
						<figure>
							<img class="img-fluid w-100" src="{{asset('assets/frontend/img/blog-post/b4.jpg')}}" alt="">
						</figure>
						<div class="overlay"></div>
						<div class="text-wrap">
							<h3>
								<a href="#">Waterfall Mountain Island</a>
							</h3>
							<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> March 14, 2018
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
								<div>
									<a class="read_more" href="#">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="single_travel wow fadeInUp mt--60" data-wow-duration="1s" data-wow-delay=".8s">
						<figure>
							<img class="img-fluid w-100" src="{{asset('assets/frontend/img/blog-post/b5.jpg')}}" alt="">
						</figure>
						<div class="overlay"></div>
						<div class="text-wrap">
							<h3>
								<a href="#">Waterfall Mountain Island</a>
							</h3>
							<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> March 14, 2018
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
								<div>
									<a class="read_more" href="#">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-md-12">
					<div class="single_travel wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
						<figure>
							<img class="img-fluid w-100" src="{{asset('assets/frontend/img/blog-post/b6.jpg')}}" alt="">
						</figure>
						<div class="overlay"></div>
						<div class="text-wrap">
							<h3>
								<a href="#">Waterfall Travel</a>
							</h3>
							<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> March 14, 2018
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
								<div>
									<a class="read_more" href="#">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="offset-lg-7 col-lg-4">
					<div class="blog-meta bottom d-flex justify-content-end align-items-center">
						<div>
							<a class="read_more" href="#">Load More Posts</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Latest Blog Area =================-->

	<!--================ Places Area =================-->
	<section class="different_places">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main_title">
						<h1>Let Us Find Your Places Within a Sec.</h1>
						<p>
							There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s
							exciting to think
							about setting up your own viewing station.
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="single_place wow fadeIn text-center mt-480" data-wow-duration="1s">
						<img class="img-fluid w-100" src="{{asset('assets/frontend/img/places/p1.jpg')}}" alt="">
						<div class="overlay"></div>
						<h4>Waterfall
							<br> Mountain Island</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single_place wow fadeIn text-center mt-240" data-wow-duration="1s" data-wow-delay=".2s">
						<img class="img-fluid w-100" src="{{asset('assets/frontend/img/places/p2.jpg')}}" alt="">
						<div class="overlay"></div>
						<h4>Waterfall
							<br> Mountain Island</h4>
					</div>
					<div class="single_place wow fadeIn text-center" data-wow-duration="1s" data-wow-delay="1s">
						<img class="img-fluid w-100" src="{{asset('assets/frontend/img/places/p3.jpg')}}" alt="">
						<div class="overlay"></div>
						<h4>Waterfall
							<br> Mountain Island</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single_place wow fadeIn text-center" data-wow-duration="1s" data-wow-delay=".4s">
						<img class="img-fluid w-100" src="{{asset('assets/frontend/img/places/p4.jpg')}}" alt="">
						<div class="overlay"></div>
						<h4>Waterfall
							<br> Mountain Island</h4>
					</div>
					<div class="single_place wow fadeIn text-center" data-wow-duration="1s" data-wow-delay=".8s">
						<img class="img-fluid w-100" src="{{asset('assets/frontend/img/places/p5.jpg')}}" alt="">
						<div class="overlay"></div>
						<h4>Waterfall
							<br> Mountain Island</h4>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single_place wow fadeIn text-center mt-240" data-wow-duration="1s" data-wow-delay=".6s">
						<img class="img-fluid w-100" src="{{asset('assets/frontend/img/places/p6.jpg')}}" alt="">
						<div class="overlay"></div>
						<h4>Waterfall
							<br> Mountain Island</h4>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Places Area =================-->

	<!--================ Popular Post Area =================-->
	<section class="popular_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="main_title">
						<h1>Popular <br> Posts to Remember</h1>
						<p>
							There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s
							exciting to think
							about setting up your own viewing station.
						</p>
					</div>
				</div>
			</div>

			<div class="row">

				@foreach ($posts as $post)
				<div class="col-lg-4 col-md-6">
					<div class="single-popular-post d-flex align-items-center flex-row">
						<div class="icon">
							<img height="100px" width="100px" src="{{asset($post->image)}}" alt="">
						</div>
						<div class="desc">
							<h4>
								<a href="#">{{$post->title}}</a>
							</h4>
							<div class="blog-meta d-flex justify-content-between align-items-center flex-wrap">
								<div class="meta">
									<a href="#">
										<span class="icon fa fa-calendar"></span> {{$post->created_at->format('D M d, Y')}}
										<span class="icon fa fa-comments"></span> 05
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</section>
	<!--================ End Popular Post Area =================-->

@endsection