<?php $this->assign('title', 'Stake'); ?>
<style>
    .padd-section {
        padding-top: 50px;
        padding-bottom: 50px
    }

    .section-title {
        margin-bottom: 0px
    }

    #pricing .block-pricing {
        background: #fff;
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 4px 0 rgba(0, 0, 0, 0.19);
        display: inline-block;
        position: relative;
        width: 100%
    }

    #pricing .block-pricing .table {
        margin-bottom: 0;
        padding: 30px 15px;
        max-width: 100%;
        width: 100%
    }

    #pricing .block-pricing .table h4 {
        padding-bottom: 30px
    }

    h4 {
        color: #000;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        line-height: 2
    }

    #pricing .block-pricing h2 {
        margin-bottom: 30px
    }

    h2 {
        color: #000;
        font-weight: 600
    }

    #pricing .block-pricing ul {
        list-style: outside none none;
        margin: 10px auto;

        padding: 0
    }

    #pricing .block-pricing ul li {
        border-bottom: 1px solid rgba(153, 153, 153, 0.3);
        padding: 12px 0;
        text-align: center
    }

    li {
        color: #626262;
        font-size: 13px;
        font-weight: 400;
        letter-spacing: 2px;
        line-height: 30px;
        text-transform: capitalize
    }

    #pricing .block-pricing .table .table_btn a {
        background: #ff7361;
        color: #fff;
        margin: 0;
        display: inline-block
    }


    .stake_div {
        margin-bottom: 40px;
    }

    .bgWhite {
        box-shadow: 0px 0px 4px rgb(0 0 0 / 10%), 0px 4px 8px rgb(0 0 0 / 10%);
        border-radius: 20px;
        padding: 20px;
        background: #fff;
    }

    .bg-lite-blue {
        background: #fafbfd;
        padding: 20px;
        border-radius: 8px;
    }

    .imgWrap {
        border-radius: 10px;
        min-width: 30px;
        min-height: 30px;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .imgGrad {
        background: linear-gradient(90deg, #4086ff 0%, #2bcdff 100%);
    }

    .imgGradsky {
        background: linear-gradient(90deg, #20e4a4 0%, #2cc9cc 100%);
    }

    .bg-lite-blue+.bg-lite-blue {
        margin-top: 1.2rem;
    }

    .primaryText {
        font-weight: bold;
        font-size: 20px;
        color: #000;

    }

    .secondaryText {
        margin-left: 5px;
    }

    .inputFieldsWrap {
        padding: 3px 10px;
        background: #fff;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .btn-approve {
        border: 1px solid #1fa5ff;
        background-color: #1fa5ff;
        border-radius: 5px;
        text-align: center;
        font-size: 14px;
        padding: 10px 20px;
        padding-bottom: 6px;
        text-transform: uppercase;
        position: relative;
        min-width: 240px;
        transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        -webkit-transition: all .3s ease-in-out;
        color: #fff;
    }

    .height100 {
        height: 100%;
    }

    .steps2 {
        max-width: 300px;
        position: relative;
    }

    .steps2:before {
        content: "";
        position: absolute;
        height: 1px;
        width: 90%;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        background: rgba(0, 0, 0, .11);
        z-index: 0;
    }

    .steps2 li {
        width: 25px;
        height: 25px;
        border-radius: 100%;
        background-color: #1fa5ff;
        margin: 0 auto;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 0;
        z-index: 5;
        position: relative;
    }

    .steps2 li:last-child {
        margin-right: 0;
        background-color: #d8dce9;
    }
</style>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Stake</h1>
        </div>
    </div>
</div>

<section class="ranking-section pb-5 pt-5">
    <div class="container">
        <div class="rounded bgWhite">
            <div class="row align-items-stretch">
                <div class="col-md-6">
                    <div class="bg-lite-blue height100">
                        <h3 class="pb-0 mb-3">Superpad to be Staked</h3>
                        <div class="d-flex">
                            <div class="col-4">
                                <div class="d-flex align-items-center inputFieldsWrap">
                                    <div class="logoItem">
                                        <img src="https://superpad.finance/cdn/logo/logo.png" alt="logos">
                                    </div>
                                    <span>Superpad</span>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control text-end" placeholder="0">
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>
                        <hr class="divider mt-3 mb-3" />
                        <div class="d-flex">
                            <div class="col-4">
                                <div class="d-flex align-items-center inputFieldsWrap">
                                    <div class="logoItem">
                                        <img src="https://daomaker.com/assets/img/date.svg" alt="logos">
                                    </div>
                                    <span>Days</span>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control text-end" placeholder="0">
                                    <span class="input-group-text rounded position-absolute top-50 start-0 translate-middle" id="basic-addon2">Max</span>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>

                        <div class="d-flex align-items-center tooltipWrap mt-3">
                            <div class="toolTipImg">
                                <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tooltip">
                            </div>
                            <span>Long Term Bonus: <strong>49%</strong></span>
                        </div>

                        <div class="btnWraper mt-5 row justify-content-center">
                            <ul class="steps2 d-flex col-8 mb-4 justify-content-center align-items-center">
                                <li>1</li>
                                <li>2</li>
                            </ul>

                            <div class="col-6">
                                <button class="w-100 btn btn-approve">
                                    Approve
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="w-100 btn btn-approve" disabled>
                                    STAKE TO JOIN SHOS
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of colom -->

                <div class="col-md-6">
                    <div class="bg-lite-blue">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGrad me-3">
                                <img src="https://daomaker.com/assets/img/venture-yield/white_percent_icon.svg" alt="percent">
                            </div>
                            <span>Estimated Venture Yield</span>
                        </h3>

                        <div class="row">
                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Estimated APR
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Estimated Total DAO Rewards
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>


                    </div>
                    <!-- end of bg blue -->

                    <div class="bg-lite-blue">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGradsky me-3">
                                <img src="https://daomaker.com/assets/img/venture-yield/white_percent_icon.svg" alt="percent">
                            </div>
                            <span>Estimated SHO Yield</span>
                        </h3>

                        <div class="row">
                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Total DAO Power
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Tier
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">Not Active yet</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>

                        <hr class="divider mt-3 mb-3">

                        <div class="row">
                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Max Allocations

                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Estimated Winning Chance
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>

                        <hr class="divider mt-3 mb-3">

                        <div class="row">
                            <div class="col-6">
                                <p><small class="d-flex align-items-center">Estimated SHO Yield APR

                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="ms-2">
                                            <img src="https://daomaker.com/assets/img/icons/help.svg" alt="tool tip"></i></small></p>

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