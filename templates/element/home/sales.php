<?php
$data = $this->Data->getProjects(6);
if (!empty($data)) {?>
    <section class="section-space trending-section <?php echo (isset($bg_color) ?  $bg_color : null); ?>" id="project_list">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="mb-3">Upcoming Sale</h2>
                
            </div>
            <div class="row g-gs">
                <?php echo $this->element('home/product_box', ['data' => $data]);?>
            </div>
            <div class="text-center mt-4 mt-md-5">
                <a href="<?php echo SITEURL; ?>explore" class="btn-link btn-link-s1">View all sales</a>
            </div>
        </div>
    </section>
<?php } ?>