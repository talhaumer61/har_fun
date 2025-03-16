        <h2 class="main-title">Post a New Job</h2>
        <form action="{{ route('job.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white card-box border-20">
                <h4 class="dash-title-three">Job Details</h4>
                <div class="dash-input-wrapper mb-30">
                    <label for="">Job Title*</label>
                    <input type="text" name="job_title" placeholder="Ex: Product Designer">
                </div>
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="dash-input-wrapper mb-30">
                            <label for="">Job Category</label>
                            <select class="nice-select" name="id_cat">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                @endforeach                 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dash-input-wrapper mb-30">
                            <label for="">Budget*</label>
                            <input type="text" name="job_budget" placeholder="Rs. ">
                        </div>
                    </div>
                </div>
                <div class="dash-input-wrapper mb-30">
                    <label for="">Job Description*</label>
                    <textarea class="size-lg" name="job_desc" placeholder="Write about the job in details..."></textarea>
                </div>
                

                {{-- <h4 class="dash-title-three pt-50 lg-pt-30">Skills & Experience</h4>
                <div class="dash-input-wrapper mb-30">
                    <label for="">Skills*</label>
                    <input type="text" placeholder="Add Skills">
                    <div class="skill-input-data d-flex align-items-center flex-wrap">
                        <button>Design</button>
                        <button>UI</button>
                        <button>Digital</button>
                        <button>Graphics</button>
                        <button>Developer</button>
                        <button>Product</button>
                        <button>Microsoft</button>
                        <button>Brand</button>
                        <button>Photoshop</button>
                        <button>Business</button>
                        <button>IT & Technology</button>
                        <button>Marketing</button>
                        <button>Article</button>
                        <button>Engineer</button>
                        <button>HTML5</button>
                        <button>Figma</button>
                        <button>Automobile</button>
                        <button>Account</button>
                    </div>
                </div> --}}
                {{-- <!-- /.dash-input-wrapper -->
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="dash-input-wrapper mb-30">
                            <label for="">Experience*</label>
                            <select class="nice-select">
                                <option>Intermediate </option>
                                <option>No-Experience </option>
                                <option>Expert</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                    <div class="col-md-6">
                        <div class="dash-input-wrapper mb-30">
                            <label for="">Location*</label>
                            <select class="nice-select">
                                <option value="0">Washington DC</option>
                                <option value="1">California, CA</option>
                                <option value="2">New York</option>
                                <option value="3">Miami</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                    <div class="col-md-6">
                        <div class="dash-input-wrapper mb-30">
                            <label for="">Industry*</label>
                            <select class="nice-select">
                                <option>Select Industry</option>
                                <option>Select Industry 2</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                    <div class="col-md-6">
                        <div class="dash-input-wrapper mb-30">
                            <label for="">English Fluency</label>
                            <select class="nice-select">
                                <option value="0">Basic</option>
                                <option value="1">Conversational</option>
                                <option value="2" selected="">Fluent</option>
                                <option value="3">Native/Bilingual</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                </div> --}}

                <h4 class="dash-title-three pt-50 lg-pt-30">File Attachment</h4>
                <div class="dash-input-wrapper mb-20">
                    <label for="">File Attachment*</label>
                    <div id="fileList"></div> <!-- Dynamic file display area -->
                </div>
                
                <!-- Upload File Button -->
                <div class="dash-btn-one d-inline-block position-relative me-3">
                    <i class="bi bi-plus"></i>
                    Upload File
                    <input type="file" id="uploadFile" name="job_photo" hidden>
                </div>

                <small>Upload file .pdf, .doc, .docx</small>
                <h4 class="dash-title-three pt-50 lg-pt-30">Address & Location</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="dash-input-wrapper mb-25">
                            <label for="">City*</label>
                            <select class="nice-select" name="id_city">
                                <option value="">Select a City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach                 
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dash-input-wrapper mb-25">
                            <label for="">Address*</label>
                            <input type="text" name="job_location" placeholder="Cowrasta, Chandana, Gazipur Sadar">
                        </div>
                    </div>
                    {{-- <div class="col-lg-4">
                        <div class="dash-input-wrapper mb-25">
                            <label for="">Country*</label>
                            <select class="nice-select">
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                                <option>Andorra</option>
                                <option>Angola</option>
                                <option>Antigua and Barbuda</option>
                                <option>Argentina</option>
                                <option>Armenia</option>
                                <option>Australia</option>
                                <option>Austria</option>
                                <option>Azerbaijan</option>
                                <option>Bahamas</option>
                                <option>Bahrain</option>
                                <option>Bangladesh</option>
                                <option>Barbados</option>
                                <option>Belarus</option>
                                <option>Belgium</option>
                                <option>Belize</option>
                                <option>Benin</option>
                                <option>Bhutan</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                    <div class="col-lg-4">
                        <div class="dash-input-wrapper mb-25">
                            <label for="">City*</label>
                            <select class="nice-select">
                                <option>Dhaka</option>
                                <option>Tokyo</option>
                                <option>Delhi</option>
                                <option>Shanghai</option>
                                <option>Mumbai</option>
                                <option>Bangalore</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                    <div class="col-lg-4">
                        <div class="dash-input-wrapper mb-25">
                            <label for="">State*</label>
                            <select class="nice-select">
                                <option>Dhaka</option>
                                <option>Tokyo</option>
                                <option>Delhi</option>
                                <option>Shanghai</option>
                                <option>Mumbai</option>
                                <option>Bangalore</option>
                            </select>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div>
                    <div class="col-12">
                        <div class="dash-input-wrapper mb-25">
                            <label for="">Map Location*</label>
                            <div class="position-relative">
                                <input type="text" placeholder="XC23+6XC, Moiran, N105">
                                <button class="location-pin tran3s"><img src="{{asset('site/dashboard/icon/icon_16.svg')}}" alt="" class="lazy-img m-auto"></button>
                            </div>
                            <div class="map-frame mt-30">
                                <div class="gmap_canvas h-100 w-100">
                                    <iframe class="gmap_iframe h-100 w-100" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=dhaka%20collage&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- /.dash-input-wrapper -->
                    </div> --}}
                </div>
            </div>
            <!-- /.card-box -->

            <div class="button-group d-inline-flex align-items-center mt-30">
                <button type="submit" href="#" class="dash-btn-two tran3s me-3">Submit Job</button>
                <a href="/dashboard" class="dash-cancel-btn tran3s">Cancel</a>
            </div>
        </form>				
    </div>
</div>