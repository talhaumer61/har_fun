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
						<li><a href="/sign-in" class="login-btn-one" >Login</a></li>
						<li class="d-none d-md-block ms-4"><a href="/sign-up" class="btn-one">Register</a></li>
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
										<div class="col-lg-6">
											<a href="/jobs" class="item d-flex align-items-center">
												<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s"><img src="{{asset('site/images/icon/icon_63.svg')}}" alt="" class="lazy-img"></div>
												<div class="ps-3 flex-fill">
													<div class="fw-500 text-dark">UI/UX Design</div>
													<div class="job-count">12k+ Jobs</div>
												</div>
											</a>
											<!-- /.item -->
											<a href="/jobs" class="item d-flex align-items-center">
												<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s"><img src="{{asset('site/images/icon/icon_64.svg')}}" alt="" class="lazy-img"></div>
												<div class="ps-3 flex-fill">
													<div class="fw-500 text-dark">Development</div>
													<div class="job-count">7k+ Jobs</div>
												</div>
											</a>
											<!-- /.item -->
											<a href="/jobs" class="item d-flex align-items-center">
												<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s"><img src="{{asset('site/images/icon/icon_65.svg')}}" alt="" class="lazy-img"></div>
												<div class="ps-3 flex-fill">
													<div class="fw-500 text-dark">Telemarketing</div>
													<div class="job-count">310+ Jobs</div>
												</div>
											</a>
											<!-- /.item -->
										</div>
										<div class="col-lg-6">
											<a href="/jobs" class="item d-flex align-items-center">
												<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s"><img src="{{asset('site/images/icon/icon_68.svg')}}" alt="" class="lazy-img"></div>
												<div class="ps-3 flex-fill">
													<div class="fw-500 text-dark">Marketing</div>
													<div class="job-count">420+ Jobs</div>
												</div>
											</a>
											<!-- /.item -->
											<a href="/jobs" class="item d-flex align-items-center">
												<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s"><img src="{{asset('site/images/icon/icon_66.svg')}}" alt="" class="lazy-img"></div>
												<div class="ps-3 flex-fill">
													<div class="fw-500 text-dark">Editing</div>
													<div class="job-count">3k+ Jobs</div>
												</div>
											</a>
											<!-- /.item -->
											<a href="/jobs" class="item d-flex align-items-center">
												<div class="icon d-flex align-items-center justify-content-center rounded-circle tran3s"><img src="{{asset('site/images/icon/icon_67.svg')}}" alt="" class="lazy-img"></div>
												<div class="ps-3 flex-fill">
													<div class="fw-500 text-dark">Finance Accounting</div>
													<div class="job-count">150+ Jobs</div>
												</div>
											</a>
											<!-- /.item -->
										</div>
									</li>
									<li>
										<a href="/jobs" class="explore-all-btn d-flex align-items-center justify-content-between tran3s">
											<span class="fw-500">Explore all fields</span>
											<span class="icon"><i class="bi bi-chevron-right"></i></span>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item dropdown dashboard-menu">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
									data-bs-auto-close="outside" aria-expanded="false">Dashboard
								</a>
								<ul class="dropdown-menu">
									<li><a href="/seller-dashboard" class="dropdown-item" target="_blank"><span>Seller Dashboard</span></a></li>
									<li><a href="/dashboard" class="dropdown-item" target="_blank"><span>Customer Dashboard</span></a></li>
								</ul>
							</li>
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
							<li class="d-md-none"><a href="/post-job" class="job-post-btn tran3s">Post Job</a></li>
							<li class="d-md-none"><a href="/sign-up" class="btn-one w-100">Register</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div> <!--/.top-header-->
	</div> <!-- /.inner-content -->
</header>