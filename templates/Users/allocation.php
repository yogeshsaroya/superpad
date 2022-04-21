<?php $this->assign('title', 'Allocations'); ?>
<section class="about-section pt-5 mt-3 cta-section section-space-b bg-pattern">
    <div class="container pt-5 pb-5">
        <?php if ($data->isEmpty()) { ?>
            <div class="cta-box1 pt-5 mt-3 text-center">
                <h1 class="cta-title mb-3">You don't have any allocation yet</h1>
                <p class="cta-text mb-4">Allocations for all of the sales that you participated in will show up here.</p>
                <a href="<?php echo SITEURL; ?>explore" class="btn btn-lg btn-dark">Go to Sales</a>
            </div>
        <?php } else { ?>
            <div class="pb-5">
                <div class="profile-setting-panel">
                    <h3 class="mb-1 text-center">Active Allocations</h3>
                    <p class="mb-4 fs-14 text-center">Allocations for all of the sales that you participated in will show up here.</p>
                    <div class="row g-gs">
                        <?php foreach ($data as $list) { ?>
                            <div class="col-xl-4">
                                <div class="card card-full">
                                    <div class="card-body card-body-s1">
                                        <div class="card-media mb-3">
                                            <div class="card-media-img flex-shrink-0">
                                                <img src="<?php echo SITEURL . "cdn/project_logo/" . $list->project->logo; ?>" alt="media image">
                                            </div>
                                            <div class="card-media-body">
                                                <h4><a href="<?php echo SITEURL . "explore/" . $list->project->slug; ?>"><?php echo $list->project->title; ?></a></h4>
                                                <p class="fw-medium fs-14"><?php echo $list->project->ticker; ?>
                                                    <?php if (isset($list->project->blockchain->name)) { ?>
                                                        <img src="<?php echo SITEURL . 'cdn/blockchains/' . $list->project->blockchain->logo; ?>" title="<?php echo $list->project->blockchain->name; ?>" width="32px" alt="" />

                                                    <?php } ?>
                                                </p>

                                            </div>
                                        </div>
                                        <div class="card-media mb-3">
                                            <div class="card-media-body"><span class="fw-medium fs-13">Staking APR</span></div>
                                            <div class="card-media-body"><p class="fw-medium text-black text-right fs-14"><?php echo ($average > 0 ? number_format($average,2)."%" : 'N/A'); ?></p></div>
                                        </div>
                                        <div class="card-media mb-3">
                                            <div class="card-media-body"><span class="fw-medium fs-13">Available Now</span></div>
                                            <div class="card-media-body"><p class="fw-medium text-black text-right fs-14">N/A</p></div>
                                        </div>
                                        <div class="card-media mb-3">
                                            <div class="card-media-body"><span class="fw-medium fs-13">Claimed</span></div>
                                            <div class="card-media-body"><p class="fw-medium text-black text-right fs-14">N/A</p></div>
                                        </div>
                                        <div class="card-media mb-3">
                                            <div class="card-media-body"><span class="fw-medium fs-13">Total</span></div>
                                            <div class="card-media-body"><p class="fw-medium text-black text-right fs-14">N/A</p></div>
                                        </div>
                                        <div class="card-media mb-3">
                                            <div class="card-media-body"><span class="fw-medium fs-13">Contribution</span></div>
                                            <div class="card-media-body"><p class="fw-medium text-black text-right fs-14"><?php echo $list->joined." ".$list->project->blockchain->short_name; ?></p></div>
                                        </div>
                                        <hr>
                                        <a href="javascript:void(0);" id="to_project" class="btn btn-lg btn-dark">Claim Token</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>