@include("site.components.header_links")

<header class="theme-main-menu menu-overlay menu-style-one sticky-menu">
	<div class="inner-content position-relative">
		<div class="top-header">
			<div class="d-flex align-items-center">
				<div class="logo order-lg-0">
					<a href="/home" class="d-flex align-items-center">
						<img src="{{asset('site/images/logo/logo_01.png')}}" alt="">
					</a>
				</div>
				<!-- logo -->
				<div class="right-widget ms-auto order-lg-3">
					<ul class="d-flex align-items-center style-none">
						<!-- <li class="d-none d-md-block"><a href="/post-job" class="job-post-btn tran3s">Post Job</a></li> -->
						@if(session()->has('user'))
							@if(session('user')->login_type == 1)
								<li class="d-none d-md-block me-1"><a href="/portal/logout" class="btn-one w-100">Logout</a></li>
								<li class="d-none d-md-block"><a href="/portal" class="btn-one w-100">Dashboard</a></li>
							@elseif(session('user')->login_type == 2)
								<li class="d-none d-md-block me-1"><a href="/logout" class="btn-one w-100">Logout</a></li>
								<li class="d-none d-md-block"><a href="/dashboard" class="btn-one w-100">Dashboard</a></li>
							@elseif(session('user')->login_type == 3)
								<li class="d-none d-md-block me-1"><a href="/log-out" class="btn-one w-100">Logout</a></li>
								<li class="d-none d-md-block"><a href="/seller-dashboard" class="btn-one w-100">Dashboard</a></li>
							@endif
							
						@else
							<li><a href="/sign-in" class="login-btn-one" >Login</a></li>
							<li class="d-none d-md-block ms-4"><a href="/sign-up" class="btn-one">Register</a></li>
						@endif
					</ul>
				</div> <!--/.right-widget-->
				<nav class="navbar navbar-expand-lg p0 ms-lg-5 ms-3 order-lg-2">
					<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
						aria-label="Toggle navigation">
						<span></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav align-items-lg-center">
							<li class="d-block d-lg-none"><div class="logo"><a href="/" class="d-block"><img src="{{asset('site/images/logo/logo_01.png')}}" alt="" width="100"></a></div></li>
							<li class="nav-item dropdown category-btn mega-dropdown-sm">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-grid-fill"></i> Category</a>
								<ul class="dropdown-menu category-dropdown">
									<li class="row gx-0">
										@foreach(getCategories() as $category)
											<div class="col-lg-6">
												<a href="/jobs/{{ $category->cat_href }}" class="item d-flex align-items-center">
													<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s">
														<img src="{{ asset(''. $category->cat_icon.'') }}" alt="" class="lazy-img">
													</div>
													<div class="ps-3 flex-fill">
														<div class="fw-500 text-dark">{{ $category->cat_name }}</div>
														<div class="job-count">
															<!-- Assuming you want to display job count; you can adjust according to your needs -->
															{{-- {{ $category->job_count }} Jobs --}}
														</div>
													</div>
												</a>
											</div>
										@endforeach
									</li>
									
									<li>
										<a href="/jobs" class="explore-all-btn d-flex align-items-center justify-content-between tran3s">
											<span class="fw-500">Explore all fields</span>
											<span class="icon"><i class="bi bi-chevron-right"></i></span>
										</a>
									</li>
								</ul>
							</li>
							{{-- <li class="nav-item dropdown dashboard-menu">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
									data-bs-auto-close="outside" aria-expanded="false">Dashboard
								</a>
								<ul class="dropdown-menu">
									<li><a href="/seller-dashboard" class="dropdown-item" target="_blank"><span>Seller Dashboard</span></a></li>
									<li><a href="/dashboard" class="dropdown-item" target="_blank"><span>Customer Dashboard</span></a></li>
								</ul>
							</li> --}}
							<li class="nav-item">
								<a class="nav-link" href="/home">Home</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" href="/jobs">Jobs</a>
							</li>
							<li class="nav-item dropdown mega-dropdown-sm">
								<a class="nav-link" href="/sellers">Sellers</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
									data-bs-auto-close="outside" aria-expanded="false">More...
								</a>
								<ul class="dropdown-menu">
									<li><a href="contact" class="dropdown-item"><span>Contact Us</span></a></li>
									<li><a href="about-us" class="dropdown-item"><span>About Us</span></a></li>
									<li><a href="faq" class="dropdown-item"><span>Faq's</span></a></li>
								</ul>
							</li>
							@if(session()->has('user'))
								@if(session('user')->login_type == 1)
									<li class="d-md-none"><a href="/logout" class="btn-one w-100">Logout</a></li>
									<li class="d-md-none"><a href="/portal" class="btn-one w-100">Dashboard</a></li>
								@elseif(session('user')->login_type == 2)
									<li class="d-md-none"><a href="/logout" class="btn-one w-100">Logout</a></li>
									<li class="d-md-none"><a href="/dashboard" class="btn-one w-100">Dashboard</a></li>
								@elseif(session('user')->login_type == 3)
									<li class="d-md-none"><a href="/log-out" class="btn-one w-100">Logout</a></li>
									<li class="d-md-none"><a href="/seller-dashboard" class="btn-one w-100">Dashboard</a></li>
								@endif
							@else
								<li class="d-md-none me-1"><a href="/post-job" class="job-post-btn tran3s">Post Job</a></li>
								<li class="d-md-none"><a href="/sign-up" class="btn-one w-100">Register</a></li>
							@endif
							
						</ul>
					</div>
				</nav>
			</div>
		</div> <!--/.top-header-->
	</div> <!-- /.inner-content -->
</header>