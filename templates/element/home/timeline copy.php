<?php echo $this->Html->css(['/assets/css/roadmap']); 
$data = $this->Data->getRoadmaps();
?>
<section class="brand-section section-space <?php echo (isset($bg_color) ?  $bg_color : null);?>">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="mb-3">Road Map</h2>
                </div><!-- end section-head -->
<div class="container1">
    <div class="row">
        <div class="col-lg-12">
            <div class="card1">
                <div class="body">
                    <div class="cd-horizontal-timeline loaded">
                        <div class="timeline">
                            <div class="events-wrapper">
                                <div class="events" style="width: 1800px;">
                                    <ol>
										<?php if (!empty($data)){
											foreach($data as $list){ ?>
<li><a href="#0" data-date="<?php echo $list->date->format('m/d/Y'); ?>"><?php echo $list->date->format('d M'); ?></a></li>
											<?php }
										}?>
                                        
                                    </ol>
                                    <span class="filling-line" aria-hidden="true" style="transform: scaleX(0.281506);"></span>
                                </div>
                                <!-- .events -->
                            </div>
                            <!-- .events-wrapper -->
                            <ul class="cd-timeline-navigation">
                                <li><a href="#0" class="prev inactive">Prev</a></li>
                                <li><a href="#0" class="next">Next</a></li>
                            </ul>
                            <!-- .cd-timeline-navigation -->
                        </div>
                        <!-- .timeline -->
                        <div class="events-content" style="height: 225px;">
                            <ol>
							<?php if (!empty($data)){
											foreach($data as $list){ ?>
											<li class="" data-date="<?php echo $list->date->format('m/d/Y'); ?>">
                                    <p><?php echo $list->description; ?></p>
                                </li>
											<?php }}?>
                                
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>

<?php $this->Html->scriptEnd(); ?>