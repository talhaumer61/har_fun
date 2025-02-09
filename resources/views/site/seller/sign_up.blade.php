@include('site.components.header_links', ['title' => 'Register Seller - HARFUN'])

<section class="registration-section position-relative pt-100 lg-pt-80 pb-150 lg-pb-80">
    <div class="container">
        <div class="user-data-form">
            <div class="text-center">
                <h3>Create Account</h3>
            </div>
            <div class="form-wrapper m-auto">
                <div class="tab-content mt-40">
                    <div class="tab-pane fade show active" role="tabpanel" id="fc1">
                        
                        <form id="signupForm" action="{{ route('seller-signup') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Name*</label>
                                        <input type="text" name="name" id="name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Email*</label>
                                        <input type="email" name="email" id="email" placeholder="">
                                        <span id="emailError" class="text-danger"></span> <!-- Error below field -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-25">
                                        <label>Username*</label>
                                        <input type="text" name="username" id="username" placeholder="">
                                        <span id="usernameError" class="text-danger"></span> <!-- Error below field -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-20">
                                        <label>Password*</label>
                                        <input type="password" name="password" id="password" placeholder="Enter Password">
                                        <span class="placeholder_icon">
                                            <span class="passVicon">
                                                <img src="site/images/icon/icon_60.svg" alt="">
                                            </span>
                                        </span>
                                        <span id="passwordError" class="text-danger"></span> <!-- Error below field -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta position-relative mb-20">
                                        <label>Confirm Password*</label>
                                        <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password">
                                        <span class="placeholder_icon">
                                            <span class="passVicon">
                                                <img src="site/images/icon/icon_60.svg" alt="">
                                            </span>
                                        </span>
                                        <span id="confirmPasswordError" class="text-danger"></span> <!-- Error below field -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-eleven fw-500 tran3s d-block mt-20">Register</button>
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
                <p class="text-center mt-10">Have an account? <a href="/sign-in" class="fw-500">Sign In</a></p>
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