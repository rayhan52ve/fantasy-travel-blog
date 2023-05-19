@extends('frontend.master')
@section('content')

<body>

	<!--================ Banner Area =================-->
	<section class="home_banner_area banner_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-5"></div>
				<div class="col-lg-7">
					<div class="blog_text_slider">
						<div class="blog_text">
							<img class="img-fluid" src="" alt="">
							<div class="blog-meta bottom d-flex justify-content-start align-items-center flex-wrap">
								<div>
									<a class="read_more" href="{{route('frontend')}}">Home</a>
									<span class="lnr lnr-arrow-right"></span>
									<a class="read_more" href="">Post</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Banner Area =================-->

	<!--================Archive Area =================-->
	<section class="archive_area section-gap">
		<h1 class="text-center mb-5">Post Archive</h1>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<div class="row justify-content-center">
						@foreach ($posts as $post)
						<a href="{{route('postDetails',$post->id)}}">	
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="single_travel wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
								<figure>
									<img class="img-fluid w-100" src="{{asset($post->image)}}" alt="">
								</figure>
								<div class="overlay"></div>
								<div class="text-wrap">
									<h3>
										<a href="{{route('postDetails',$post->id)}}">{{$post->title}}</a>
									</h3>
									<div class="blog-meta white d-flex justify-content-between align-items-center flex-wrap">
										<div class="meta">
											<a href="{{route('postDetails',$post->id)}}">
											  <p>{{$post->category->name}}</p>
											</a>
										</div>
										<div>
											<a class="read_more" href="{{route('postDetails',$post->id)}}">Created By: {{$post->admin->name}}</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					    </a>
						@endforeach
					
					</div>
				</div>

			
			</div>
		</div>
	</section>
	<!--================Archive Area =================-->
</body>



@endsection