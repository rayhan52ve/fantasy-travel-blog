	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="">
						<img src="{{asset('assets/frontend/img/logo.png')}}" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-center mx-auto">
							<li class="nav-item">
								<a class="nav-link" href="{{route('frontend')}}">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{route('category')}}">Category</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{route('archive')}}">Archive</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{route('contact')}}">Contact</a>
							</li>
							<li class="nav-item">
								<div class="nav-link">
								 <div class="dropdown">
									<button class="btn btn-sm  dropdown-toggle" style="color:green;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa-sharp fa-solid fa-bars"></i>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										@if (Route::has('userlogin'))
								
											@auth
												<a class="dropdown-item" href="{{ route('Userlogout') }}" style="color:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
												<a class="dropdown-item" target="_blank" href="{{route('userDashboard')}}" style="color:skyblue;"><i class="fa-solid fa-user"></i> User Profile</a>
											@else
												<a class="dropdown-item" href="{{ route('userlogin') }}" style="color:rgb(93, 75, 183);"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
											@endauth

								        @endif

										<hr>
										@if (Route::has('login'))

										    @auth('admin')
											    <a class="dropdown-item" target="_blank" href="{{route('dashboard')}}" style="color:rgb(7, 181, 7);"><i class="fa-solid fa-user"></i> Admin Dashboard</a>
												<a class="dropdown-item" href="{{ route('logout') }}" style="color:rgb(217, 84, 84);"><i class="fa-solid fa-lock"></i></i> Logout as Admin</a>
											@else
												<a class="dropdown-item" href="{{ route('login') }}" style="color:rgb(156, 219, 55);"><i class="fa-sharp fa-solid fa-unlock"></i> Admin</a>
                                            @endauth
											
										@endif
										
									</div>
								  </div>
								</div>
							</li>
						</ul>
						<ul class="nav navbar-nav ml-auto search">
								<li class="nav-item d-flex align-items-center">
									<div class="menu-form">
										<form>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Search here">
											</div>
										</form>
									</div>
									<button type="submit" class="search-icon">
										<i class="lnr lnr-magnifier"></i>
									</button>
								</li>
						</ul>
						
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================ Header Menu Area =================-->