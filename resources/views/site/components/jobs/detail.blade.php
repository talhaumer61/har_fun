<section class="job-details style-two pt-100 lg-pt-80 pb-130 lg-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-xxl-9 col-xl-10 m-auto">
                <div class="details-post-data ps-xxl-4 pe-xxl-4">
                    <ul class="job-meta-data-two d-flex flex-wrap justify-content-center justify-content-lg-between style-none row">
                        <div class="col-md-2 bg-wrapper bg-white text-center">
                            <img src="{{asset('site/images/icon/icon_52.svg')}}" alt="" class="lazy-img m-auto icon">
                            <span>Budget</span>
                            <div>Rs. {{$job->job_budget}}</div>
                        </div>
                        <div class="col-md-3 bg-wrapper bg-white text-center">
                            <img src="{{asset('site/images/icon/icon_54.svg')}}" alt="" class="lazy-img m-auto icon">
                            <span>City</span>
                            <div>{{$job->city_name}} </div>
                        </div>
                        <div class="col-md-3 bg-wrapper bg-white text-center">
                            <img src="{{asset('site/images/icon/icon_54.svg')}}" alt="" class="lazy-img m-auto icon">
                            <span>Address</span>
                            <div>{{$job->job_location}} </div>
                        </div>
                        <div class="col-md-2 bg-wrapper bg-white text-center">
                            <img src="{{asset('site/images/icon/icon_56.svg')}}" alt="" class="lazy-img m-auto icon">
                            <span>Category</span>
                            <div>{{$job->category_name}}</div>
                        </div>
                    </ul>

                    <div class="post-block mt-50 lg-mt-40">
                        <h4 class="block-title">Overview</h4>
                        <p>{{ $job->job_overview }}</p>
                    </div>
                    <div class="post-block mt-60 lg-mt-40">
                        <h4 class="block-title">Job Description</h4>
                        <p>{{ $job->job_desc }}</p>
                    </div>
                    @if(session('user') && session('user')->login_type == 3 && !$hasApplied)
                        <a href="#" class="btn-ten fw-500 text-white text-center tran3s mt-30" data-bs-toggle="modal" data-bs-target="#applyJobModal">
                            Apply for this position
                        </a>
                    @endif
                    @if($hasApplied)
                        <p class="alert alert-info">You have already applied for this job.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Apply Job Modal -->
@if(session('user') && session('user')->login_type == 3)
    <div class="modal fade" id="applyJobModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('submit.proposal') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyJobModalLabel">Apply for this Job</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <!-- Job Budget -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Job Budget</label>
                            <div class="text-primary fs-5">Rs. {{ $job->job_budget }}</div>
                        </div>

                        <!-- Your Bid -->
                        <div class="mb-3">
                            <label for="bid_amount" class="form-label">Your Bid (in Rs.)</label>
                            <input type="number" class="form-control" id="bid_amount" name="bid_amount" placeholder="Enter your bid" required>
                        </div>

                        <!-- Cover Letter -->
                        <div class="mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter</label>
                            <textarea class="form-control" id="cover_letter" name="cover_letter" rows="4" placeholder="Write your proposal..." required></textarea>
                        </div>

                        <!-- Attach File (Optional) -->
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attach File (optional)</label>
                            <input class="form-control" type="file" id="attachment" name="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small id="fileHelp" class="form-text text-muted">Maximum file size: 2 MB</small>
                            <div id="attachment-error" style="color: red; margin-top: 5px;"></div>
                        </div>

                        <!-- Hidden Job ID -->
                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Proposal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

{{-- MODAL SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('applyJobModal');

        modal.addEventListener('hidden.bs.modal', function () {
            const form = modal.querySelector('form');
            form.reset(); // This clears inputs including file
        });
    });
</script>

{{-- PROPOSAL ATTACHMENT FILE SCRIPT --}}
<script>
    const attachmentInput = document.getElementById('attachment');
    const errorDiv = document.getElementById('attachment-error');

    // Allowed file extensions (lowercase)
    const allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

    attachmentInput.addEventListener('change', function () {
        errorDiv.textContent = ''; // Clear previous errors

        if (this.files.length > 0) {
            const file = this.files[0];

            // Validate file size
            const fileSizeKB = file.size / 1024;
            if (fileSizeKB > 2048) {
                errorDiv.textContent = 'File size must not exceed 2 MB.';
                this.value = ''; // Clear the file input
                return;
            }

            // Validate file type by extension
            const fileName = file.name.toLowerCase();
            const extension = fileName.split('.').pop();

            if (!allowedExtensions.includes(extension)) {
                errorDiv.textContent = 'Invalid file type. Allowed types: pdf, doc, docx, jpg, jpeg, png.';
                this.value = ''; // Clear the file input
                return;
            }
        }
    });

    // Prevent form submission if invalid
    const form = attachmentInput.closest('form');
    form.addEventListener('submit', function (e) {
        if (attachmentInput.files.length > 0) {
            const file = attachmentInput.files[0];
            const fileSizeKB = file.size / 1024;
            const fileName = file.name.toLowerCase();
            const extension = fileName.split('.').pop();

            if (fileSizeKB > 2048) {
                e.preventDefault();
                errorDiv.textContent = 'File size must not exceed 2 MB.';
                attachmentInput.focus();
                return;
            }

            if (!allowedExtensions.includes(extension)) {
                e.preventDefault();
                errorDiv.textContent = 'Invalid file type. Allowed types: pdf, doc, docx, jpg, jpeg, png.';
                attachmentInput.focus();
            }
        }
    });
</script>

