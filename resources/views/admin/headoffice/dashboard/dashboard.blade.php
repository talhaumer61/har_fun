<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-medium fs-24 mb-0">Dashboard</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active d-inline-flex" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xxl-9 col-xl-12 col-lg-12">
                <div class="row gap-3 gap-sm-0">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="avatar avatar-md avatar-rounded p-2 bg-primary-transparent">
                                        <i class="ri-group-line fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="d-flex flex-wrap mb-1 align-items-top justify-content-between">
                                            <h5 class="fw-semibold mb-0 lh-1">{{ $totalUsers }}</h5>
                                        </div>
                                        <p class="mb-0 fs-10 op-7 text-muted fs-12">Total Users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="avatar avatar-md avatar-rounded p-2 bg-secondary-transparent">
                                        <i class="ri-user-line fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="d-flex flex-wrap mb-1 align-items-top justify-content-between">
                                            <h5 class="fw-semibold mb-0 lh-1">{{ $totalCustomers }}</h5>
                                        </div>
                                        <p class="mb-0 fs-10 op-7 text-muted fs-12">Total Customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="avatar avatar-md avatar-rounded p-2 bg-warning-transparent">
                                        <i class="ri-user-follow-line fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="d-flex flex-wrap mb-1 align-items-top justify-content-between">
                                            <h5 class="fw-semibold mb-0 lh-1">{{ $totalWorkers }}</h5>
                                        </div>
                                        <p class="mb-0 fs-10 op-7 text-muted fs-12">Total Workers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="avatar avatar-md avatar-rounded p-2 bg-info-transparent">
                                            <i class="ri-money-dollar-circle-line fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="d-flex flex-wrap mb-1 align-items-top justify-content-between">
                                            <h5 class="fw-semibold mb-0 lh-1">PKR {{ number_format($totalPayments, 2) }}</h5>
                                        </div>
                                        <p class="mb-0 fs-10 op-7 text-muted fs-12">Total Payments (Paid)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="avatar avatar-md avatar-rounded p-2 bg-danger-transparent">
                                            <i class="ri-pie-chart-line fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="d-flex flex-wrap mb-1 align-items-top justify-content-between">
                                            <h5 class="fw-semibold mb-0 lh-1">PKR {{ number_format($totalCommission, 2) }}</h5>
                                        </div>
                                        <p class="mb-0 fs-10 op-7 text-muted fs-12">Total Commission</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="avatar avatar-md avatar-rounded p-2 bg-success-transparent">
                                            <i class="ri-briefcase-4-line fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="d-flex flex-wrap mb-1 align-items-top justify-content-between">
                                            <h5 class="fw-semibold mb-0 lh-1">PKR {{ number_format($totalWorkerEarnings, 2) }}</h5>
                                        </div>
                                        <p class="mb-0 fs-10 op-7 text-muted fs-12">Total Worker Earnings</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xl-9">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header justify-content-between">
                                <div class="card-title">Applications Overview</div>
                                <div class="dropdown">
                                    <a aria-label="anchor" href="javascript:void(0);" class="btn btn-sm btn-outline-light shadow-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                        This Week <i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Download</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Import</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Export</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row border-bottom border-block-end-dashed ps-3">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="p-3 border-sm-end border-inline-end-dashed text-sm-start text-center">
                                            <p class="fs-20 fw-semibold mb-0"><span class="basic-subscription">742</span>1,117</p>
                                            <p class="mb-0 text-muted">Total Candidates</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="p-3 border-sm-end border-inline-end-dashed text-sm-start text-center">
                                            <p class="fs-20 fw-semibold mb-0"><span class="basic-application d-inline-block">742</span></p>
                                            <p class="mb-0 text-muted">Basic Applications</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="p-3 text-sm-start text-center">
                                            <p class="fs-20 fw-semibold mb-0"><span class="pro-subscription">259</span></p>
                                            <p class="mb-0 text-muted">Pro Shortlisted</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="subscriptionOverview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">New Applicants</div>
                                <button type="button" class="btn btn-sm btn-outline-light">View All</button>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-4">
                                        <a href="javascript:void(0);">
                                            <div class="d-flex algn-items-center">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="{{asset('admin/img/users/9.jpg')}}" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-2">
                                                    <p class="fw-semibold mb-0">Charlie Davieson</p>
                                                    <p class="fs-12 text-muted mb-0">Applied For <span class="text-default">Java Developer</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="javascript:void(0);">
                                            <div class="d-flex algn-items-center">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="{{asset('admin/img/users/2.jpg')}}" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-2">
                                                    <p class="fw-semibold mb-0">Nasiha</p>
                                                    <p class="fs-12 text-muted mb-0">Applied For <span class="text-default">Data Analyst</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="javascript:void(0);">
                                            <div class="d-flex algn-items-center">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="{{asset('admin/img/users/4.jpg')}}" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-2">
                                                    <p class="fw-semibold mb-0">Hasi Nah</p>
                                                    <p class="fs-12 text-muted mb-0">Applied For <span class="text-default">Executive Officer</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-4">
                                        <a href="javascript:void(0);">
                                            <div class="d-flex algn-items-center">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="{{asset('admin/img/users/14.jpg')}}" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-2">
                                                    <p class="fw-semibold mb-0">David</p>
                                                    <p class="fs-12 text-muted mb-0">Applied For <span class="text-default">Developer</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-0">
                                        <a href="javascript:void(0);">
                                            <div class="d-flex algn-items-center">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="{{asset('admin/img/users/16.jpg')}}" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill ms-2">
                                                    <p class="fw-semibold mb-0">Jack Bruce</p>
                                                    <p class="fs-12 text-muted mb-0">Applied For <span class="text-default">Data Scientist</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="financeChart"></div>
            </div>
        </div>
        <!--Recent Workers -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Recent Workers
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover border table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentType3 as $worker)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center fw-semibold">
                                                    <span class="avatar avatar-sm me-2 avatar-rounded">
                                                        <img src="{{ $worker->profile_picture ? asset($worker->profile_picture) : asset('admin/img/users/default.jpg') }}" alt="img">
                                                    </span>
                                                    {{ $worker->name }}
                                                </div>
                                            </td>
                                            <td>{{ $worker->category_name ?? 'N/A' }}</td>
                                            {{-- <td><span class="badge bg-primary-transparent">Worker</span></td> --}}
                                            <td>{{ $worker->email }}</td>
                                            <td>
                                                <div class="d-inline-flex align-items-center">
                                                    <i class="ri-map-pin-fill text-muted fs-10"></i>
                                                    <span class="ms-1">{{ $worker->city_name ?? 'Unknown' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Recent Users --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Recent Users
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover border table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentType2 as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center fw-semibold">
                                                    <span class="avatar avatar-sm me-2 avatar-rounded">
                                                        <img src="{{ $user->photo ? asset($user->photo) : asset('admin/img/users/default.jpg') }}" alt="img">
                                                    </span>
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td>{{ $user->username ?? 'N/A' }}</td>
                                            {{-- <td><span class="badge bg-primary-transparent">Worker</span></td> --}}
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="d-inline-flex align-items-center">
                                                    <i class="ri-map-pin-fill text-muted fs-10"></i>
                                                    <span class="ms-1">{{ $user->phone ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>