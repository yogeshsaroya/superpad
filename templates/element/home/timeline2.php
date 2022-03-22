<?php 
$data = $this->Data->getRoadmaps();
if(!empty($data)){
echo $this->Html->css(['/assets/css/roadmap']);
?>
<style>
    /******************* Timeline Demo - 3 *****************/
.main-timeline3{overflow:hidden;position:relative}
.main-timeline3:before{content:"";width:10px;height:100%;border:3px solid #959595;position:absolute;top:40px;left:50%;transform:translateX(-50%)}
.main-timeline3 .timeline{width:50%;padding:10px 60px 10px 100px;float:right;position:relative}
.main-timeline3 .timeline:before{content:"";width:40px;height:40px;border-radius:50%;background:#c47c48;border:5px solid #fff;box-shadow:0 0 1px 5px #c47c48;position:absolute;top:42px;left:-20px}
.main-timeline3 .timeline-content{display:block;background:#e9e9e7;padding:70px 30px 20px;box-shadow:0 0 10px rgba(0,0,0,.2) inset;position:relative}
.main-timeline3 .timeline-content:hover{text-decoration:none}
.main-timeline3 .year{display:block;width:80%;height:50px;background:#c47c48;padding:0 0 0 50px;font-size:30px;font-weight:800;color:#fff;line-height:50px;box-shadow:0 0 20px rgba(0,0,0,.4) inset;border-radius:10px 10px 10px 0;position:absolute;top:20px;left:-20px}
.main-timeline3 .year:before{content:"";border-top:40px solid #c47c48;border-left:20px solid transparent;border-bottom:20px solid transparent;position:absolute;bottom:-60px;left:0}
.main-timeline3 .title{font-size:18px;font-weight:600;text-transform:uppercase;color:#4a4a4a}
.main-timeline3 .description{font-size:14px;color:#6f6f6f;margin:0 0 5px}
.main-timeline3 .timeline:nth-child(2n){padding:10px 100px 10px 60px;text-align:right}
.main-timeline3 .timeline:nth-child(2n):before{left:auto;right:-20px;background:#bf3fc8;box-shadow:0 0 1px 5px #bf3fc8}
.main-timeline3 .timeline:nth-child(2n) .year{padding-right:50px;border-radius:10px 10px 0;left:auto;right:-20px;background:#bf3fc8}
.main-timeline3 .timeline:nth-child(2n) .year:before{border-left:none;border-right:20px solid transparent;left:auto;right:0;border-top-color:#bf3fc8}
.main-timeline3 .timeline:nth-child(2){margin-top:140px}
.main-timeline3 .timeline:nth-child(odd){margin:-140px 0 0}
.main-timeline3 .timeline:nth-child(even){margin-bottom:60px}
.main-timeline3 .timeline:first-child,.main-timeline3 .timeline:last-child:nth-child(even){margin:0}
.main-timeline3 .timeline:nth-child(3n):before{background:#ce3c41;box-shadow:0 0 1px 5px #ce3c41}
.main-timeline3 .timeline:nth-child(3n) .year{background:#ce3c41}
.main-timeline3 .timeline:nth-child(3n) .year:before{border-top-color:#ce3c41}
.main-timeline3 .timeline:nth-child(4n):before{background:#8cc43d;box-shadow:0 0 1px 5px #8cc43d}
.main-timeline3 .timeline:nth-child(4n) .year{background:#8cc43d}
.main-timeline3 .timeline:nth-child(4n) .year:before{border-top-color:#8cc43d}
@media only screen and (max-width:990px){.main-timeline3:before{top:8%}
.main-timeline3 .timeline{padding:10px 10px 10px 100px}
.main-timeline3 .timeline:nth-child(2n){padding:10px 100px 10px 10px}
}
@media only screen and (max-width:767px){.main-timeline3:before{width:8px;top:0;left:12px;transform:translateX(0)}
.main-timeline3 .timeline,.main-timeline3 .timeline:nth-child(even),.main-timeline3 .timeline:nth-child(odd){width:100%;float:none;text-align:left;padding:0 0 0 60px;margin:0 0 30px}
.main-timeline3 .timeline:before,.main-timeline3 .timeline:nth-child(2n):before{width:20px;height:20px;border:3px solid #fff;top:38px;left:6px}
.main-timeline3 .timeline:nth-child(2n) .year{right:auto;left:-20px;border-radius:10px 10px 10px 0}
.main-timeline3 .timeline:nth-child(2n) .year:before{border-left:20px solid transparent;border-bottom:20px solid transparent;border-right:none;right:auto;left:0}
}
</style>
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
                    </div>
                </div>
            </div>
        </div>
</section>
<?php }?>		