        <div class="d-flex align-items-center justify-content-between mb-40 lg-mb-30">
            <h2 class="main-title m0">Ongoing Jobs</h2>
        </div>

        <div class="wrapper">
            @forelse ($jobs as $job)
                <div class="job-list-one style-two position-relative mb-20">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xxl-3 col-lg-4">
                            <div class="job-title d-flex align-items-center">
                                <a href="#" class="title fw-500 tran3s">{{ $job->job_title }}</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 ms-auto">
                            <div class="job-salary">
                                <span class="fw-500 text-dark">PKR {{ number_format($job->job_amount, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            @if (!$job->worker_completed)
                                <form method="POST" action="{{ route('worker.job.complete', $job->job_id) }}" class="complete-job-form d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm complete-job-btn">
                                        ✅ Mark Completed
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-info">You marked as completed</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>No ongoing jobs.</p>
            @endforelse
        </div>
			
    </div>
</div>

{{-- SweetAlert Script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.complete-job-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Stop form from submitting immediately
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
                form.submit(); // Submit only if confirmed
            }
        })
    });
});
</script>