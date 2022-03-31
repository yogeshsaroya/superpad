<?php
$data = $this->Data->getTeams();
if ( !$data->isEmpty() ) {
    echo $this->Html->css(["/slick/slick",'/slick/slick-theme'],['block' => 'css']);
?>
<style>
    .team_home {
    margin-right: 20px;
}
.slick-prev:before, .slick-next:before {
    font-family: 'slick';
    font-size: 20px;
    line-height: 1;
    opacity: 1;
    color: #000;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

</style>


<section id="partners_list" class="brand-section section-space <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="mb-3">Our Team Members</h2>
        </div><!-- end section-head -->
        <div class="row g-gs">
        <div class="col-md-12">
                <div class="row res_team">
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $list) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 team_home">
                                <div class="our-team">
                                    <div class="pic">
                                        <?php echo $this->Html->image(SITEURL . 'cdn/team/' . $list->img, ['alt' => 'logo', 'width' => 100]); ?>
                                    </div>
                                    <div class="team-content">
                                        <h3 class="title"><?php echo $list->title; ?></h3>
                                        <span class="post team_heading"><?php echo $list->heading; ?></span>
                                        <?php if (!empty($list->linkedin)) { ?>
                                            <a href="<?php echo $list->linkedin; ?>" target="_blank" class="btn btn-lg btn-outline-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                                </svg> LinkedIn</a><?php } ?>
                                    </div>

                                </div>
                                <br>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>

        </div><!-- end d-flex -->
    </div><!-- end container -->
</section>

<?php 
echo $this->Html->script(["/slick/slick.min"],['block' => 'scriptBottom']);
$this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){

    $('.res_team').slick({
  dots: true,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 2000,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

});
<?php $this->Html->scriptEnd(); ?>
<?php }?>