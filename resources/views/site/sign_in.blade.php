@include('site.components.header_links', ['title' => 'Sign In - HARFUN'])

<section class="registration-section position-relative pt-100 lg-pt-80 pb-150 lg-pb-80">
    <div class="container">
        <div class="user-data-form">
            <div class="text-center">
                <h3>Hi, Welcome Back!</h3>
            </div>
            <div class="form-wrapper m-auto">
                <div class="tab-content mt-40">
                    <div class="tab-pane fade show active" role="tabpanel" id="fc1">
                        <form action="#">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Name*</label>
                                        <input type="text" placeholder="Rashed Kabir">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-20">
                                        <label>Password*</label>
                                        <input type="password" placeholder="Enter Password" class="pass_log_id">
                                        <span class="placeholder_icon"><span class="passVicon"><img src="{{asset('site/images/icon/icon_60.svg')}}" alt=""></span></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="agreement-checkbox d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="checkbox" id="remember">
                                            <label for="remember">Keep me logged in</label>
                                        </div>
                                        <a href="#">Forget Password?</a>
                                    </div> <!-- /.agreement-checkbox -->
                                </div>
                                <div class="col-12">
                                    <button class="btn-eleven fw-500 tran3s d-block mt-20">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mt-30 mb-10">
                    <div class="line"></div>
                    <span class="pe-3 ps-3">OR</span>
                    <div class="line"></div>
                </div>
                <p class="text-center mt-10">Don't have an account? <a href="/sign-up" class="fw-500">Sign up</a></p>
                <div class="text-center">
                    <a href="/home">
                        <small><i class="fas fa-globe-americas"></i> Back to Home</small>
                    </a>
                </div>
            </div>
            <!-- /.form-wrapper -->
        </div>
        <!-- /.user-data-form -->
    </div>
</section>

@include('site.components.footer_links')