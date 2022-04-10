<?php $this->assign('title', 'Stake');
echo $this->Html->css(['/assets/css/stake'], ['block' => 'css']);
?>

<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Stake</h1>
        </div>
    </div>
</div>

<section class="ranking-section pb-5 pt-5">
    <div class="container">
        <div class="bgWhite">
            <div class="row align-items-stretch ">
                <div class="col-lg-6">
                    <div class="bg-lite-blue height100">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGrad me-3">
                                <img src="newImages/blue_percent_icon-svg.png" alt="percent">
                            </div>
                            <span>SPAD to be Staked</span>
                        </h3>
                        <h1 class="mb-2 txtHighlight">37,759,911 Spad</h1>
                        <p><small class="d-flex align-items-center">89,490,982</small></p>
                        </h3>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-lg-6">
                    <div class="bg-lite-blue height100">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGrad me-3">
                                <img src="https://daomaker.com/assets/img/venture-yield/white_dao_icon.svg" alt="percent">
                            </div>
                            <span>Average Locking Days</span>
                        </h3>
                        <h1 class="mb-2 txtHighlight">560 days</h1>
                        <p><small class="d-flex align-items-center">89,490,982</small></p>
                    </div>

                    <!-- end of col -->
                </div>
            </div>
        </div>
        <!-- end of top white bg section -->

        <div class="bgWhite">
            <div class="row align-items-stretch">
                <div class="col-lg-6">
                    <div class="bg-lite-blue height100">
                        <h3 class="pb-0 mb-3">Superpad to be Staked</h3>
                        <div class="d-flex row align-items-stretch">
                            <div class="fixWdth">
                                <div class="d-flex align-items-center inputFieldsWrap">
                                    <div class="logoItem me-2">
                                        <img src="newImages/logo.png" alt="logos">
                                    </div>
                                    <span>SPAD</span>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text setOninput">Max</span>
                                    <input type="text" class="form-control text-end" placeholder="999,999">
                                </div>
                                <p class="text-end"><small class="d-flex align-items-center">Your balance: 0 SPAD
                                    </small></p>
                            </div>
                            <!-- end of colom -->
                        </div>
                        <hr class="divider mt-3 mb-3" />
                        <div class="d-flex row align-items-stretch">
                            <div class="fixWdth">
                                <div class="d-flex align-items-center inputFieldsWrap">
                                    <div class="logoItem me-2">
                                        <img src="newImages/calender-png.png" alt="logos">
                                    </div>
                                    <span>Days</span>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text setOninput">Max</span>
                                    <input type="text" class="form-control text-end" placeholder="0">
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>

                        <div class="d-flex align-items-center tooltipWrap mt-3">
                            <div class="toolTipImg me-2">
                                <img src="newImages/help-svg.png" alt="tooltip">
                            </div>
                            <span>Long Term Bonus: <strong class="txtHighlight">49%</strong></span>
                        </div>

                        <div class="btnWraper mt-5 d-flex justify-content-center">
                            <ul class="steps2 d-flex col-8 mb-3 justify-content-center align-items-center">
                                <li>1</li>
                                <li>2</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="w-100 btn btn-approve">
                                    Approve
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="w-100 btn btn-approve disbble-bTn" disabled>
                                    STAKE TO JOIN SHOS
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of colom -->

                <div class="col-lg-6">
                    <div class="bg-lite-blue">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGrad me-3">
                                <img src="newImages/blue_percent_icon-svg.png" alt="percent">
                            </div>
                            <span>Estimated Venture Yield</span>
                        </h3>

                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Estimated APR
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Estimated Total DAO Rewards
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">3,519 SPAD</div>
                                    <div class="secondaryText">$8,623</div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>


                    </div>
                    <!-- end of bg blue -->

                    <div class="bg-lite-blue">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGradsky me-3">
                                <img src="newImages/blue_percent_icon-svg.png" alt="percent">
                            </div>
                            <span>Estimated SHO Yield</span>
                        </h3>

                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Total DAO Power
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Tier
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">Not Active yet</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>



                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Max Allocations

                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Estimated Winning Chance
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>



                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-center">Estimated SHO Yield APR

                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="newImages/help-svg.png" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0% APR</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                        </div>

                    </div>
                    <!-- end of bg blue -->
                </div>
                <!-- end of colom -->
            </div>
        </div>

    </div><!-- .container -->
</section><!-- end ranking-section -->
<section class="contact-section section-space-b">
    <div class="container">
        <div class="row section-space-b">
            <div class="col-lg-12">
                <section id="pricing" class="padd-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="container">
                        <div class="section-title text-center">
                            <h2>SUPERPAD - TIERS</h2>
                            <p class="separator"></p>
                            <br><br>
                        </div>
                    </div>
                    <div class="container1">
                        <div class="row">
                            <?php foreach ($data as $list) { ?>
                                <div class="col-md-6 col-lg-4 stake_div">
                                    <div class="block-pricing">
                                        <div class="table">
                                            <h4><?php echo $list->title; ?></h4>
                                            <h2><?php echo (!empty($list->spad) ? $list->spad : "TBA"); ?></h2>
                                            <ul class="list-unstyled">
                                                <li><b>Ticket Multiplier</b> <?php echo (!empty($list->ticket_multiplier) ? $list->ticket_multiplier : "TBA"); ?></li>
                                                <li><b>Cooldown</b> <?php echo (!empty($list->cooldown) ? $list->cooldown : "TBA");  ?></li>
                                                <li><b>Social Task</b> <?php echo (!empty($list->social_task) ? $list->social_task : "TBA"); ?></li>
                                                <li><b>Max Ticket Allocation</b> <?php echo (!empty($list->max_ticket_allocation) ? $list->max_ticket_allocation : "TBA"); ?></li>
                                                <li><b>Winning Chances</b> <?php echo (!empty($list->winning_chances) ? $list->winning_chances . "%" : "TBA"); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>