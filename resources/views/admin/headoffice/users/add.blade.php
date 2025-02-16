<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-medium fs-24 mb-0">Add Category</h1>
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
            <form action="{{ route('admin.categories.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                    <div class="card custom-card ">
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <label for="product-name-add" class="form-label">Name</label>
                                    <input type="text" name="cat_name" class="form-control" id="product-name-add">
                                </div>
                                <div class="col-xl-6">
                                    <label for="product-category-add2" class="form-label">Status</label>
                                    <select class="form-select" name="cat_status" aria-label="Default select example">
                                        <option selected>Choose One...
                                        </option>
                                        @foreach (get_admstatus() as $status)
                                            <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <label for="product-Features-add" class="form-label">Description</label>
                                    <textarea class="form-control" name="cat_desc" rows="2"></textarea>
                                    <label for="product-Features-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Description should not exceed 500 letters</label>
                                </div>
                                <div class="col-xl-12">
                                    <label for="product-Features-add" class="form-label">Detail</label>
                                    <textarea class="form-control" name="cat_detail" id="ckeditor" rows="2"></textarea>
                                </div>
                                <div class="col-xl-12 product-documents-container">
                                    <p class="fw-semibold mb-2 fs-14">Icon :</p>
                                    <input type="file" class="filepond basic-filepond" name="cat_icon" data-allow-reorder="true" data-max-file-size="3MB" data-max-files="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 pb-3  d-sm-flex justify-content-end">
                    <a class="btn btn-danger m-1" href="{{ route('admin.categories') }}"><i class="ti ti-arrow-left me-2"></i>Cancel</a>
                    <button type="submit" class="btn btn-primary m-1"><i class="ri-add-line me-2"></i>Add Category</button>
                </div>
            </form>
        </div>
        <!-- End:: row-1 -->

    </div>
</div>