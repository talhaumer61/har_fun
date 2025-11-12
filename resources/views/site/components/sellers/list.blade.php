<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="position-relative">
                <div class="accordion-box grid-style show">
                    <div class="row">
                        @forelse($sellers as $seller)
                            <div class="col-xxl-3 col-lg-4 col-sm-6 d-flex">
                                <div class="candidate-profile-card text-center grid-layout border-0 mb-25">
                                    {{-- <a href="{{ url('/sellers/' . $seller->id) }}" class="save-btn tran3s"><i class="bi bi-heart"></i></a> --}}
                                    <div class="cadidate-avatar position-relative d-block m-auto">
                                        <a href="{{ url('/sellers/' . $seller->id) }}" class="rounded-circle">
                                            <img src="{{ asset($seller->profile_picture ?? $seller->photo ?? 'site/images/candidates/default.jpg') }}" 
                                                 alt="{{ $seller->name }}" 
                                                 class="lazy-img rounded-circle">
                                        </a>
                                    </div>
                                    <h4 class="candidate-name mt-15 mb-0">
                                        <a href="{{ url('/sellers/' . $seller->id) }}" class="tran3s">{{ $seller->name }}</a>
                                    </h4>
                                    <div class="candidate-post">{{ $seller->headline ?? 'Freelancer' }}</div>
                                    {{-- ⭐ Rating --}}
                                    @if($seller->avg_rating)
                                        <div class="rating mt-1 mb-2">
                                            @php $stars = round($seller->avg_rating); @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi {{ $i <= $stars ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                            @endfor
                                            <span class="ms-1 text-dark fw-500">({{ number_format($seller->avg_rating, 1) }})</span>
                                        </div>
                                    @else
                                        <div class="rating mt-1 mb-2">
                                            <i class="bi bi-star text-muted"></i>
                                            <span class="ms-1 text-muted">No rating</span>
                                        </div>
                                    @endif
                                    <ul class="cadidate-skills style-none d-flex flex-wrap align-items-center justify-content-center pt-30 sm-pt-20 pb-10">
                                        <li class="bg-success text-white">{{ $seller->category_name ?? 'N/A' }}</li>
                                        <li class="bg-info text-dark">{{ ucwords($seller->availability ?? 'Available') }}</li>
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
                        @empty
                            <div class="col-12 text-center py-5 bg-white rounded">
                                <h5 class="text-danger">No workers found!</h5>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchInput');
    const resultsDiv = document.getElementById('sellersContainer');

    function fetchResults(query = '') {
        fetch(`/search-sellers?query=${encodeURIComponent(query)}`)
            .then(res => res.text())
            .then(html => {
                resultsDiv.innerHTML = html; // inject only sellers grid
            });
    }

    fetchResults();

    input.addEventListener('keyup', function() {
        fetchResults(this.value.trim());
    });

    document.getElementById('searchForm').addEventListener('submit', e => e.preventDefault());
});

</script>
