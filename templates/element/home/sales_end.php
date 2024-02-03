<?php
$data = $this->Data->getClosedSales(6);
if ( !$data->isEmpty() ) {?>
    <section class="section-space trending-section <?php echo (isset($bg_color) ?  $bg_color : null); ?>" id="project_list">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="mb-3">Closed Sale</h2>
                
            </div>
            <div class="row g-gs">
                <?php echo $this->element('home/product_box', ['data' => $data]);?>
            </div>
            <div class="text-center mt-4 mt-md-5">
                <a href="<?php echo SITEURL; ?>closed-sales" class="btn-link btn-link-s1">View all closed sales</a>
            </div>
        </div>
    </section>
<?php } ?>