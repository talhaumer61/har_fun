<section class="job-listing-three bg-color pt-90 lg-pt-80 pb-160 xl-pb-150 lg-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="job-post-item-wrapper">
                    <div class="upper-filter d-flex justify-content-between align-items-start align-items-md-center mb-25">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <button type="button" class="filter-btn fw-500 tran3s me-3" data-bs-toggle="modal" data-bs-target="#filterPopUp">
                                <i class="bi bi-funnel"></i>
                                Filter
                            </button>
                            <div class="total-job-found md-mt-10">All <span class="text-dark fw-500">7,096</span> jobs found</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="short-filter d-flex align-items-center">
                                <div class="text-dark fw-500 me-2">Short:</div>
                                <select class="nice-select">
                                    <option value="0">Latest</option>
                                    <option value="1">Category</option>
                                    <option value="2">Job Type</option>
                                </select>
                            </div>
                            <button class="style-changer-btn text-center rounded-circle tran3s ms-2 list-btn active" title="Active List"><i class="bi bi-list"></i></button>
                            <button class="style-changer-btn text-center rounded-circle tran3s ms-2 grid-btn" title="Active Grid"><i class="bi bi-grid"></i></button>
                        </div>
                    </div>
                    
                    <div class="accordion-box grid-style show">
                        <div class="row">
                            @foreach($jobs as $job)
                                <div class="col-lg-4 mb-30">
                                    <div class="job-list-two position-relative">
                                        <a href="{{ url('/job/' . $job->job_href) }}" class="logo">
                                            <img src="{{ asset(''.$job->cat_icon.'') }}" alt="" class="lazy-img m-auto">
                                        </a>
                    
                                        <a href="{{ url('/job/' . $job->job_href) }}" class="save-btn text-center rounded-circle tran3s" title="Save Job">
                                            <i class="bi bi-bookmark-dash"></i>
                                        </a>
                    
                                        <div>
                                            <a href="{{ url('/job/' . $job->job_href) }}" class="job-duration fw-500 {{ strtolower($job->job_type ?? '') }}">
                                                {{ $job->job_type ?? 'Fulltime' }}
                                            </a>
                                        </div>
                    
                                        <div>
                                            <a href="{{ url('/job/' . $job->job_href) }}" class="title fw-500 tran3s">
                                                {{ $job->job_title }}
                                            </a>
                                        </div>
                    
                                        <div class="job-salary text-dark">
                                            Rs. 
                                            <span class="fw-500 text-dark">
                                                {{ ($job->job_budget) }}
                                            </span>
                                        </div>
                    
                                        <div class="d-flex align-items-center justify-content-between mt-auto">
                                            <div class="job-location">
                                                <a href="{{ url('/job/' . $job->job_href) }}">
                                                    {{ $job->job_location }}
                                                </a>
                                            </div>
                                            <a href="{{ url('/job/' . $job->job_href) }}" class="apply-btn text-center tran3s">APPLY</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- /.accordion-box -->

                </div>
                <!-- /.job-post-item-wrapper -->
            </div>
            <!-- /.col- -->
        </div>
    </div>
</section>