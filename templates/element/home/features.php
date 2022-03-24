<?php
$data = $this->Data->getFeatures();
if (!empty($data)) {
?>
    <section class="section-space how-it-work-section <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="mb-3">Superpad features</h2>
                <p>This is just a simple text made for this unique and awesome template, you can replace it with any text. It is a long established fact.</p>
            </div>
            <div class="row g-gs justify-content-center">
                <?php foreach ($data as $list) { ?>
                    <div class="col-10 col-sm-6 col-md-6 col-lg-3">
                        <div class="card-htw text-center">
                            <img src="<?php echo SITEURL.'cdn/features/'.$list->icon?>" alt="" title="" class="features_icon" width="32px"/>
                            <h4 class="mb-3"><?php echo $list->heading;?></h4>
                            <p class="card-text-s1"><?php echo $list->sub_heading;?></p>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>