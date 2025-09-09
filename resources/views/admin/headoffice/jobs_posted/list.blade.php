<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-medium fs-24 mb-0">Job Posted</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active d-inline-flex" aria-current="page">Job List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Jobs List
                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <a href="{{ route('admin.categories', ['action' => 'add']) }}" class="btn btn-primary">
                                <i class="ri ri-add-line me-2"></i>Add Category
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        @if ($jobs->isEmpty())
                            <div class="alert alert-danger text-center">
                                No jobs posted yet.
                            </div>
                        @else
                            <div class="table-responsive mb-4">
                                <table class="table text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="60" class="text-center">Sr.</th>
                                            <th>Title</th>
                                            <th>Customer</th>
                                            <th>Budget</th>
                                            <th>Status</th>
                                            <th>Date Posted</th>
                                            {{-- <th width="80" class="text-center">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sr = 1; @endphp
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td class="text-center">{{ $sr }}</td>
                                                <td>
                                                    <strong>{{ $job->job_title }}</strong><br>
                                                    <small class="text-muted">{{ $job->job_location }}</small>
                                                </td>
                                                <td>
                                                    <div>{{ $job->customer_name }}</div>
                                                    <small class="text-muted">{{ $job->customer_email }}</small>
                                                </td>
                                                <td>
                                                    {{ number_format($job->job_budget) }}
                                                </td>
                                                <td>
                                                    @php
                                                        $statusMap = [
                                                            0 => ['label' => 'Cancelled', 'class' => 'badge bg-danger'],
                                                            1 => ['label' => 'Completed', 'class' => 'badge bg-success'],
                                                            2 => ['label' => 'Pending', 'class' => 'badge bg-warning'],
                                                            3 => ['label' => 'In Progress', 'class' => 'badge bg-primary'],
                                                        ];
                                                        $status = $statusMap[$job->job_status] ?? ['label' => 'Unknown', 'class' => 'badge bg-secondary'];
                                                    @endphp
                                                    <span class="{{ $status['class'] }}">{{ $status['label'] }}</span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($job->date_added)->format('d M, Y') }}</td>
                                                {{-- <td class="text-center">
                                                    <a href="{{ route('admin.job.details', ['href' => $job->job_href]) }}" class="btn btn-sm btn-info-light" title="View Details">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                            @php $sr++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        
        
        <!--End::row-1 -->

    </div>
</div>