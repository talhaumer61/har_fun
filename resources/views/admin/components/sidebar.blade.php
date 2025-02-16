<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <img src="{{asset('site/images/logo/logo_01.png')}}" alt="logo" class="admin-auth-logo main-logo desktop-logo">
            <img src="{{asset('site/images/fav-icon/icon.png')}}" alt="logo" class="main-logo toggle-logo">
            <img src="{{asset('site/images/logo/logo_01.png')}}" alt="logo" class="admin-auth-logo main-logo desktop-dark">
            <img src="{{asset('site/images/fav-icon/icon.png')}}" alt="logo" class="main-logo toggle-dark">
             <img src="{{asset('site/images/logo/logo_01.png')}}" alt="logo" class="admin-auth-logo desktop-white">
            <img src="{{asset('site/images/fav-icon/icon.png')}}" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar " id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg></div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="/portal" class="side-menu__item">
                        <i class="ri-home-8-line side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="#" class="side-menu__item">
                        <i class="ri-settings-5-line animate-spin header-link-icon side-menu__icon"></i>
                        <span class="side-menu__label">Settings</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">General</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.users') }}" class="side-menu__item">
                        <i class="ti ti-users side-menu__icon"></i>
                        <span class="side-menu__label">Users</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ti ti-adjustments-alt side-menu__icon"></i>
                        <span class="side-menu__label">Jobs</span>
                        <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1"><a href="javascript:void(0)">Jobs</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">List</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Completed</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Pending</a></li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ti ti-user-search side-menu__icon"></i>
                        <span class="side-menu__label">Sellers</span>
                        <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1"><a href="javascript:void(0)">Sellers</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">List</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Requests</a></li>
                        
                    </ul>
                </li>
                <!-- End::slide -->

                <li class="slide ">
                    <a href="{{ route('admin.categories') }}" class="side-menu__item">
                        <i class="ti ti-border-all side-menu__icon"></i>
                        <span class="side-menu__label">Categories</span>
                    </a>
                </li>
                <li class="slide ">
                {{-- <li class="slide has-sub"> --}}
                    <a href="#" class="side-menu__item">
                        <i class="ti ti-square-plus side-menu__icon"></i>
                        <span class="side-menu__label">Subscriptions</span>
                        {{-- <i class="ri ri-arrow-right-s-line side-menu__angle"></i> --}}
                    </a>
                    {{-- <ul class="slide-menu child1">
                        <li class="slide side-menu__label1"><a href="javascript:void(0)">Subscriptions</a></li>
                        <li class="slide"><a href="rangeslider.html" class="side-menu__item">Range slider</a></li>
                    </ul> --}}
                </li>
                <!-- End::slide -->



                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Financial</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ti ti-cash-banknote side-menu__icon"></i>
                        <span class="side-menu__label">Payments</span>
                        <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1"><a href="javascript:void(0)">Payments</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Completed</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Pending</a></li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Setting</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ti ti-settings side-menu__icon"></i>
                        <span class="side-menu__label">Website Setting</span>
                        <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1"><a href="javascript:void(0)">Website Setting</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Contact Info</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">More...</a></li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="ri-camera-lens-line side-menu__icon"></i>
                        <span class="side-menu__label">Area</span>
                        <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1"><a href="javascript:void(0)">Area</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Region</a></li>
                        <li class="slide"><a href="#" class="side-menu__item">Country</a></li>
                    </ul>
                </li>
                <!-- End::slide -->


            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>