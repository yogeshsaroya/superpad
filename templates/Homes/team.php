<?php $this->assign('title', 'Our Team Members'); ?>
<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">

        <div class="row blog">
            <h1 class="center mx-auto text-center py-4">Our Team Members</h1>
            <p><br><br></p>

            <div class="col-md-12">
                <div class="row">
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $list) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
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

        </div>
    </div>
</div>
</div>

<div class="hero-wrap hero-wrap-2 section-space">
    <div class="container">
    </div>
</div>