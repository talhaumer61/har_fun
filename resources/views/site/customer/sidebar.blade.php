<aside class="dash-aside-navbar">
    <div class="position-relative">
        <div class="logo text-md-center d-md-block d-flex align-items-center justify-content-between">
            <a href="/dashboard/customer">
                <img src="{{asset('site/dashboard/logo_01.png')}}" alt="">
            </a>
            <button class="close-btn d-block d-md-none"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="user-data">
            <div class="user-avatar online position-relative rounded-circle">
                <img src="{{asset('site/dashboard/avatar_03.jpg')}}" alt="" class="lazy-img">
            </div>
            <!-- /.user-avatar -->
            <div class="user-name-data">
                <button class="user-name dropdown-toggle" type="button" id="profile-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    {{ session('user')->name }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="profile-dropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/customer-profile"><img src="{{asset('site/dashboard/icon/icon_23.svg')}}" alt="" class="lazy-img"><span class="ms-2 ps-1">Profile</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/account-settings"><img src="{{asset('site/dashboard/icon/icon_24.svg')}}" alt="" class="lazy-img"><span class="ms-2 ps-1">Account Settings</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"><img src="{{asset('site/dashboard/icon/icon_25.svg')}}" alt="" class="lazy-img"><span class="ms-2 ps-1">Notification</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.user-data -->
        <nav class="dasboard-main-nav">
            <ul class="style-none">
                <li><a href="/" class="d-flex w-100 align-items-center pt-0">
                    <img src="{{asset('site/dashboard/icon/icon_32.svg')}}" alt="" class="lazy-img">
                    <span>Back to Home</span>
                </a></li>
                <li><a href="/dashboard" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_1.svg')}}" alt="" class="lazy-img">
                    <span>Dashboard</span>
                </a></li>
                <li><a href="/customer-profile" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_2.svg')}}" alt="" class="lazy-img">
                    <span>My Profile</span>
                </a></li>
                <li><a href="/my-jobs" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_3.svg')}}" alt="" class="lazy-img">
                    <span>My Jobs</span>
                </a></li>
                <li><a href="/customer/messages" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_4.svg')}}" alt="" class="lazy-img">
                    <span>Messages</span>
                </a></li>
                <li><a href="/post-job" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_39.svg')}}" alt="" class="lazy-img">
                    <span>Post a Job</span>
                </a></li>
                <li><a href="/saved-sellers" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_6.svg')}}" alt="" class="lazy-img">
                    <span>Saved Sellers</span>
                </a></li>
                <li><a href="/memberships" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_40.svg')}}" alt="" class="lazy-img">
                    <span>Membership</span>
                </a></li>
                <li><a href="/account-settings" class="d-flex w-100 align-items-center">
                    <img src="{{asset('site/dashboard/icon/icon_7.svg')}}" alt="" class="lazy-img">
                    <span>Account Settings</span>
                </a></li>
                <li><a href="#" class="d-flex w-100 align-items-center" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <img src="{{asset('site/dashboard/icon/icon_8.svg')}}" alt="" class="lazy-img">
                    <span>Delete Account</span>
                </a></li>
            </ul>
        </nav>
        <!-- /.dasboard-main-nav -->
        <div class="profile-complete-status">
            <div class="progress-value fw-500">87%</div>
            <div class="progress-line position-relative">
                <div class="inner-line" style="width:80%;"></div>
            </div>
            <p>Profile Complete</p>
        </div>
        <!-- /.profile-complete-status -->

        <a href="#" class="d-flex w-100 align-items-center logout-btn">
            <img src="{{asset('site/dashboard/icon/icon_9.svg')}}" alt="" class="lazy-img">
            <span>Logout</span>
        </a>
    </div>
</aside>

<!--Dashboard Body-->
<div class="dashboard-body">
    <div class="position-relative">
        <!-- ************************ Header **************************** -->
        <header class="dashboard-header">
            <div class="d-flex align-items-center justify-content-end">
                <button class="dash-mobile-nav-toggler d-block d-md-none me-auto">
                    <span></span>
                </button>
                <form action="#" class="search-form">
                    <input type="text" placeholder="Search here..">
                    <button><img src="{{asset('site/dashboard/icon/icon_10.svg')}}" alt="" class="lazy-img m-auto"></button>
                </form>
                <div class="profile-notification ms-2 ms-md-5 me-4">
                    <button class="noti-btn dropdown-toggle" type="button" id="notification-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="{{asset('site/dashboard/icon/icon_11.svg')}}" alt="" class="lazy-img">
                        <div class="badge-pill"></div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="notification-dropdown">
                        <li>
                            <h4>Notification</h4>
                            <ul class="style-none notify-list">
                                <li class="d-flex align-items-center unread">
                                    <img src="{{asset('site/dashboard/icon/icon_36.svg')}}" alt="" class="lazy-img icon">
                                    <div class="flex-fill ps-2">
                                        <h6>You have 3 new mails</h6>
                                        <span class="time">3 hours ago</span>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <img src="{{asset('site/dashboard/icon/icon_37.svg')}}" alt="" class="lazy-img icon">
                                    <div class="flex-fill ps-2">
                                        <h6>Your job post has been approved</h6>
                                        <span class="time">1 day ago</span>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center unread">
                                    <img src="{{asset('site/dashboard/icon/icon_38.svg')}}" alt="" class="lazy-img icon">
                                    <div class="flex-fill ps-2">
                                        <h6>Your meeting is cancelled</h6>
                                        <span class="time">3 days ago</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div><a href="/post-job" class="job-post-btn tran3s">Post a Job</a></div>
            </div>
        </header>