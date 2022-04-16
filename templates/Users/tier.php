<?php
$this->assign('title', 'My Tier');
echo $this->Html->css(['/assets/css/stake'], ['block' => 'css']);
echo $this->element('profile/header', ['title' => 'My Tier']); ?>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
            <?php echo $this->element('profile/menu', ['menu_act' => 'tier']); ?>
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>My Tier</h3>
                </div><!-- end user-panel-title-box -->
                <div class="profile-setting-panel-wrap">
                    <div class="profile-setting-panel">
                        <div class="container">
                            <div class="section-title text-center">
                                <h2 class="hero-title mb-4">SUPERPAD - TIERS</h2>
                                <p class="separator"></p>
                                <br><br>
                            </div>
                        </div>
                        <div class="mb-3 text-black balance-wrap text-center">
                            <span class="me-3 fw-semibold fs-12">Current Balance:</span>
                            <span class="fw-medium fs-10 "><?php echo number_format($tot_stake); ?></span>
                        </div>
                        <section id="pricing" class="padd-section text-center">
                        <div class="row">
                            <?php if (!empty($my_tier) ) { ?>
                                <div class="col-md-7 col-lg-7 stake_div mx-auto">
                                    <div class="block-pricing">
                                        <div class="table">
                                            <h4><?php echo $my_tier->title; ?></h4>
                                            <h2><?php echo (!empty($my_tier->spad) ? number_format($my_tier->spad) : "TBA"); ?></h2>
                                            <ul class="list-unstyled">
                                                <li><b>Ticket Multiplier</b> <?php echo (!empty($my_tier->ticket_multiplier) ? $my_tier->ticket_multiplier : "TBA"); ?></li>
                                                <li><b>Cooldown</b> <?php echo (!empty($my_tier->cooldown) ? $my_tier->cooldown : "TBA");  ?></li>
                                                <li><b>Social Task</b> <?php echo (!empty($my_tier->social_task) ? $my_tier->social_task : "TBA"); ?></li>
                                                <li><b>Max Ticket Allocation</b> <?php echo (!empty($my_tier->max_ticket_allocation) ? $my_tier->max_ticket_allocation : "TBA"); ?></li>
                                                <li><b>Winning Chances</b> <?php echo (!empty($my_tier->winning_chances) ? $my_tier->winning_chances . "%" : "TBA"); ?></li>
                                                <li><b>Guaranteed Allocation</b> <?php echo (!empty($my_tier->guaranteed_allocation) ? $my_tier->guaranteed_allocation : "TBA"); ?></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>