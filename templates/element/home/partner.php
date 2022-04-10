<?php
$data = $this->Data->getPartners();
if ( !$data->isEmpty() ) {
?>
<style>
    .partdiv {
        width: 200px;
    }
    
</style>
<section id="partners_list" class="brand-section section-space <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="mb-3">Partner And Investor</h2>
        </div><!-- end section-head -->
        <div class="row g-gs">
            <?php
            if (!empty($data)) {
                foreach ($data as $list) { ?>
                    <div class="partdiv1 col-6 col-md-3 col-sm-4">
                        <div class="client-logo-item1 text-center partners_logo">
                            <?php if(!empty($list->url)){?>
                            <a href="<?php echo $list->url; ?>" title="<?php echo $list->title;?>" target="_blank">
                            <img src="<?php echo SITEURL . "cdn/partners/" . $list->logo; ?>" alt="" class="img-fluid"></a>
                            <?php }else{?>
                                <img src="<?php echo SITEURL . "cdn/partners/" . $list->logo; ?>" alt="" class="img-fluid">
                            <?php }?>
                                
                        </div>
                    </div>

            <?php }
            }
            ?>

        </div><!-- end d-flex -->
    </div><!-- end container -->
</section>
<?php }?>