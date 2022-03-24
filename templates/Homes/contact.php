<?php $this->assign('title', 'Contact US'); ?>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">How can we help?</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL;?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div><!-- hero-content -->
    </div><!-- .container-->
</div><!-- end hero-wrap -->


<section class="contact-section section-space-b">
    <div class="container">
        <div class="row section-space-b">
            <div class="col-lg-7">
                <div class="contact-form-wrap mb-5 mb-lg-0">
                    <div class="section-head-sm">
                        <h2 class="mb-2">Contact Us</h2>
                        <p>Have a question? Need help? Don't hesitate, drop us a line</p>
                    </div>
                    <form action="#">
                        <div class="row g-gs">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputName" placeholder="Name">
                                    <label for="floatingInputName">Your name</label>
                                </div><!-- end form-floating -->
                            </div><!-- end col -->
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com">
                                    <label for="floatingInputEmail">Email address</label>
                                </div><!-- end form-floating -->
                            </div><!-- end col -->
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputPhoneNumber" placeholder="Username">
                                    <label for="floatingInputPhoneNumber">Phone number</label>
                                </div><!-- end form-floating -->
                            </div><!-- end col -->
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Type message here...</label>
                                </div><!-- end form-floating -->
                            </div><!-- end col -->
                            <div class="col-lg-12">
                                <button class="btn btn-dark" type="submit">Send Message</button>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form>
                </div><!-- end card -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="contact-info ps-lg-4 ps-xl-5">
                    <div class="section-head-sm">
                        <h2 class="mb-2">Find Us There</h2>
                        <p>Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.</p>
                    </div>
                    <ul class="contact-details">
                        <li class="d-flex align-items-center mb-3">
                            <em class="ni ni-mail icon-btn icon-btn-s1"></em>
                            <div class="ms-4">
                                <strong class="d-block text-black">Email:</strong>
                                <a href="mailto:support@superpad.finance?subject=Hello">support@superpad.finance</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end contact-section -->