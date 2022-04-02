<style>
    .bottomBar .position-relative {
        position: relative;
    }

    .hero-image-mobile1 {
        position: relative;
    }

    .bottomBar .position-absolute {
        position: absolute;
        width: 100%;
        bottom: 0;
        left: 0;
        padding: 0 0 20px 0;
        /* color: #fff; background: rgba(255, 255, 255, 0.7); */
    }

    .bottomBar .position-absolute .ms-auto {
        color: #000;
        padding: 0 15px;

        right: 0;
        bottom: 0;
    }

    .bottomBar .btn {
        left: 0;
        bottom: 0;
        background: transparent;
        border-radius: 0;
        color: #000;
    }

    @media (max-width: 767px) {
        #fea_sales .container {
            padding: 0;
            margin: 0;
        }

        div#fea_sales {
            margin-top: 20px;
        }

        #div_btn {
            padding-right: 0px;
        }

        .bottomBar .position-absolute {
            position: relative !important;
        }

        .bottomBar .position-absolute .ms-auto {
            margin-left: 0 !important;
            font-weight: bold;
            color: #fff;
        }

        .bottomBar .btn {
            margin-left: auto !important;
            color: #fff;
        }
    }

    #fea_sales .badge {
        padding: 10px 20px 10px 20px;
        font-size: 14px;
        font-weight: 900;
    }

    #banner_img {
        border-radius: 15px;
    }

    #div_time {
        text-align: right;
    }
</style>
<?php
$list = $this->Data->getFeaturedSale();
if (!empty($list)) { ?>
    <section class="section-space trending-section <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="mb-3">Featured Sale</h2>

            </div><!-- end section-head -->
            <div class="hero-wrap">
                <div class="container">
                    <div class="row align-items-center flex-md-row-reverse bottomBar">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="hero-image hero-image-mobile1">
                                <a href="<?php echo SITEURL . "explore/" . $list->slug; ?>" title="">
                                    <img src="<?php echo SITEURL . "cdn/project_banner/" . $list->banner; ?>" alt="<?php echo $list->title; ?>" class="w-100" id="banner_img" />
                                </a>
                                <div class="position-absolute d-flex align-items-center" id="fea_sales">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col" id="div_btn"> <a href="<?php echo SITEURL . "explore/" . $list->slug; ?>" class="badge rounded-pill bg-info text-dark">Join Now</a> </div>

                                            <div class="col col-lg-2" id="div_time">
                                                <span class="badge rounded-pill bg-info text-dark">
                                                    <?php if (!empty($list->start_date) && !empty(check_date($list->start_date->format('Y-m-d')))) {
                                                        echo $list->start_date->format('Y-m-d');
                                                    } ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php } ?>