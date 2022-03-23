<?php
$data = $this->Data->getRoadmaps();

if (!empty($data)) {
    echo $this->Html->css(['/assets/css/roadmap']);
?>
    <section class="brand-section section-space <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
        <div class="container">
            <div class="section-head text-center">
                <h2 class="mb-3">Road Map</h2>
            </div><!-- end section-head -->
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline3">
                        <?php foreach ($data as $list) { ?>
                            <div class="timeline">
                                <div class="timeline-content">
                                    <span class="year"><?php echo $list->year;?></span>
                                    <h3 class="title"><?php echo $list->title;?></h3>
                                    <p class="description"><?php echo nl2br($list->description);?></p>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>