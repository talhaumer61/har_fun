        <div class="footer-one">
			<div class="container">
				<div class="inner-wrapper">
					<div class="row">
						<div class="col-lg-2 col-md-3 footer-intro mb-15">
							<div class="logo mb-15">
								<a href="/" class="d-flex align-items-center">
									<img src="{{asset('site/images/logo/logo_01.png')}}" alt="">
								</a>
							</div> 
							<img src="{{asset('site/images/shape/shape_28.svg')}}" alt="" class="lazy-img mt-80 sm-mt-30 sm-mb-20">
							<!-- logo -->
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 mb-20">
							<h5 class="footer-title">Services​</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="/jobs">Browse Jobs</a></li>
								<li><a href="/sellers">Sellers</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 mb-20">
							<h5 class="footer-title">Company</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="about-us">About us</a></li>
								<li><a href="faq">FAQ’s</a></li>
								<li><a href="contact">Contact</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-4 mb-20">
							<h5 class="footer-title">Support</h5>
							<ul class="footer-nav-link style-none">
								<li><a href="contact">Terms of use</a></li>
								<li><a href="contact">Terms & conditions</a></li>
								<li><a href="contact">Privacy</a></li>
								<li><a href="contact">Cookie policy</a></li>
							</ul>
						</div>
						<div class="col-lg-4 mb-20 footer-newsletter">
							<h5 class="footer-title">Newsletter</h5>
							<p>Join & get important new regularly</p>
							<form action="#" class="d-flex">
								<input type="email" placeholder="Enter your email*">
								<button>Send</button>
							</form>
							<p class="note">We only send interesting and relevant emails.</p>
						</div>
					</div>
				</div> <!-- /.inner-wrapper -->
			</div>
			<div class="bottom-footer">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-4 order-lg-3 mb-15">
							<ul class="style-none d-flex order-lg-last justify-content-center justify-content-lg-end social-icon">
								<li><a href="#"><i class="bi bi-whatsapp"></i></a></li>
								<li><a href="#"><i class="bi bi-dribbble"></i></a></li>
								<li><a href="#"><i class="bi bi-google"></i></a></li>
								<li><a href="#"><i class="bi bi-instagram"></i></a></li>
							</ul>
						</div>
						<div class="col-lg-4 order-lg-1 mb-15">
							<ul class="d-flex style-none bottom-nav justify-content-center justify-content-lg-start">
								<li><a href="contact">Privacy & Terms.</a></li>
								<li><a href="contact"> Contact Us</a></li>
							</ul>
						</div>
						<div class="col-lg-4 order-lg-2">
							<p class="text-center mb-15">Copyright © {{date('Y')}} HAR-FUN.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
@include("site.components.footer_links")