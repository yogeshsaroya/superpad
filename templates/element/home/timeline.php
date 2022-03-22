<?php 
$data = $this->Data->getRoadmaps();
if(!empty($data)){
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
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2018</span>
                                <h3 class="title">Web Designer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2017</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2016</span>
                                <h3 class="title">Web Designer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2015</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2015</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2015</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                        <div class="timeline">
                            <a href="#" class="timeline-content">
                                <span class="year">2015</span>
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer malesuada tellus lorem, et condimentum neque commodo quis.
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php }?>		