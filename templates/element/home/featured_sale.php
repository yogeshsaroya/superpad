<style>
    .bottomBar .position-relative{
        position: relative;
    }
    .bottomBar .position-absolute{
        position: absolute;
        bottom: 0;
        left: 0;
        color: #fff;
        padding: 0;
    }
    .bottomBar .position-absolute .ms-auto{
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#000000+0,000000+100&0.17+0,0.52+100 */
        background: -moz-linear-gradient(top,  rgba(0,0,0,0.17) 0%, rgba(0,0,0,0.52) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(0,0,0,0.17) 0%,rgba(0,0,0,0.52) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(0,0,0,0.17) 0%,rgba(0,0,0,0.52) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2b000000', endColorstr='#85000000',GradientType=0 ); /* IE6-9 */
        color: #fff;
        padding: 8px 15px;
    }
    .bottomBar .btn{
        position: absolute;
        left: 0;
        bottom: 0;
        background: #000;
        border-radius: 0;
        color: #fff;
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
            <a href="#" class="btn">Join Now</a>
            <span class="ms-auto">2022-04-01</span>
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