@include('admin.components.header_links')
<div class="container-lg">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
            <div class="my-4 d-flex justify-content-center">
                <a href="index.html">
                    <img src="{{asset('admin/img/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
                    <img src="{{asset('admin/img/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
                </a>
            </div>
            <div class="card custom-card">
                <div class="card-body p-5">
                    <div class="authentication-cover">
                        <div class="aunthentication-cover-content">
                            <p class="h4 fw-bold mb-2 text-center">Sign in</p>
                            {{-- <div class="text-center">
                                <p class="fs-14 text-muted mt-3">Don't have an account yet? <a href="signup.html" class="text-primary fw-semibold">Sign up here</a></p>
                            </div>
                            <div class="d-grid align-items-center">
                                <button class="btn btn-outline-light border shadow-sm">
                                    <img src="{{asset('admin/img/authentication/social/1.png')}}" class="w-4 h-4 me-2" alt="google-img">Sign in with Google
                                </button>
                            </div>
                            <div class="text-center my-3 authentication-barrier">
                                <span>OR</span>
                            </div> --}}
                            <form action="{{ route('login.post') }}" method="post">
                            <div class="row gy-3">
                                    @csrf
                                    <div class="col-xl-12">
                                        <label for="signup-Email" class="form-label text-default op=8">Email address</label>
                                        <input type="text" class="form-control form-control-lg" name="username" id="signup-Email" placeholder="Email">
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label text-default d-block">password
                                            <a href="reset.html" class="float-end text-success">Forget password ?</a>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg" name="password" id="signup-password" placeholder="password">
                                            <button class="btn btn-light bg-transparent" type="button" onclick="togglePasswordVisibility(this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 d-grid mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.components.footer_links')