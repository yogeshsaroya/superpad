<?php $this->assign('title', 'Our Team Members'); ?>
<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">

        <div class="row blog">
            <h1 class="center mx-auto text-center py-4">Our Team Members</h1>
            <p><br><br></p>

            <div class="col-md-12">
                <div class="row">
                    <?php 
                    if(!empty($data)){
                    foreach ($data as $list) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <?php echo $this->Html->image(SITEURL . 'cdn/team/' . $list->img, ['alt' => 'logo', 'width' => 100]);?>
                                </div>
                                <div class="team-content">
                                    <h3 class="title"><?php echo $list->title;?></h3>
                                    <span class="post"><?php echo $list->heading;?></span>
                                    <span class="post sub_head"><?php echo $list->sub_heading;?></span>
                                </div>

                            </div>
                            <br>
                        </div>
                    <?php } } ?>
                </div>
                <!--.row-->
            </div>

        </div>
    </div>
</div>
</div>

<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">
    </div>
</div>