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
        max-width: 240px;
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
</style>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Stake</h1>
        </div>
    </div>
</div>
<section class="contact-section section-space-b">
    <div class="container">
        <div class="row section-space-b">
            <div class="col-lg-12">
                <section id="pricing" class="padd-section text-center wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="container">
                        <div class="section-title text-center">
                            <h2>Round 1 - Allocation Round</h2>
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
                                                <li><b>Cooldown</b> <?php if(empty($list->cooldown)) { echo "TBA"; }else{ echo ($list->cooldown == 1 ? "Yes" : "No"); } ?></li>
                                                <li><b>Social Task</b> <?php if(empty($list->social_task)){ echo "TBA"; }else{ echo ($list->social_task == 1 ? "Yes" : "No");} ?></li>
                                                <li><b>Max Ticket Allocation</b> <?php echo (!empty($list->max_ticket_allocation) ? $list->max_ticket_allocation : "TBA"); ?></li>
                                                <li><b>Winning Chances</b> <?php echo (!empty($list->winning_chances) ? $list->winning_chances."%" : "TBA"); ?></li>
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