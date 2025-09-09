<section class="candidates-profile bg-color pt-90 lg-pt-70 pb-160 xl-pb-150 lg-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="position-relative">
                    
                    <div class="accordion-box grid-style show">
                        <div class="row">
                            @foreach($sellers as $seller)
                                <div class="col-xxl-3 col-lg-4 col-sm-6 d-flex">
                                    <div class="candidate-profile-card text-center grid-layout border-0 mb-25">
                                        <a href="{{ url('/sellers/' . $seller->id) }}" class="save-btn tran3s"><i class="bi bi-heart"></i></a>
                                        <div class="cadidate-avatar position-relative d-block m-auto">
                                            <a href="{{ url('/sellers/' . $seller->id) }}" class="rounded-circle">
                                                <img src="{{ asset($seller->profile_picture ?? $seller->photo ?? 'site/images/candidates/default.jpg') }}" alt="{{ $seller->name }}" class="lazy-img rounded-circle">
                                            </a>
                                        </div>
                                        <h4 class="candidate-name mt-15 mb-0">
                                            <a href="{{ url('/sellers/' . $seller->id) }}" class="tran3s">{{ $seller->name }}</a>
                                        </h4>
                                        <div class="candidate-post">{{ $seller->headline ?? 'Freelancer' }}</div>
                                        <ul class="cadidate-skills style-none d-flex flex-wrap align-items-center justify-content-center justify-content-md-center pt-30 sm-pt-20 pb-10">
                                            {{-- <li>{{ $seller->tagline ?? 'Skilled' }}</li> --}}
                                            <li>{{ $seller->category_name ?? 'N/A' }}</li>
                                            <li>{{ ucwords($seller->availability) ?? 'Available' }}</li>
                                        </ul>

                                        <div class="row gx-1">
                                            <div class="col-md-6">
                                                <div class="candidate-info mt-10">
                                                    <span>Hours</span>
                                                    <div>{{ $seller->working_hours ?? 'Flexible' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="candidate-info mt-10">
                                                    <span>Location</span>
                                                    <div>{{ $seller->city_name ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row gx-2 pt-25 sm-pt-10">
                                            <div class="col-md-6">
                                                <a href="{{ url('/sellers/' . $seller->id) }}" class="profile-btn tran3s w-100 mt-5">View Profile</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('/sellers/' . $seller->id) }}" class="msg-btn tran3s w-100 mt-5">Message</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    
                </div>
                <!-- /.-->
            </div>
            <!-- /.col- -->
        </div>
    </div>
</section>