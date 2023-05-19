@extends('frontend.master')
@section('content')
   <div class="container">
       <div class="row justify-content-center">
            <!--================Blog Area =================-->
    <section class="blog_area section-gap single-post-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-8">
                  <div class="main_blog_details">
                      <img class="img-fluid" src="{{asset($post->image)}}" alt="">
                      <a href="#!">
                          <h4>{{$post->title}}</h4>
                      </a>
                      <div class="user_details">
                          <div class="float-left">
                              <a href="#!">Lifestyle</a>
                              <a href="#!">Gadget</a>
                          </div>
                          <div class="float-right">
                              <div class="media">
                                  <div class="media-body">
                                      <h5>{{$post->admin->name}}</h5>
                                      <p>{{$post->created_at->format('D,  M d, Y')}}</p>
                                  </div>
                                  <div class="d-flex">
                                      <img class="col-sm-6" src="{{asset($post->admin->image)}}" alt="">
                                  </div>
                              </div>
                          </div>
                      </div>
                       {{-- post content --}}
                       {{$post->content}}
                       {{-- post content --}}
                      <div class="news_d_footer">
                          <a href="#!"><i class="lnr lnr lnr-heart"></i>{{$post->admin->name}} @if ($post->comment->count() > 1 ) and {{$post->comment->count()-1}} people @endif liked this</a>
                          <a class="justify-content-center ml-auto" href="#!"><i class="lnr lnr lnr-bubble"></i>{{$post->comment->count()}}
                            @php $com ='Comment'; @endphp  @if ($post->comment->count() == 1) {{$com}} @else Comments @endif</a>
                          <div class="news_socail ml-auto">
                              <a href="#!" ><i class="fa fa-facebook"></i></a>
                              <a href="#!"><i class="fa fa-twitter"></i></a>
                              <a href="#!"><i class="fa fa-pinterest"></i></a>
                              <a href="#!"><i class="fa fa-rss"></i></a>
                          </div>
                      </div>
                  </div>
                  {{-- Comment Area --}}
                  <div class="comments-area">
                    
                      <h4>{{$post->comment->count()}} @if ($post->comment->count() == 1) {{$com}} @else Comments @endif</a></h4>
                      
                        <div class="container">
                          <div class="row d-flex justify-content-center">
                            <div class="col-md-12 ">
                              <div class="card text-dark">
                                <div class="card-body p-4">
                                    <h4 class="mb-0">Recent comments</h4>
                                    <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>
                                @foreach ($post->comment as $com)
                                  <div class="commentContainer d-flex flex-start m-5">
                                    <img class="rounded-circle shadow-1-strong mx-2"
                                      src="{{asset($com->user->image)}}" alt="avatar" width="60"
                                      height="60" />
                                    <div>
                                      <h6 class="fw-bold mb-1">{{$com->user->name}}</h6>
                                      <div class="d-flex align-items-center mb-3">
                                            <p class="mb-0">
                                            {{$com->created_at->format('M d, Y, D')}}
                                            </p>
                                            @if (Auth::check() && Auth::id() == $com->user_id)
                                              <a href="#!" class="text-info px-2"><i class="fas fa-pencil-alt ms-2"></i></a>
                                              <a href="#!" class="text-warning px-2"><i class="fa-solid fa-comment-dots"></i></i></a>
                                              <button class=" deleteComment btn text-danger btn-sm" type="button" value="{{$com->id}}"><i class="fa-solid fa-trash"></i></button>
                                              @elseif (Auth::guard('admin')->check() && Auth::guard('admin')->user())
                                              <button class=" deleteCommentAdmin btn text-danger btn-sm m-2" type="button" value="{{$com->id}}"><i class="fa-solid fa-trash"></i></button>
                                            @endif
                                           
                                      </div>
                                      <p class="mb-0">
                                        {{$com->msg}}
                                       </p>
                                      
                                    </div>
                                  </div>
                                  @endforeach 
                                </div>
                      
                                

                              </div>
                            </div>
                          </div>
                        </div>

                        @if (Auth::check() && Auth::user() ) 
                        <div class="comment-form">
                            <h4>Leave a Comment</h4>
                            <form action="{{route('comment.store')}}" method="get">
                              @csrf
                              <div>
                                <input type="hidden" value="{{$post->id}}" name="post_id">
                                <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
                              </div>
                                <div class="form-group">
                                    <textarea rows="2" class="form-control mb-10" name="msg" placeholder="Comment"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Comment'" required></textarea>
                                </div>
                                <button type="submit" class="cmnt btn btn-info">Write Comment</button>
                            </form>
                        </div>
                        @endif

                        {{-- @if (Auth::guard('admin')->check() && Auth::guard('admin')->user() ) 
                        <div class="comment-form">
                            <h4>Leave a Comment</h4>
                            <form action="{{route('comment.store')}}" method="get">
                              @csrf
                              <div>
                                <input type="hidden" value="{{$post->id}}" name="post_id">
                                <input type="hidden" value="{{$post->admin->id}}" name="user_id">
                              </div>
                                <div class="form-group">
                                    <textarea rows="2" class="form-control mb-10" name="msg" placeholder="Comment"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Comment'" required></textarea>
                                </div>
                                <button type="submit" class="cmnt btn btn-info">Write Comment</button>
                            </form>
                        </div>
                        @endif --}}
                </div>
                {{-- Comment Area --}}
                  
                
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
							<img class="author_img img-fluid" src="{{asset($post->admin->image)}}" alt="">
							<h4>{{$post->admin->name}}</h4>
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
								@foreach ($categories as $cat)
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
  <!--================Blog Area =================-->
   </div>

   
@endsection

@section('js')
<script>
    $(document).ready(function(){

        //create
        $(document).on('click','.cmnt',function(){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Comment Posted',
                showConfirmButton: false,
                timer: 1500
                })
        });





       //Delete
       $(document).on('click','.deleteComment',function(){

            var thisClicked = $(this);
            var comment_id = thisClicked.val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{route('comment.destroy')}}",
                        data: {
                            'comment_id':comment_id
                        },
                        success: function (res) {
                            if (res.status == 200) {
                                thisClicked.closest('.commentContainer').remove();
                                Swal.fire(
                                'Deleted!',
                                'Comment has been deleted.',
                                'success'
                                )
                            }
                        }
                    });

                }
                })

       
         });

       //AdminCommentDelete
       $(document).on('click','.deleteCommentAdmin',function(){

            var thisClicked = $(this);
            var comment_id = thisClicked.val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{route('adminComment.destroy')}}",
                        data: {
                            'comment_id':comment_id
                        },
                        success: function (res) {
                            if (res.status == 200) {
                                thisClicked.closest('.commentContainer').remove();
                                Swal.fire(
                                'Deleted!',
                                'Comment has been deleted.',
                                'success'
                                )
                            }
                        }
                    });

                }
                })

       
         });

    });
  </script>
@endsection