@include("admin.components.header_links")

<div class="page">
	<!-- app-header -->
	<header class="app-header">

	   <!-- Start::main-header-container -->
	   <div class="main-header-container container-fluid">

		   <!-- Start::header-content-left -->
		   <div class="header-content-left">

			   <!-- Start::header-element -->
			   <div class="header-element">
				   <div class="horizontal-logo">
					   <a href="/portal" class="header-logo">
						   <img src="{{asset('site/images/logo/logo_01.png')}}" alt="logo" class="desktop-logo">
						   <img src="{{asset('site/images/fav-icon/icon.png')}}" alt="logo" class="toggle-logo">
						   <img src="{{asset('site/images/logo/logo_01.png')}}" alt="logo" class="desktop-dark">
						   <img src="{{asset('site/images/fav-icon/icon.png')}}" alt="logo" class="toggle-dark">
						   <img src="{{asset('site/images/logo/logo_01.png')}}" alt="logo" class="desktop-white">
						   <img src="{{asset('site/images/fav-icon/icon.png')}}" alt="logo" class="toggle-white">
					   </a>
				   </div>
			   </div>
			   <!-- End::header-element -->
			   <!-- Start::header-element -->
			   <div class="header-element">
				   <!-- Start::header-link -->
				   <div class="">
					   <a class="sidebar-toggle sidemenu-toggle header-link" data-bs-toggle="sidebar" href="javascript:void(0);">
						 <span class="sr-only">Toggle Navigation</span>
						 <i class="ri-arrow-right-circle-line header-icon"></i>
					   </a>
					 </div>
				   <!-- <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a> -->
				   <!-- End::header-link -->
			   </div>
			   <!-- End::header-element -->


		   </div>
		   <!-- End::header-content-left -->

		   <!-- Start::header-content-right -->
		   <div class="header-content-right">


			   <!-- Start::header-element -->
			   <div class="header-element country-selector">
				   <!-- Start::header-link|dropdown-toggle -->
				   <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
					   <img src="{{asset('admin/img/flags/10.png')}}" alt="img" class="rounded-circle header-link-icon">
				   </a>
				   <!-- End::header-link|dropdown-toggle -->
				   <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
					   <li>
						   <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
							   <span class=" lh-1 me-2">
								   <img src="{{asset('admin/img/flags/10.png')}}" alt="img">
							   </span>
							   English
						   </a>
					   </li>
					   <li>
						   <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
							   <span class=" lh-1 me-2">
								   <img src="{{asset('admin/img/flags/1.png')}}" alt="img" >
							   </span>
							   Spanish
						   </a>
					   </li>
					   <li>
						   <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
							   <span class=" lh-1 me-2">
								   <img src="{{asset('admin/img/flags/2.png')}}" alt="img" >
							   </span>
							   French
						   </a>
					   </li>
					   <li>
						   <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
							   <span class=" lh-1 me-2">
								   <img src="{{asset('admin/img/flags/3.png')}}" alt="img" >
							   </span>
							   German
						   </a>
					   </li>
					   <li>
						   <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
							   <span class=" lh-1 me-2">
								   <img src="{{asset('admin/img/flags/4.png')}}" alt="img" >
							   </span>
							   Italian
						   </a>
					   </li>
					   <li>
						   <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
							   <span class=" lh-1 me-2">
								   <img src="{{asset('admin/img/flags/5.png')}}" alt="img" >
							   </span>
							   Russian
						   </a>
					   </li>
				   </ul>
			   </div>
			   <!-- End::header-element -->

			   <!-- Start::header-element -->
			   <div class="header-element header-search">
				   <!-- Start::header-link -->
				   <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
					   <i class="ri-search-2-line header-link-icon"></i>
				   </a>
				   <!-- End::header-link -->
			   </div>
			   <!-- End::header-element -->

			   <!-- Start::header-element -->
			   <div class="header-element header-theme-mode">
				   <!-- Start::header-link|layout-setting -->
				   <a href="javascript:void(0);" class="header-link layout-setting">
					   <span class="light-layout">
						   <!-- Start::header-link-icon -->
					   <i class="ri-moon-line header-link-icon"></i>
						   <!-- End::header-link-icon -->
					   </span>
					   <span class="dark-layout">
						   <!-- Start::header-link-icon -->
					   <i class="ri-sun-line header-link-icon"></i>
						   <!-- End::header-link-icon -->
					   </span>
				   </a>
				   <!-- End::header-link|layout-setting -->
			   </div>
			   <!-- End::header-element -->

			   <!-- Start::header-element -->
			   <div class="header-element header-fullscreen">
				   <!-- Start::header-link -->
				   <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
					   <i class="ri-fullscreen-line full-screen-open header-link-icon"></i>
					   <i class="ri-fullscreen-line full-screen-close header-link-icon d-none"></i>
				   </a>
				   <!-- End::header-link -->
			   </div>
			   <!-- End::header-element -->


			   <!-- Start::header-element -->
			   <div class="header-element notifications-dropdown">
				   <!-- Start::header-link|dropdown-toggle -->
				   <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
					   <i class="ri-notification-2-line header-link-icon animate-bell"></i>
					   <span class="badge bg-success rounded-pill header-icon-badge pulse pulse-success" id="notification-icon-badge">4</span>
				   </a>
				   <!-- End::header-link|dropdown-toggle -->
				   <!-- Start::main-header-dropdown -->
				   <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
					   <div class="header-dropdown bg-primary text-fixed-white rounded-top">
						   <div class="d-flex align-items-center justify-content-between">
							   <p class="mb-0 fs-15 fw-semibold">Notifications</p>
							   <span class="badge badge-light-2" id="notifiation-data">Mark All Read</span>
						   </div>
					   </div>
					   <div class="dropdown-divider"></div>
					   <ul class="list-unstyled mb-0" id="header-notification-scroll">
						   <li class="dropdown-item">
							   <div class="d-flex align-items-start">
								   <a href="mail-inbox.html" class="stretched-link text-danger" style="position: relative;"></a>
									<div class="pe-2">
										<span class="avatar avatar-sm">
										   <img src="{{asset('admin/img/users/17.jpg')}}" alt="img" class="rounded-sm">
									   </span>
									</div>
									<div class="flex-grow-1 d-flex align-items-center justify-content-between">
									   <div>
										   <p class="mb-0 fw-semibold"><a href="mail-inbox.html">Elon Isk</a></p>
										   <span class="text-muted fw-normal fs-12 header-notification-text text-truncate">Hello there! How are you doing? Call me when...</span>
											<p class="mb-0 text-muted fw-normal fs-12">2 min</p>
									   </div>
									   <div>
										   <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ri-close-circle-line fs-16 op-8"></i></a>
									   </div>
									</div>
							   </div>
						   </li>
						   <li class="dropdown-item">
							   <div class="d-flex align-items-start">
									<div class="pe-2">
										<span class="avatar avatar-sm">
										   <img src="{{asset('admin/img/users/2.jpg')}}" alt="img" class="rounded-sm">
									   </span>
									</div>
									<div class="flex-grow-1 d-flex align-items-center justify-content-between">
									   <div>
										   <p class="mb-0 fw-semibold"><a href="mail-inbox.html">Shakira Sen</a></p>
										   <span class="text-muted fw-normal fs-12 header-notification-text text-truncate">I would like to discuss about that assets...</span>
											<p class="mb-0 text-muted fw-normal fs-12">09:43</p>
									   </div>
									   <div>
										   <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ri-close-circle-line fs-16 op-8"></i></a>
									   </div>
									</div>
							   </div>
						   </li>
						   <li class="dropdown-item">
							   <div class="d-flex align-items-start">
									<div class="pe-2">
										<span class="avatar avatar-sm">
										   <img src="{{asset('admin/img/users/21.jpg')}}" alt="img" class="rounded-sm">
									   </span>
									</div>
									<div class="flex-grow-1 d-flex align-items-center justify-content-between">
									   <div>
										   <p class="mb-0 fw-semibold"><a href="mail-inbox.html">Sebastian</a></p>
										   <span class="text-muted fw-normal fs-12 header-notification-text text-truncate">Shall we go to the cafe at downtown...</span>
											<p class="mb-0 text-muted fw-normal fs-12">yesterday</p>
									   </div>
									   <div>
										   <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ri-close-circle-line fs-16 op-8"></i></a>
									   </div>
									</div>
							   </div>
						   </li>
						   <li class="dropdown-item">
							   <div class="d-flex align-items-start">
									<div class="pe-2">
										<span class="avatar avatar-sm">
										   <img src="{{asset('admin/img/users/11.jpg')}}" alt="img" class="rounded-sm">
									   </span>
									</div>
									<div class="flex-grow-1 d-flex align-items-center justify-content-between">
									   <div>
										   <p class="mb-0 fw-semibold"><a href="mail-inbox.html">Charlie Davieson</a></p>
										   <span class="text-muted fw-normal fs-12 header-notification-text text-truncate">Lorem ipsum dolor sit amet, consectetur</span>
											<p class="mb-0 text-muted fw-normal fs-12">yesterday</p>
									   </div>
									   <div>
										   <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ri-close-circle-line fs-16 op-8"></i></a>
									   </div>
									</div>
							   </div>
						   </li>
					   </ul>
					   <div class="p-3 empty-header-item1 border-top">
						   <div class="d-grid">
							   <a href="mail-inbox.html" class="btn btn-primary">View All</a>
						   </div>
					   </div>
					   <div class="p-5 empty-item1 d-none">
						   <div class="text-center">
							   <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
								   <i class="ri-notification-off-line fs-2"></i>
							   </span>
							   <h6 class="fw-semibold mt-3">No New Notifications</h6>
						   </div>
					   </div>
				   </div>
				   <!-- End::main-header-dropdown -->
			   </div>
			   <!-- End::header-element -->

			   <!-- Start::header-element -->
			   <div class="header-element header-shortcuts-dropdown">
				   <!-- Start::header-link|dropdown-toggle -->
				   <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="notificationDropdown" aria-expanded="false">
					   <i class="ri-bookmark-line header-link-icon"></i>
				   </a>
				   <!-- End::header-link|dropdown-toggle -->
				   <!-- Start::main-header-dropdown -->
				   <div class="main-header-dropdown header-shortcuts-dropdown dropdown-menu pb-0 dropdown-menu-end" aria-labelledby="notificationDropdown">
					   <div class="header-dropdown bg-primary text-fixed-white rounded-top">
						   <div class="d-flex align-items-center justify-content-between">
							   <p class="mb-0 fs-15 fw-semibold">Related Apps</p>
						   </div>
					   </div>
					   <div class="dropdown-divider mb-0"></div>
					   <div class="main-header-shortcuts p-2" id="header-shortcut-scroll">
						   <div class="row drop-icon-wrap my-2  p-2">
							   <div class="col-4">
								   <a href="mail-inbox.html" class=" d-grid justify-content-center    rounded p-1 ">
									   <div class="main-grid">
										   <span class="avatar p-2  bg-primary-transparent rounded-2 mx-auto">
											   <i class="ri ri-mail-line fs-24"></i>
											</span>
										   <span class="mt-2 fs-12  fw-semibold text-center">Mail Box</span>
									   </div>
								   </a>
							   </div>
							   <div class="col-4">
								   <a href="chat.html" class=" d-grid justify-content-center mb-0   rounded p-1 ">
									   <div class="main-grid">
										   <span class="avatar p-2  bg-secondary-transparent rounded-2 mx-auto">
											   <i class="ri ri-chat-2-line fs-24"></i>
											</span>
										   <span class="mt-2 fs-12  fw-semibold text-center">Chat</span>
									   </div>
								   </a>
							   </div>
							   <div class="col-4">
								   <a href="tasks.html" class=" d-grid justify-content-center   rounded p-1 ">
									   <div class="main-grid">
										   <span class="avatar p-2  bg-warning-transparent rounded-2 mx-auto">
											   <i class="ri ri-task-line  fs-24"></i>
										   </span>
										   <span class="mt-2 fs-12  fw-semibold text-center">Tasks</span>
									   </div>
								   </a>
							   </div>
							   <div class="col-4 mt-3">
								   <a href="calendar.html" class=" d-grid justify-content-center    rounded p-1 ">
									   <div class="main-grid">
										   <span class="avatar p-2  bg-danger-transparent rounded-2 mx-auto">
											   <i class="ri ri-calendar-event-line  fs-24"></i>
										   </span>
										   <span class="mt-2 fs-12  fw-semibold text-center">calendar</span>
									   </div>
								   </a>
							   </div>
							   <div class="col-4 mt-3">
								   <a href="filemanager.html" class=" d-grid justify-content-center  rounded p-1 ">
									   <div class="main-grid">
										   <span class="avatar p-2  bg-info-transparent rounded-2 mx-auto">
											   <i class="ri ri-file-copy-2-line   fs-24"></i>
										   </span>
										   <span class="mt-2 fs-12  fw-semibold text-center">FileManager</span>
									   </div>
								   </a>
							   </div>
							   <div class="col-4 mt-3">
								   <a href="contacts.html" class=" d-grid justify-content-center rounded p-1 ">
									   <div class="main-grid">
										   <span class="avatar p-2  bg-success-transparent rounded-2 mx-auto">
											   <i class="ri ri-group-line   fs-24"></i>
										   </span>
										   <span class="mt-2 fs-12  fw-semibold text-center">Contacts</span>
									   </div>
								   </a>
							   </div>
							</div>
					   </div>
					   <div class="p-3 border-top">
						   <div class="d-grid">
							   <a href="javascript:void(0);" class="btn btn-primary">View All</a>
						   </div>
					   </div>
				   </div>
				   <!-- End::main-header-dropdown -->
			   </div>
			   <!-- End::header-element -->


			   <!-- Start::header-element -->
			   <div class="header-element">
				   <!-- Start::header-link|dropdown-toggle -->
				   <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
					   <div class="d-flex align-items-center">
						   <div class="">
							   <img src="{{asset('admin/img/users/1.jpg')}}" alt="img" width="30" height="30" class="rounded-circle">
						   </div>
					   </div>
				   </a>
				   <!-- End::header-link|dropdown-toggle -->
				   <div class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
					   <div class="header-dropdown bg-primary text-fixed-white rounded-top">
						   <div class="d-flex align-items-center">
							   <div class="me-sm-2 me-0 avatar">
								   <img src="{{asset('admin/img/users/1.jpg')}}" alt="img" class="rounded-circle">
							   </div>
							   <div class="d-sm-block d-none">
								   <p class="fw-semibold mb-0 lh-1">Json Taylor</p>
								   <span class="op-7 fw-medium d-block fs-12">Web Designer</span>
							   </div>
						   </div>
					   </div>
					   <div class="dropdown-divider mb-0"></div>
					   <ul class="list-unstyled">
						   <li><a class="dropdown-item d-flex" href="profile.html"><i class="ti ti-user-circle fs-18 me-2"></i>Profile</a></li>
						   <li><a class="dropdown-item d-flex" href="mail-inbox.html"><i class="ti ti-inbox fs-18 me-2"></i>Inbox</a></li>
						   <li><a class="dropdown-item d-flex border-block-end" href="todo.html"><i class="ti ti-clipboard-check fs-18 me-2"></i>Task Manager</a></li>
						   <li><a class="dropdown-item d-flex" href="mail-settings.html"><i class="ti ti-adjustments-horizontal fs-18 me-2"></i>Settings</a></li>
						   <li><a class="dropdown-item d-flex border-block-end" href="index3.html"><i class="ti ti-wallet fs-18 me-2"></i>Bal: $7,12,950</a></li>
						   <li><a class="dropdown-item d-flex" href="chat.html"><i class="ti ti-headset fs-18 me-2"></i>Support</a></li>
						   <li><a class="dropdown-item d-flex" href="portal/logout"><i class="ti ti-logout fs-18 me-2"></i>Log Out</a></li>
					   </ul>
					   </div>
			   </div>
			   <!-- End::header-element -->

			   <!-- Start::header-element -->
			   <div class="header-element">
				   <!-- Start::header-link|switcher-icon -->
				   {{-- <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
					   <i class="ri-settings-5-line animate-spin header-link-icon"></i>
				   </a> --}}
				   <!-- End::header-link|switcher-icon -->
			   </div>
			   <!-- End::header-element -->

		   </div>
		   <!-- End::header-content-right -->

	   </div>
	   <!-- End::main-header-container -->

   </header>

   @include('admin.components.sidebar')