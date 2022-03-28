<style>
    .bottomBar .position-relative{
        position: relative;
    }
    .hero-image-mobile1{
        position: relative;
    }
    .bottomBar .position-absolute{
        position: absolute;
        bottom: 0;
        left: 0;
        color: #fff;
        padding: 0;
        background: rgba(255, 255, 255, 0.7);
    }
    .bottomBar .position-absolute .ms-auto{
        color: #000;
        padding: 0 15px;
        
        right: 0;
        bottom: 0;
    }
    .bottomBar .btn{
        left: 0;
        bottom: 0;
        background: transparent;
        border-radius: 0;
        color: #000;
    }
    @media (max-width: 767px){
        .bottomBar .position-absolute {
            position: relative !important;
            background: rgba(0, 0, 0, 0.6);

        }
        .bottomBar .position-absolute .ms-auto{
            margin-left: 0 !important;
            font-weight: bold;
            color: #fff;
        }
        .bottomBar .btn{
            margin-left: auto !important;
            color: #fff;
        }
    }

</style>
<?php 
$list = $this->Data->getFeaturedSale();
if(!empty($list)){?>
<section class="section-space trending-section <?php echo (isset($bg_color) ?  $bg_color : null);?>">
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
                            <img src="<?php echo SITEURL . "cdn/project_banner/" . $list->banner; ?>" alt="<?php echo $list->title;?>" class="w-100"/>
                        </a>
                         <div class="position-absolute d-flex align-items-center">
                            <span class="ms-auto"><?php if (!empty($list->start_date) && !empty( check_date($list->start_date->format('Y-m-d'))) ) { echo $list->start_date->format('Y-m-d'); } ?></span>
            <a href="<?php echo SITEURL . "explore/" . $list->slug; ?>" class="btn">Join Now</a>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php }?>