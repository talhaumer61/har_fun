@include('admin.components.header_links',['title' => 'Dashboard Login - HARFUN'])
<div class="row authentication coming-soon mx-0">
    <div class="col-xl-6 col-lg-7 d-lg-block d-none px-0">
        <div class="cover p-5">
            <a href="index.html" class="float-end">
                 {{-- <img src="{{asset('admin/img/brand-logos/desktop-white.png')}}" alt="" class=""> --}}
                 <img src="{{asset('site/images/logo/logo_01.png')}}" alt="" class="admin-auth-logo">
                </a>
            <div class="authentication-page justify-center align-items-center authentication-img w-100 d-flex ">
                <img src="{{asset('admin/img/authentication/2.png')}}" alt="logo" class="mx-auto">
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-5 col-12">
        <div class="authentication-cover">
            <div class="aunthentication-cover-content ">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-10 col-sm-6 col-10">
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
                                @csrf
                                <input type="hidden" name="login_type" value="1">
                                <div class="row gy-3">
                                    <!-- Email Field -->
                                    <div class="col-xl-12">
                                        <label for="signup-Email" class="form-label text-default">Email address</label>
                                        <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" 
                                               name="username" 
                                               id="signup-Email" 
                                               value="{{ old('username') }}" 
                                               placeholder="Email">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Password Field -->
                                    <div class="col-xl-12">
                                        <label class="form-label text-default d-block">
                                            Password
                                            <a href="reset.html" class="float-end text-success">Forget password ?</a>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" 
                                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                                   name="password" 
                                                   id="signup-password" 
                                                   placeholder="Password">
                                            <button class="btn btn-light bg-transparent" type="button" onclick="togglePasswordVisibility(this)" id="button-addon2">
                                                <i class="ri-eye-off-line align-middle"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                            
                                    <!-- Submit Button -->
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
  
@include('admin.components.footer_links')