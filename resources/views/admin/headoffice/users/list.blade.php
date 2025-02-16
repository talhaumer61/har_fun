<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-medium fs-24 mb-0">Users</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active d-inline-flex" aria-current="page">Users</li>
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
                        <div class="card-title">Users List</div>
                        {{-- <div class="d-flex align-items-center">
                            <a href="{{ route('admin.users', ['action' => 'add']) }}" class="btn btn-primary">
                                <i class="ri ri-add-line me-2"></i>Add User
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="userTypeFilter">Filter by User Type:</label>
                            <select id="userTypeFilter" class="form-control">
                                <option value="">All</option>
                                <option value="2">Client</option>
                                <option value="3">Seller</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Photo</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--End::row-1 -->

    </div>
</div>

