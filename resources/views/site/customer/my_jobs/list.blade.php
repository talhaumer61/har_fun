        <div class="d-sm-flex align-items-center justify-content-between mb-40 lg-mb-30">
            <h2 class="main-title m0">My Jobs</h2>
        </div>

        <div class="bg-white card-box border-20">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="a1" role="tabpanel">
                    <div class="table-responsive">
                        @if ($my_jobs->isNotEmpty())
                            <table class="table job-alert-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0"> 
                                    @foreach ($my_jobs as $job)
                                    <tr class="{{ $job->job_status==1 ? 'pending' : 'active' }}">
                                        <td>
                                            <div class="job-name fw-500">{{ $job->job_title }}</div>
                                            <div class="info1">{{ $job->cat_name }}</div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($job->date_added)->format('d M, Y') }}</td>
                                        <td>{{ $job->pending_proposals ?? '0' }} Applications</td>
                                        <td><div class="job-status">{!! get_jobstatus($job->job_status) !!}</div></td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <button class="action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="/my-jobs/proposals/{{$job->job_href}}">
                                                        <img src="{{ asset('site/dashboard/icon/icon_18.svg') }}" alt="" class="lazy-img"> View Proposals</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"><img src="{{ asset('site/dashboard/icon/icon_19.svg') }}" alt="" class="lazy-img"> Share</a></li>
                                                    <li><a class="dropdown-item" href="#"><img src="{{ asset('site/dashboard/icon/icon_20.svg') }}" alt="" class="lazy-img"> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#"><img src="{{ asset('site/dashboard/icon/icon_21.svg') }}" alt="" class="lazy-img"> Delete</a></li>

                                                    {{-- ✅ Show Mark Completed if job_status = 3 --}}
                                                    @if ($job->job_status == 3 && $job->client_completed == 0)
                                                        <li>
                                                            <form method="POST" action="{{ route('customer.job.complete', $job->job_id) }}" class="complete-job-form">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item text-success">
                                                                    <img src="{{ asset('site/dashboard/icon/icon_20.svg') }}" alt="" class="lazy-img"> ✅ Mark Completed
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @elseif ($job->client_completed)
                                                        <li><span class="dropdown-item text-info">✔ You marked as completed</span></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <h3 class="text-center text-danger">No Record Found!</h3>
                        @endif
                        
                        <div class="mt-3">
                            {{-- {{ $my_jobs->links('pagination::bootstrap-5') }} --}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@if (session('show_review_modal'))
<div class="modal fade" id="reviewModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('customer.review.store', session('show_review_modal')) }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="">Select</option>
                        @for ($i=1; $i<=5; $i++)
                            <option value="{{ $i }}">{{ $i }} Star{{ $i>1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="review_text" class="form-label">Review</label>
                    <textarea name="review_text" class="form-control" rows="3" placeholder="Write your feedback..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit Review</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
        reviewModal.show();
    });
</script>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.complete-job-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You are marking this job as completed.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark as completed'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
});
</script>
