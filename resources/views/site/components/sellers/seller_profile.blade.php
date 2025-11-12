<style>
.modal-content {
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
}

.modal-header {
  background-color: #1f2937; /* Dark tone */
  color: white;
  border-bottom: none;
}

.modal-body img {
  object-fit: cover;
  width: 100%;
  height: auto;
}

.modal-body p {
  font-size: 1.125rem;
  color: #4b5563;
  font-style: italic;
}


</style>
<section class="candidates-profile bg-color pt-100 lg-pt-70 pb-150 lg-pb-80">
    <div class="container">
        <div class="row">
            <!-- LEFT CONTENT -->
            <div class="col-xxl-9 col-lg-8">
                <div class="candidates-profile-details me-xxl-5 pe-xxl-4">
                    <!-- Overview -->
                    <div class="inner-card mb-65 lg-mb-40">
                        <h3 class="title">Overview</h3>
                        <p>{{ $profile->bio ?? 'No overview available.' }}</p>
                    </div>

                    <!-- Intro (Video if any) -->
                    @if(!empty($profile->intro_video))
                    <h3 class="title">Intro</h3>
                    <div class="video-post d-flex align-items-center justify-content-center mt-25 lg-mt-20 mb-75 lg-mb-50">
                        <a class="fancybox rounded-circle video-icon tran3s text-center" data-fancybox="" href="{{ $profile->intro_video }}">
                            <i class="bi bi-play"></i>
                        </a>
                    </div>
                    @endif

                    <!-- Education -->
                    @if($user->educations && $user->educations->count())
                    <div class="inner-card mb-75 lg-mb-50">
                        <h3 class="title">Education</h3>
                        <div class="time-line-data position-relative pt-15">
                            @foreach($user->educations as $index => $edu)
                            <div class="info position-relative">
                                <div class="numb fw-500 rounded-circle d-flex align-items-center justify-content-center">{{ $index+1 }}</div>
                                <div class="text_1 fw-500">{{ $edu->institution }}</div>
                                <h4>{{ $edu->degree }}</h4>
                                <p>{{ $edu->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Skills -->
                    {{-- @php $skills = explode(',', $profile->skills ?? ''); @endphp
                    @if(count($skills))
                    <div class="inner-card mb-75 lg-mb-50">
                        <h3 class="title">Skills</h3>
                        <ul class="style-none skill-tags d-flex flex-wrap pb-25">
                            @foreach($skills as $skill)
                                <li>{{ trim($skill) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}

                    <!-- Work Experience -->
                    @if($user->experiences && $user->experiences->count())
                    <div class="inner-card mb-60 lg-mb-50">
                        <h3 class="title">Work Experience</h3>
                        <div class="time-line-data position-relative pt-15">
                            @foreach($user->experiences as $index => $exp)
                            <div class="info position-relative">
                                <div class="numb fw-500 rounded-circle d-flex align-items-center justify-content-center">{{ $index+1 }}</div>
                                <div class="text_1 fw-500">{{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}</div>
                                <h4>{{ $exp->position }} ({{ $exp->company }})</h4>
                                <p>{{ $exp->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Portfolio -->
                    @if($portfolios->count())
                        <div class="inner-card mb-75 lg-mb-50">
                            <h3 class="title">Portfolio</h3>
                            <div class="row">
                                @foreach($portfolios as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0 rounded-4">
                                        <a href="javascript:void(0)" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#portfolioDetailModal"
                                        data-title="{{ $item->title }}"
                                        data-description="{{ $item->description }}"
                                        data-image="{{ asset($item->image) }}"
                                        data-link="{{ $item->external_link }}">
                                            <img src="{{ asset($item->image) }}" class="card-img-top rounded-top" style="height: 200px; object-fit: cover;">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">{{ $item->title }}</h5>
                                            <p class="card-text text-muted" style="font-size: 0.9rem; height: 60px; overflow: hidden;">{{ Str::limit($item->description, 100) }}</p>
                                            @if($item->external_link)
                                                <a href="{{ $item->external_link }}" target="_blank" class="btn btn-sm btn-outline-primary">Visit</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Reviews Section -->
                    @if($user->reviewsReceived->count() > 0)
                        <div class="inner-card mb-75 lg-mb-50">
                            <h3 class="title">Client Reviews ({{ $user->reviewsReceived->count() }})</h3>
                            @foreach($user->reviewsReceived as $review)
                                <div class="border rounded-4 shadow-sm p-4 mb-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="fw-semibold">{{ $review->customer->name ?? 'Anonymous' }}</div>
                                        <div>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-2 text-muted" style="font-style: italic;">{{ $review->review_text }}</p>
                                    <small class="text-secondary">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="inner-card mb-75 lg-mb-50">
                            <h3 class="title">Client Reviews</h3>
                            <p class="text-muted fst-italic">No reviews yet.</p>
                        </div>
                    @endif



                </div>
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-xxl-3 col-lg-4">
    <div class="cadidate-profile-sidebar ms-xl-5 ms-xxl-0 md-mt-60">
        <div class="cadidate-bio bg-wrapper mb-60 md-mb-40 text-center py-3">

            {{-- Worker Profile Photo --}}
            @php
                $profilePic = $profile->profile_picture 
                    ? asset($profile->profile_picture)
                    : asset('images/default_user.png')
            @endphp
            <div class="d-flex justify-content-center">
                <img src="{{ $profilePic }}" alt="{{ $user->name }}" class="rounded-circle shadow-sm mb-3" style="width: 130px; height: 130px; object-fit: cover; border: 3px solid #f1f1f1;">
            </div>

            {{-- Name & Headline --}}
            <h5 class="fw-600 mb-1">{{ $user->name }}</h5>
            <p class="text-muted small mb-4">{{ $profile->headline ?? 'Freelancer' }}</p>

            {{-- Worker Info List --}}
            <ul class="style-none text-start">
                <li class="border-0"><span>Location:</span><div>{{ $profile->city->name ?? 'N/A' }}</div></li>
                <li class="border-0"><span>Experience:</span><div>{{ $profile->experience_years ? $profile->experience_years . ' Years' : 'N/A' }}</div></li>
                <li class="border-0"><span>Working Hours:</span><div>{{ $profile->working_hours ? $profile->working_hours . ' Hours' : 'N/A' }}</div></li>
                <li class="border-0"><span>Availability:</span><div>{{ ucwords($profile->availability ?? 'N/A') }}</div></li>
                <li><span>Email:</span><div><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div></li>
            </ul>

            {{-- Resume Download Button --}}
            @if($profile->resume)
                <a href="{{ asset($profile->resume) }}" 
                   class="btn-ten fw-500 text-white w-100 text-center tran3s mt-15" 
                   download>
                   Download CV
                </a>
            @endif
        </div>
    </div>
</div>

        </div>
        @if (session('user') && session('user')->login_type == 2)   
            <form method="GET" action="{{ route('chat.index') }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}"> 
                {{-- <input type="hidden" name="job_id" value="{{ $proposal->job_id }}"> --}}
                <button type="submit" class="btn btn-sm btn-primary">Message</button>
            </form>
        @endif
    </div>
</section>


<!-- Portfolio Detail Modal -->
<!-- Modal HTML -->
<div class="modal fade" id="portfolioDetailModal" tabindex="-1" role="dialog" aria-labelledby="portfolioModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">

      <!-- Modal Header -->
      <div class="modal-header bg-light text-dark">
        <h5 class="modal-title fw-semibold" id="portfolioModalTitle">Title</h5>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-0">
        <div class="image-section w-100">
          <img id="portfolioModalImage" src="" class="img-fluid w-100">
        </div>
        <div class="p-4">
          <p class="mb-0 fs-5 text-muted" id="portfolioModalDescription">Description here</p>
        </div>
        <div class="text-center p-3">
            <a id="portfolioModalLink" href="#" target="_blank" class="btn btn-primary d-none">Visit Link</a>
        </div>
      </div>

    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('portfolioDetailModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        const title = trigger.getAttribute('data-title');
        const description = trigger.getAttribute('data-description');
        const image = trigger.getAttribute('data-image');
        const link = trigger.getAttribute('data-link');

        document.getElementById('portfolioModalTitle').textContent = title;
        document.getElementById('portfolioModalDescription').textContent = description;
        document.getElementById('portfolioModalImage').src = image;

        const linkBtn = document.getElementById('portfolioModalLink');
        if (link) {
            linkBtn.href = link;
            linkBtn.classList.remove('d-none');
        } else {
            linkBtn.classList.add('d-none');
        }
    });
});
</script>
