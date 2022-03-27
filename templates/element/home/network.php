<?php
    $data = $this->Data->getBlockchains();
    
if ( !$data->isEmpty() ) {
    ?>
<style>
    .pdiv {
        width: 300px;
    }

    .auto-slide-wrap {
        overflow-x: hidden
    }

    ul.share-box {
        display: inline-flex;
    }

    .share-box>li {
        padding: 30px;
    }

    #networks_list .network_log img {
        height: 100px;
    }
</style>
<section id="networks_list" class="brand-section section-space <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
    
    <div class="container">
        <div class="section-head text-center">
            <h2 class="mb-3">Raise fund across all main blockchain networks</h2>
        </div><!-- end section-head -->
        <div class="slide_1 auto-slide-wrap">
            <div class="row g-gs marquee-with-options">
                <ul class="share-box">
                    <?php
                        foreach ($data as $list) { ?>
                            <li>
                                <div class="pdiv col-6col-md-3col-sm-4">
                                    <div class="text-center network_log">
                                        <img src="<?php echo SITEURL . "cdn/blockchains_img/" . $list->img; ?>" alt="<?php echo $list->name; ?>" title="<?php echo $list->name; ?>" class="img-fluid">
                                    </div>
                                </div>
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
speed: 200,
gap: 0,
delayBeforeStart: 0,
direction: 'left',
duplicated: false,
pauseOnHover: true
});

});
<?php $this->Html->scriptEnd(); }?>