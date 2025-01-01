        <h2 class="main-title">My Resume</h2>

        <div class="bg-white card-box border-20">
            <h4 class="dash-title-three">Resume Attachment</h4>
            <div class="dash-input-wrapper mb-20">
                <label for="">CV Attachment*</label>
                
                <div class="attached-file d-flex align-items-center justify-content-between mb-15">
                    <span>MyCvResume.PDF</span>
                    <a href="#" class="remove-btn"><i class="bi bi-x"></i></a>
                </div>
                <div class="attached-file d-flex align-items-center justify-content-between">
                    <span>CandidateCV02.PDF</span>
                    <a href="#" class="remove-btn"><i class="bi bi-x"></i></a>
                </div>
            </div>
            <!-- /.dash-input-wrapper -->
            <div class="dash-btn-one d-inline-block position-relative me-3">
                <i class="bi bi-plus"></i>
                Upload CV
                <input type="file" id="uploadCV" name="uploadCV" placeholder="">
            </div>
            <small>Upload file .pdf, .doc, .docx</small>
        </div>
        <!-- /.card-box -->

        <div class="bg-white card-box border-20 mt-40">
            <h4 class="dash-title-three">Intro & Overview</h4>
            <div class="dash-input-wrapper mb-35 md-mb-20">
                <label for="">Overview*</label>
                <textarea class="size-lg" placeholder="Write something interesting about you...."></textarea>
                <div class="alert-text">Brief description for your resume. URLs are hyperlinked.</div>
            </div>
            <!-- /.dash-input-wrapper -->
            <div class="row">
                <div class="col-sm-6 d-flex">
                    <div class="intro-video-post position-relative mt-20" style="background-image: url({{asset('site/dashboard/video_post.jpg')}});">
                        <a class="fancybox rounded-circle video-icon tran3s text-center" data-fancybox="" href="https://www.youtube.com/embed/aXFSJTjVjw0">
                            <i class="bi bi-play"></i>
                        </a>
                        <a href="#" class="close"><i class="bi bi-x"></i></a>
                    </div>
                    <!-- /.intro-video-post -->
                </div>
                <div class="col-sm-6 d-flex">
                    <div class="intro-video-post position-relative empty mt-20">
                        <span>+ Add Intro Video</span>
                        <input type="file" id="uploadVdo" name="uploadVdo" placeholder="">
                    </div>
                    <!-- /.intro-video-post -->
                </div>
            </div>
        </div>
        <!-- /.card-box -->

        <div class="bg-white card-box border-20 mt-40">
            <h4 class="dash-title-three">Education</h4>

            <div class="accordion dash-accordion-one" id="accordionOne">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Add Education*
                            </button>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionOne">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Title*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Product Designer (Google)">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Academy*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Google Arts Collage & University">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Year*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Description*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <textarea class="size-lg" placeholder="Morbi ornare ipsum sed sem condimentum, et pulvinar tortor luctus. Suspendisse condimentum lorem ut elementum aliquam et pulvinar tortor luctus."></textarea>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Add Education*
                            </button>
                    </div>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionOne">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Title*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Product Designer (Google)">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Academy*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Google Arts Collage & University">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Year*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Description*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <textarea class="size-lg" placeholder="Morbi ornare ipsum sed sem condimentum, et pulvinar tortor luctus. Suspendisse condimentum lorem ut elementum aliquam et pulvinar tortor luctus."></textarea>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.dash-accordion-one -->
            <a href="#" class="dash-btn-one"><i class="bi bi-plus"></i> Add more</a>
        </div>
        <!-- /.card-box -->

        <div class="bg-white card-box border-20 mt-40">
            <h4 class="dash-title-three">Skills & Experience</h4>
            <div class="dash-input-wrapper mb-40">
                <label for="">Add Skills*</label>

                <div class="skills-wrapper">
                    <ul class="style-none d-flex flex-wrap align-items-center">
                        <li class="is_tag"><button>Figma <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>HTML5 <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>Illustrator <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>Adobe Photoshop <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>WordPress <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>jQuery <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>Web Design <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>Adobe XD <i class="bi bi-x"></i></button></li>
                        <li class="is_tag"><button>CSS <i class="bi bi-x"></i></button></li>
                        <li class=more_tag><button>+</button></li>
                    </ul>
                </div>
                <!-- /.skills-wrapper -->
            </div>
            <!-- /.dash-input-wrapper -->

            <div class="dash-input-wrapper mb-15">
                <label for="">Add Work Experience*</label>
            </div>
            <!-- /.dash-input-wrapper -->
            <div class="accordion dash-accordion-one" id="accordionTwo">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOneA">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneA" aria-expanded="false" aria-controls="collapseOneA">
                            Experience 1*
                            </button>
                    </div>
                    <div id="collapseOneA" class="accordion-collapse collapse" aria-labelledby="headingOneA" data-bs-parent="#accordionTwo">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Title*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Lead Product Designer ">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Company*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Amazon Inc">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Year*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Description*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <textarea class="size-lg" placeholder="Morbi ornare ipsum sed sem condimentum, et pulvinar tortor luctus. Suspendisse condimentum lorem ut elementum aliquam et pulvinar tortor luctus."></textarea>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingTwoA">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoA" aria-expanded="false" aria-controls="collapseTwoA">
                            Experience 2*
                            </button>
                    </div>
                    <div id="collapseTwoA" class="accordion-collapse collapse show" aria-labelledby="headingTwoA" data-bs-parent="#accordionTwo">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Title*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Lead Product Designer ">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Company*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <input type="text" placeholder="Amazon Inc">
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Year*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dash-input-wrapper mb-30">
                                                <select class="nice-select">
                                                    <option>2023</option>
                                                    <option>2022</option>
                                                    <option>2021</option>
                                                    <option>2020</option>
                                                    <option>2019</option>
                                                    <option>2018</option>
                                                </select>
                                            </div>
                                            <!-- /.dash-input-wrapper -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="dash-input-wrapper mb-30 md-mb-10">
                                        <label for="">Description*</label>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="dash-input-wrapper mb-30">
                                        <textarea class="size-lg" placeholder="Morbi ornare ipsum sed sem condimentum, et pulvinar tortor luctus. Suspendisse condimentum lorem ut elementum aliquam et pulvinar tortor luctus."></textarea>
                                    </div>
                                    <!-- /.dash-input-wrapper -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.dash-accordion-one -->
            <a href="#" class="dash-btn-one"><i class="bi bi-plus"></i> Add more</a>
        </div>
        <!-- /.card-box -->

        <div class="bg-white card-box border-20 mt-40">
            <h4 class="dash-title-three">Portfolio</h4>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="candidate-portfolio-block position-relative mb-25">
                        <a href="#" class="d-block">
                            <img src="{{asset('site/dashboard/portfolio_img_01.jpg')}}" alt="" class="lazy-img w-100">
                        </a>
                        <a href="#" class="remove-portfolio-item rounded-circle d-flex align-items-center justify-content-center tran3s"><i class="bi bi-x"></i></a>
                    </div>
                    <!-- /.candidate-portfolio-block -->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="candidate-portfolio-block position-relative mb-25">
                        <a href="#" class="d-block">
                            <img src="{{asset('site/dashboard/portfolio_img_02.jpg')}}" alt="" class="lazy-img w-100">
                        </a>
                        <a href="#" class="remove-portfolio-item rounded-circle d-flex align-items-center justify-content-center tran3s"><i class="bi bi-x"></i></a>
                    </div>
                    <!-- /.candidate-portfolio-block -->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="candidate-portfolio-block position-relative mb-25">
                        <a href="#" class="d-block">
                            <img src="{{asset('site/dashboard/portfolio_img_03.jpg')}}" alt="" class="lazy-img w-100">
                        </a>
                        <a href="#" class="remove-portfolio-item rounded-circle d-flex align-items-center justify-content-center tran3s"><i class="bi bi-x"></i></a>
                    </div>
                    <!-- /.candidate-portfolio-block -->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="candidate-portfolio-block position-relative mb-25">
                        <a href="#" class="d-block">
                            <img src="{{asset('site/dashboard/portfolio_img_04.jpg')}}" alt="" class="lazy-img w-100">
                        </a>
                        <a href="#" class="remove-portfolio-item rounded-circle d-flex align-items-center justify-content-center tran3s"><i class="bi bi-x"></i></a>
                    </div>
                    <!-- /.candidate-portfolio-block -->
                </div>
            </div>
            <a href="#" class="dash-btn-one"><i class="bi bi-plus"></i> Add more</a>
        </div>
        <!-- /.card-box -->

        <div class="button-group d-inline-flex align-items-center mt-30">
            <a href="#" class="dash-btn-two tran3s me-3">Save</a>
            <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
        </div>				
    </div>
</div>