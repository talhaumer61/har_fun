<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-medium fs-24 mb-0">Job Categories</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active d-inline-flex" aria-current="page">Job Categories</li>
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
                            Categories List
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('admin.categories', ['action' => 'add']) }}" class="btn btn-primary">
                                <i class="ri ri-add-line me-2"></i>Add Category
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($categories->isEmpty())
                            <div class="alert alert-danger text-center">
                                No record found.
                            </div>
                        @else
                            <div class="table-responsive mb-4">
                                <table class="table text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="60" class="text-center">Sr.</th>
                                            <th>Name</th>
                                            <th width="40">Status</th>
                                            <th width="20">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sr = 1; @endphp
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="text-center">{{ $sr }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2">
                                                            <span class="avatar avatar-md bg-light p-2">
                                                                <img src="{{ asset($category->cat_icon) }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div class="fw-semibold">
                                                            {{ $category->cat_name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {!! get_admstatus($category->cat_status) !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.categories', ['action' => 'edit', 'href' => $category->cat_href]) }}" class="btn btn-icon btn-sm btn-info-light">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="confirmDelete('hf_job_categories', {{ $category->cat_id }}, 'cat_id');" class="btn btn-icon btn-sm btn-danger-light product-btn"><i class="ri-delete-bin-line"></i></a>
                                                </td>
                                            </tr>
                                            @php $sr++; @endphp
                                        @endforeach
                                    </tbody>                                    
                                </table>
                            </div>
                            
                            {{-- Bootstrap Pagination --}}
                            <div class="">
                                {{ $categories->links('pagination::bootstrap-5') }}
                            </div>
        
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--End::row-1 -->

    </div>
</div>