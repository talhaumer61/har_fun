        <div class="d-sm-flex align-items-center justify-content-between mb-40 lg-mb-30">
            <h2 class="main-title m0">Proposals</h2>
        </div>
        
        @if (count($job_proposals))
            @foreach ($job_proposals as $index => $proposal)
                <div class="bg-white card-box border-20 my-2">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="a1" role="tabpanel">
                            <div class="table-responsive">
                                <div class="border-bottom pb-3 mb-3">
                                    <h5>{{ $proposal->name }} <small class="text-muted">({{ $proposal->email }})</small></h5>
                                    <p><strong>Bid:</strong> Rs. {{ number_format($proposal->bid_amount) }}</p>

                                    {{-- Cover Letter --}}
                                    @php
                                        $shortCover = Str::limit(strip_tags($proposal->cover_letter), 120); // limit to 120 chars
                                    @endphp

                                    <p>
                                        <strong>Cover Letter:</strong>
                                        <span id="short-{{ $index }}">{{ $shortCover }}</span>
                                        <span id="full-{{ $index }}" style="display:none;">{{ $proposal->cover_letter }}</span>
                                        @if(strlen($proposal->cover_letter) > 120)
                                            <a href="javascript:void(0)" class="fw-bold text-primary" onclick="toggleCover({{ $index }})" id="toggle-btn-{{ $index }}">Read More</a>
                                        @endif
                                    </p>

                                    {{-- Attachment --}}
                                    @if($proposal->attachment)
                                        <p><a class="fw-bold" href="{{ asset($proposal->attachment) }}" target="_blank">Download Attachment</a></p>
                                    @endif     
                                    <form method="GET" action="{{ route('chat.index') }}">
                                        <input type="hidden" name="user_id" value="{{ $proposal->worker_id }}"> {{-- or user_id --}}
                                        <input type="hidden" name="job_id" value="{{ $proposal->job_id }}"> {{-- job ID from proposal --}}
                                        <button type="submit" class="btn btn-sm btn-primary">Message</button>
                                    </form>
                               
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            @endforeach
            @else
                <p class="text-muted">No proposals found for this job.</p>
            @endif

    </div>
</div>

@push('scripts')
<script>
    function toggleCover(index) {
        const shortText = document.getElementById('short-' + index);
        const fullText = document.getElementById('full-' + index);
        const toggleBtn = document.getElementById('toggle-btn-' + index);

        if (shortText.style.display === 'none') {
            shortText.style.display = '';
            fullText.style.display = 'none';
            toggleBtn.innerText = 'Read More';
        } else {
            shortText.style.display = 'none';
            fullText.style.display = '';
            toggleBtn.innerText = 'Show Less';
        }
    }
</script>
@endpush
