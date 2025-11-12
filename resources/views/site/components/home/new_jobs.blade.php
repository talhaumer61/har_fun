        <section class="job-listing-one mt-180 xl-mt-150 lg-mt-100">
            <div class="container">
                <div class="row justify-content-between align-items-center">
					<div class="col-lg-6">
						<div class="title-one">
							<h2 class="text-dark">{{__('New job listing')}}</h2>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="d-flex justify-content-lg-end">
							<a href="/jobs" class="btn-six d-none d-lg-inline-block">{{__('Explore all jobs')}}</a>
						</div>
					</div>
				</div>

                <div class="job-listing-wrapper border-wrapper mt-80 lg-mt-40 wow fadeInUp">
					@foreach ($latest_jobs as $job)
						<div class="job-list-one position-relative bottom-border">
							<div class="row justify-content-between align-items-center">
								<div class="col-xxl-3 col-lg-4">
									<div class="job-title d-flex align-items-center">
										<!-- Display Category Icon -->
										<img src="{{ asset(''. $job->cat_icon.'') }}" alt="{{ $job->cat_icon }}" class="lazy-img m-auto" style="width: 50px; height: 50px;">
										<!-- Display Job Title -->
										<a href="/jobs/{{ $job->job_href }}" class="title fw-500 tran3s">{{ $job->job_title }}</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-4 col-sm-6 ms-auto">
									<!-- Display Job Type (Full-time/Part-time) -->
									{{-- <a href="/jobs/{{ $job->job_href }}" class="job-duration fw-500">{{ $job->job_type }}</a> --}}
									<!-- Display Job Posted Date -->
									<div class="job-date">{{ \Carbon\Carbon::parse($job->date_added)->format('d M Y') }} by <a href="/jobs/{{ $job->job_href }}">{{ $job->name }}</a></div>
								</div>
								<div class="col-xxl-2 col-lg-3 col-md-4 col-sm-6 ms-auto xs-mt-10">
									<!-- Display Job Location -->
									<div class="job-location">
										<a href="/jobs/{{ $job->job_href }}">{{ $job->job_location }}</a>
									</div>
									<!-- Display Job Categories -->
									<div class="job-category">
											<a href="/jobs/{{ $job->cat_href }}">{{ __($job->cat_name) }}</a>
									</div>
								</div>
								<div class="col-lg-2 col-md-4">
									<div class="btn-group d-flex align-items-center justify-content-md-end sm-mt-20">
										<!-- Save Job Button -->
										{{-- <a href="/jobs/{{ $job->job_href }}" class="save-btn text-center rounded-circle tran3s me-3" title="Save Job">
											<i class="bi bi-bookmark-dash"></i>
										</a> --}}
										<!-- Apply Button -->
										<a href="/jobs/{{ $job->job_href }}" class="apply-btn text-center tran3s">{{__('Apply')}}</a>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				
                <!-- /.job-listing-wrapper -->

				<div class="text-center mt-40 d-lg-none">
					<a href="/jobs" class="btn-six">{{__('Explore all jobs')}}</a>
				</div>

				<div class="text-center mt-80 lg-mt-30 wow fadeInUp">
					<div class="btn-eight fw-500">{{__('Do you want to post a job?')}}  </div>
					<div><a href="sign-up" class="btn text-success" style="text-decoration: underline">{{__('Click here')}}</a></div>
				</div>
            </div>
        </section>