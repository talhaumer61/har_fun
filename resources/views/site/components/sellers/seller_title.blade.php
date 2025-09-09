{{-- <div class="inner-banner-one position-relative">
    <div class="container">
        <div class="candidate-profile-card list-layout">
            <div class="d-flex align-items-start align-items-xl-center">
                <div class="cadidate-avatar position-relative d-block me-auto ms-auto"><a href="#" class="rounded-circle"><img src="{{asset('site/images/candidates/img_01.jpg')}}" alt="" class="lazy-img rounded-circle"></a></div>
                <div class="right-side">
                    <div class="row gx-1 align-items-center">
                        <div class="col-xl-2 order-xl-0">
                            <div class="position-relative">
                                <h4 class="candidate-name text-white mb-0">{{ $seller_name }}</h4>
                                <div class="candidate-post">UI Designer</div>
                            </div>
                        </div>
                        <div class="col-xl-3 order-xl-3">
                            <ul class="cadidate-skills style-none d-flex flex-wrap align-items-center">
                                <li>Design</li>
                                <li>UI</li>
                                <li>Digital</li>
                                <li class="more">2+</li>
                            </ul>
                            <!-- /.cadidate-skills -->
                        </div>
                        <div class="col-xl-2 col-md-4 order-xl-1">
                            <div class="candidate-info">
                                <span>Location</span>
                                <div>New York, US</div>
                            </div>
                            <!-- /.candidate-info -->
                        </div>
                        <div class="col-xl-2 col-md-4 order-xl-2">
                            <div class="candidate-info">
                                <span>Salary</span>
                                <div>$30k-$50k/yr</div>
                            </div>
                            <!-- /.candidate-info -->
                        </div>
                        <div class="col-xl-3 col-md-4 order-xl-4">
                            <div class="d-flex justify-content-md-end">
                                <a href="#" class="save-btn text-center rounded-circle tran3s"><i class="bi bi-heart"></i></a>
                                <a href="#" class="cv-download-btn fw-500 tran3s ms-md-3 sm-mt-20">Download CV</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <img src="{{asset('site/images/shape/shape_02.svg')}}" alt="" class="lazy-img shapes shape_01">
    <img src="{{asset('site/images/shape/shape_03.svg')}}" alt="" class="lazy-img shapes shape_02">
</div> --}}

<div class="inner-banner-one position-relative">
    <div class="container">
        <div class="position-relative">
            <div class="row">
                <div class="col-xl-6 m-auto text-center">
                    <div class="title-two">
                        <h2 class="text-white">{{ $seller_name }}</h2>
                    </div>
                    <p class="text-lg text-white mt-30 lg-mt-20 mb-35 lg-mb-20">{{ $profile->category->cat_name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('site/images/shape/shape_02.svg')}}" alt="" class="lazy-img shapes shape_01">
    <img src="{{asset('site/images/shape/shape_03.svg')}}" alt="" class="lazy-img shapes shape_02">
</div>