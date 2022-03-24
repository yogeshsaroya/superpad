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
                <div class="row align-items-center flex-md-row-reverse">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="hero-image hero-image-mobile">
                        <a href="<?php echo SITEURL . "explore/" . $list->slug; ?>" title="">
                            <img src="<?php echo SITEURL . "cdn/project_banner/" . $list->banner; ?>" alt="<?php echo $list->title;?>" class="w-100"/>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php }?>