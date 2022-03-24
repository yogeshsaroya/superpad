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
                    <div class="col-lg-6 col-md-6">

                        <h1 class="hero-title mb-4"><?php echo $list->title; ?></h1>
                        <p class="text-dark-gray"><span class="me-3 me-xl-4"><strong class="text-black">Fund Raise</strong><?php echo $this->Number->currency($list->total_raise, 'USD'); ?></span>
                        <span><strong class="text-black">Ticket Allocation</strong> <?php echo $this->Number->currency($list->ticket_allocation, 'USD'); ?></span></p>
                        <br>
                        <?php if(!empty($list->end_date)){?>
                        <h5 class="mb-3 text-uppercase hero-text">auction ending in</h5>
                        <div class="countdown-timer d-flex align-items-center" id="counter" data-exp-time="<?php echo $list->start_date->format('Y-m-d H:i:s') ?>"></div>
                        <?php }?>
                        <ul class="hero-btns btns-group">
                            <li> <?php if (isset($list->blockchain->name)) { ?><img src="<?php echo SITEURL . 'cdn/blockchains/' . $list->blockchain->logo; ?>" title="<?php echo $list->blockchain->name; ?>" width="64px" alt="" /><?php } ?></li>
                            <li><a href="<?php echo SITEURL . "explore/" . $list->slug; ?>" class="btn btn-lg btn-dark">Join Now</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-sm-9 col-md-6">
                        <div class="hero-image hero-image-mobile">
                            <img src="<?php echo SITEURL . "cdn/project_img/" . $list->hero_image; ?>" alt="<?php echo $list->title;?>" class="w-100">
                        </div>
                    </div><!-- end col-lg-6 -->
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php }?>