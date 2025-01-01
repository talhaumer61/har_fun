<div class="modal popUpModal fade" id="filterPopUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="container">
            <div class="filter-area-tab modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="position-relative">
                    <div class="main-title fw-500 text-dark ps-4 pe-4 pt-15 pb-15 border-bottom">Filter By</div>
                    <div class="pt-25 pb-30 ps-4 pe-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="filter-block pb-50 md-pb-20">
                                    <div class="filter-title fw-500 text-dark">Keyword or Title</div>
                                    <form action="#" class="input-box position-relative">
                                        <input type="text" placeholder="Search by Keywords">
                                        <button><i class="bi bi-search"></i></button>
                                    </form>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                            <div class="col-lg-3">
                                <div class="filter-block pb-50 md-pb-20">
                                    <div class="filter-title fw-500 text-dark">Category</div>
                                    <select class="nice-select">
                                        <option value="0">Web Design</option>
                                        <option value="1">Design & Creative </option>
                                        <option value="2">It & Development</option>
                                        <option value="3">Web & Mobile Dev</option>
                                        <option value="4">Writing</option>
                                        <option value="5">Sales & Marketing</option>
                                    </select>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                            <div class="col-lg-3">
                                <div class="filter-block pb-50 md-pb-20">
                                    <div class="filter-title fw-500 text-dark">Location</div>
                                    <select class="nice-select">
                                        <option value="0">Washington DC</option>
                                        <option value="1">California, CA</option>
                                        <option value="2">New York</option>
                                        <option value="3">Miami</option>
                                    </select>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                            <div class="col-lg-3">
                                <div class="filter-block pb-50 md-pb-20 pt-30">
                                    <div class="loccation-range-select">
                                        <div class="d-flex align-items-center">
                                            <span>Radius: &nbsp;</span>
                                            <div id="rangeValue">50</div>
                                            <span>&nbsp;miles</span>
                                        </div>
                                        <input type="range" id="locationRange" value="50" max="100">
                                    </div>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="filter-block pb-25">
                                    <div class="filter-title fw-500 text-dark">Expert Level</div>
                                    <div class="main-body">
                                        <select class="nice-select">
                                            <option value="0">Intermediate</option>
                                            <option value="1">No-Experience</option>
                                            <option value="2">Internship</option>
                                            <option value="3">Expert</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                            <div class="col-lg-3">
                                <div class="filter-block pb-25">
                                    <div class="filter-title fw-500 text-dark">Qualification</div>
                                    <div class="main-body">
                                        <select class="nice-select">
                                            <option value="0">Master’s Degree</option>
                                            <option value="1">Bachelor Degree</option>
                                            <option value="2">None</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                            <div class="col-lg-3">
                                <div class="filter-block pb-25">
                                    <div class="filter-title fw-500 text-dark">Candidate Type</div>
                                    <div class="main-body">
                                        <select class="nice-select">
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                            <div class="col-lg-3">
                                <div class="filter-block pb-25">
                                    <div class="filter-title fw-500 text-dark">Salary Range</div>
                                    <div class="main-body">
                                        <div class="salary-slider">
                                            <div class="price-input d-flex align-items-center pt-5">
                                                <div class="field d-flex align-items-center">
                                                    <input type="number" class="input-min" value="0" readonly>
                                                </div>
                                                <div class="pe-1 ps-1">-</div>
                                                <div class="field d-flex align-items-center">
                                                    <input type="number" class="input-max" value="300" readonly>
                                                </div>
                                                <div class="currency ps-1">USD</div>
                                            </div>
                                            <div class="slider">
                                                <div class="progress"></div>
                                            </div>
                                            <div class="range-input mb-10">
                                                <input type="range" class="range-min" min="0" max="950" value="0" step="10">
                                                <input type="range" class="range-max" min="0" max="1000" value="300" step="10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.filter-block -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 m-auto">
                                <a href="#" class="btn-ten fw-500 text-white w-100 text-center tran3s">Apply Filter</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.filter header -->
                </div>
            </div>
            <!-- /.filter-area-tab -->
        </div>
    </div>
</div>