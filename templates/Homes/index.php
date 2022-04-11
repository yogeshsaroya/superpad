<?php $this->assign('title', $Setting['meta_title']);
$this->assign('description', $Setting['meta_description']);
?>
<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">
        <div class="row align-items-center flex-md-row-reverse justify-content-between">
            <div class="col-lg-5 col-sm-9 col-md-6">
                <div class="hero-image">
                    <img src="<?php echo SITEURL; ?>images/thumb/nft-img.png" alt="" class="w-100">
                </div>
            </div><!-- end col-lg-5 -->
            <div class="col-lg-6 col-md-6">
                <div class="hero-content pb-0 pt-md-0 pe-lg-4">
                    <h1 class="hero-title mb-4"><?php echo $Setting['heading']; ?></h1>
                    <p class="hero-text mb-4 pb-1"><b><?php echo $Setting['sub_heading']; ?></b></p>
                    <!-- button group -->
                    <ul class="btns-group hero-btns">
                        <li><a href="javascript:void(0);" id="to_project" class="btn btn-lg btn-dark">Upcoming Project</a></li>
                        <?php if (isset($Setting['whitepaper'])) { ?><li><a href="<?php echo $Setting['whitepaper']; ?>" class="btn btn-lg btn-outline-dark">WhitePaper</a></li><?php } ?>
                    </ul>
                </div><!-- hero-content -->
            </div><!-- col-lg-6 -->
        </div><!-- end row -->
    </div><!-- .container-->
</div><!-- end hero-wrap -->
<?php echo $this->element('home/featured_sale',['bg_color' => 'bg-gray' ]); ?>
<?php echo $this->element('home/sales',['bg_color' => 'bg-white' ]); ?>
<?php echo $this->element('home/features',['bg_color' => 'bg-gray' ]); ?>
<?php echo $this->element('home/timeline',['bg_color' => 'bg-white' ]); ?>
<?php echo $this->element('home/teams',['bg_color' => 'bg-gray' ]); ?>
<?php echo $this->element('home/partner',['bg_color' => 'bg-white' ]); ?>
<?php echo $this->element('home/influencers',['bg_color' => 'bg-gray' ]); ?>
<?php echo $this->element('home/banner',['bg_color' => 'bg-white' ]); ?>
<?php echo $this->element('home/network',['bg_color' => 'bg-gray' ]); ?>
<?php echo $this->element('home/newsletter',['bg_color' => 'bg-white' ]); ?>

<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){
$("#to_project").click(function() {
$('html, body').animate({
scrollTop: $("#project_list").offset().top
}, 1000);
});
});
<?php $this->Html->scriptEnd(); ?>