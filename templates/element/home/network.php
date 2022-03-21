<style>
    .pdiv{width: 200px;}
    .auto-slide-wrap {
        overflow-x: hidden
    }

    ul.share-box{display:inline-flex;}
.share-box > li{padding:30px;}
</style>
<section class="brand-section section-space <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="mb-3">All main BlockChain Network on SuperPAD</h2>
        </div><!-- end section-head -->
        <div class="slide_1 auto-slide-wrap">
            <div class="row g-gs marquee-with-options">
                <ul class="share-box">

                    <?php for ($i = 0; $i < 20; $i++) { ?>
                        <li>
                            <div class="pdiv col-6col-md-3col-sm-4">
                                <div class="client-logo-item text-center">
                                    <img src="images/brand/brand.png" alt="" class="img-fluid">
                                </div>
                            </div><!-- end col -->
                        </li>
                    <?php } ?>
                </ul>


            </div><!-- end d-flex -->
        </div>
    </div><!-- end container -->
</section>


<?php echo $this->Html->script(['jquery.marquee.min.js'], ['block' => 'scriptBottom']); ?>


<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){


$('.marquee-with-options').marquee({
speed: 100,
gap: 0,
delayBeforeStart: 0,
direction: 'left',
duplicated: false,
pauseOnHover: true
});

});
<?php $this->Html->scriptEnd(); ?>