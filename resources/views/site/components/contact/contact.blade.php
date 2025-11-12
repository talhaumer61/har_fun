<section class="contact-us-section pt-100 lg-pt-80">
    <div class="container">
        <div class="border-bottom pb-150 lg-pb-80">
            <div class="title-one text-center mb-70 lg-mb-40">
                <h2>{{__('Get in touch')}}</h2>
            </div>
            <div class="row">
                <div class="col-xl-10 m-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="address-block-one text-center mb-40 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('site/images/icon/icon_57.svg')}}" alt=""></div>
                                <h5 class="title">{{__('Our Address')}}</h5>
                                <p>324-4-A2 Township, Lahore <br>Punjab, Pakistan</p>
                            </div> <!-- /.address-block-one -->
                        </div>
                        <div class="col-md-4">
                            <div class="address-block-one text-center mb-40 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('site/images/icon/icon_58.svg')}}" alt=""></div>
                                <h5 class="title">{{__('Contact Info')}}</h5>
                                <p>{{__('Open a chat or give us call at')}} <br><a href="tel:310.841.5500" class="call">310.841.5500</a></p>
                            </div> <!-- /.address-block-one -->
                        </div>
                        <div class="col-md-4">
                            <div class="address-block-one text-center mb-40 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="icon rounded-circle d-flex align-items-center justify-content-center m-auto"><img src="{{asset('site/images/icon/icon_59.svg')}}" alt=""></div>
                                <h5 class="title">{{__('Live Support')}}</h5>
                                <p><a href="#" class="webaddress">www.har-fun.com/support</a></p>
                            </div> <!-- /.address-block-one -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-9 m-auto">
                    <div class="form-style-one mt-85 lg-mt-50 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <form action="https://html.creativegigstf.com/jobi/jobi/inc/contact.php" id="contact-form" data-toggle="validator" novalidate="true">
                            <div class="messages"></div>
                            <div class="row controls">
                                <div class="col-sm-6">
                                    <div class="input-group-meta form-group mb-30">
                                        <label for="">Name*</label>
                                        <input type="text" placeholder="{{__('Your Name')}}*" name="name" required="required" data-error="Name is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group-meta form-group mb-30">
                                        <label for="">Email*</label>
                                        <input type="email" placeholder="{{__('Email Address')}}*" name="email" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta form-group mb-35">
                                        <label for="">Subject (optional)</label>
                                        <input type="text" placeholder="{{__('Write about the subject here')}}.." name="subject">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta form-group mb-35">
                                        <textarea placeholder="{{__('Your message')}}*" name="message" required="required" data-error="Please,leave us a message."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-12"><button class="btn-eleven fw-500 tran3s d-block">{{__('Send Message')}}</button></div>
                            </div>
                        </form>
                    </div> <!-- /.form-style-one -->
                </div>
            </div>
        </div>
    </div>
</section>