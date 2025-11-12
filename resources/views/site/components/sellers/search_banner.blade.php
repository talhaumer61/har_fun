<div class="inner-banner-one position-relative">
    <div class="container">
        <div class="position-relative">
            <div class="row">
                <div class="col-xl-6 m-auto text-center">
                    <div class="title-two">
                        <h2 class="text-white">{{__('Candidates')}}</h2>
                    </div>
                    <p class="text-lg text-white mt-30 lg-mt-20 mb-35 lg-mb-20">
                        {{__('Find your desired talents & make your work done')}}
                    </p>
                </div>
            </div>
            <div class="position-relative">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 m-auto">
                        <div class="job-search-one position-relative">
                            <form id="searchForm">
                                <div class="row">
                                    <div class="col-md-9 pe-0">
                                        <div class="input-box m-0 p-0">
                                            <input type="text" id="searchInput" class="border-0 form-control py-4" placeholder="Type to search..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <button type="submit" class="ms-0 fw-500 text-uppercase h-100 tran3s search-btn">{{__('Search')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Results container -->
                        <div id="searchResults" class="mt-4">
                            {{-- Sellers list will load here --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


