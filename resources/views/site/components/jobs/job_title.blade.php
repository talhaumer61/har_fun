<div class="inner-banner-one position-relative">
    <div class="container">
        <div class="position-relative">
            <div class="row">
                <div class="col-xl-8 m-auto text-center">
                    <div class="post-date">
                        <span class="fw-bold text-light">{{ \Carbon\Carbon::parse($job->date_added)->toDateString() }}</span> by <span class="fw-bold text-light">{{$job->customer_name}}</span>
                    </div>
                    <div class="title-two">
                        <h2 class="text-white">{{ $job_title }}</h2>
                        <!-- <h2 class="text-white">Senior Product & Brand Design</h2> -->
                    </div>
                    {{-- <ul class="share-buttons d-flex flex-wrap justify-content-center style-none mt-10">
                        <li><a href="#" class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-facebook"></i>
                            <span>Facebook</span>
                        </a></li>
                        <li><a href="#" class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-twitter"></i>
                            <span>Twitter</span>
                        </a></li>
                        <li><a href="#" class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-link-45deg"></i>
                            <span>Copy</span>
                        </a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('site/images/shape/shape_02.svg')}}" alt="" class="lazy-img shapes shape_01">
    <img src="{{asset('site/images/shape/shape_03.svg')}}" alt="" class="lazy-img shapes shape_02">
</div>