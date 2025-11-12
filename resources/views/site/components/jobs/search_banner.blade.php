<div class="inner-banner-one position-relative">
    <div class="container">
        <div class="position-relative">
            <div class="row">
                <div class="col-xl-6 m-auto text-center">
                    <div class="title-two">
                        <h2 class="text-white">{{__('Job Listing')}} </h2>
                    </div>
                    <p class="text-lg text-white mt-30 lg-mt-20 mb-35 lg-mb-20">{{__('Fast & striking work Opportunities')}}</p>
                </div>
            </div>
            <div class="position-relative">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 m-auto">
                        <div class="job-search-one position-relative">
                            <form id="jobForm" action="/jobs" method="GET">
                                <div class="row">
                                    {{-- <div class="col-md-5">
                                        <div class="input-box">
                                            <div class="label">What are you looking for?</div>
                                            <select class="nice-select lg">
                                                <option value="1">UI Designer</option>
                                                <option value="2">Content creator</option>
                                                <option value="3">Web Developer</option>
                                                <option value="4">SEO Guru</option>
                                                <option value="5">Digital marketer</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="input-box col-md-9">
                                        <div class="label">{{__('Category')}}</div>
                                        <select id="categorySelect" class="nice-select lg">
                                            <option value="">{{__('Select...')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->cat_href }}">{{ __( $category->cat_name ) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="submit" class="fw-500 text-uppercase h-100 tran3s search-btn">{{__('Search')}}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.job-search-one -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('site/images/shape/shape_02.svg')}}" alt="" class="lazy-img shapes shape_01">
    <img src="{{asset('site/images/shape/shape_03.svg')}}" alt="" class="lazy-img shapes shape_02">
</div>

<script>
    document.getElementById('jobForm').addEventListener('submit', function(e) {
        e.preventDefault(); // stop normal submit
        const selected = document.getElementById('categorySelect').value;
        if (selected) {
            window.location.href = '/jobs/' + selected;
        } else {
            alert('Please select a category.');
        }
    });
</script>