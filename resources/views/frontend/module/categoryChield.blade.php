@extends('frontend.master')
@section('content')

<body>
  <div class="col-lg-8 text-center ml-5 pl-5">
  <h2 class="m-5 p-5">Post Category {{$categories->name}}</h2>
  </div>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
						@foreach ($categories->post as $post)
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

				{{-- side nav start--}}
				<div class="col-lg-4">
					<div class="blog_right_sidebar">
						<aside class="single_sidebar_widget search_widget">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search Posts">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
								</span>
							</div><!-- /input-group -->
							<div class="br"></div>
						</aside>
						<aside class="single_sidebar_widget author_widget">
							<img class="author_img img-fluid" src="{{asset('assets/frontend/img/blog/author.png')}}" alt="">
							<h4>Charlie ALison Barber</h4>
							<p>Senior blog writer</p>

							<p>Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend
								money
								on boot camp when you can get. Boot camps have itssuppor ters andits detractors.</p>
							<div class="social_icon">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-github"></i></a>
								<a href="#"><i class="fa fa-behance"></i></a>
							</div>
							<div class="br"></div>
						</aside>
						<aside class="single_sidebar_widget popular_post_widget">
							<h3 class="widget_title">Popular Posts</h3>
							<div class="media post_item">
								<img src="{{asset('assets/frontend/img/blog/popular-post/post1.jpg')}}" alt="post">
								<div class="media-body">
									<a href="blog-details.html">
										<h3>Space The Final Frontier</h3>
									</a>
									<p>02 Hours ago</p>
								</div>
							</div>
							<div class="media post_item">
								<img src="{{asset('assets/frontend/img/blog/popular-post/post2.jpg')}}" alt="post">
								<div class="media-body">
									<a href="blog-details.html">
										<h3>The Amazing Hubble</h3>
									</a>
									<p>02 Hours ago</p>
								</div>
							</div>
							<div class="media post_item">
								<img src="{{asset('assets/frontend/img/blog/popular-post/post3.jpg')}}" alt="post">
								<div class="media-body">
									<a href="blog-details.html">
										<h3>Astronomy Or Astrology</h3>
									</a>
									<p>03 Hours ago</p>
								</div>
							</div>
							<div class="br"></div>
						</aside>
						<aside class="single_sidebar_widget newsletter_widget">
							<h4 class="widget_title">Newsletter</h4>
							<div id="mc_embed_signup">
								<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
								 method="get" class="subscribe_form relative">
									<div class="input-group d-flex flex-row">
										<input name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
										 required="" type="email">
										<button class="btn sub-btn">
											<span class="lnr lnr-arrow-right"></span>
										</button>
									</div>
									<div class="mt-10 info"></div>
								</form>
							</div>
						</aside>
						<div class="br"></div>
						<aside class="single_sidebar_widget post_category_widget">
							<h4 class="widget_title">Post Catgories</h4>
							<ul class="list cat-list">
								@foreach ($category as $cat)
								<li>
									<a href="{{route('categoryChield',$cat->id)}}" class="d-flex justify-content-between">
										<p>{{$cat->name}}</p>
										<p>{{$cat->parent_id}}</p>
									</a>
								</li>
								@endforeach
							</ul>
						</aside>
						<aside class="single_sidebar_widget mt-4">
							<!-- Tags Start -->
							<div class="mb-3">
								<div class="section-title mb-0">
									<h4 class="widget_title">Tags</h4>
								</div>
								<div class="bg-white border border-top-0 p-3">
									<div class="d-flex flex-wrap m-n1">
										@foreach ($tags as $tag)
										<a href="" class="btn btn-sm btn-outline-secondary m-1">{{$tag->name}}</a>
										@endforeach
									</div>
								</div>
							</div>
							<!-- Tags End -->
						</aside>
					</div>
				</div>
				{{-- side nav end --}}
			</div>
		</div>
	</section>
</body>
@endsection