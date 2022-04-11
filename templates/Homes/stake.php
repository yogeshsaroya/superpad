<?php $this->assign('title', 'Stake');
echo $this->Html->css(['/assets/css/stake'], ['block' => 'css']);
?>

<input type="hidden" id="max_token" value="100000">
<input type="hidden" id="max_days" value="760">
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
                                <img src="<?php echo SITEURL; ?>newImages/blue_percent_icon-svg.png" alt="percent">
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
                            <div class="me-3">
                                <img src="<?php echo SITEURL; ?>newImages/logo.png" alt="percent">
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
                                        <img src="<?php echo SITEURL; ?>newImages/logo.png" alt="logos">
                                    </div>
                                    <span>SPAD</span>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text setOninput" id="max_spad">Max</span>
                                    <input type="text" class="form-control text-end" name="bal" id="bal" placeholder="0">
                                </div>
                                <p class="text-end"><small class="d-flex align-items-center">Your balance: 100,000 SPAD
                                    </small></p>
                            </div>
                            <!-- end of colom -->
                        </div>
                        <hr class="divider mt-3 mb-3" />
                        <div class="d-flex row align-items-stretch">
                            <div class="fixWdth">
                                <div class="d-flex align-items-center inputFieldsWrap">
                                    <div class="logoItem me-2"><img src="<?php echo SITEURL; ?>newImages/calender-png.png" alt="logos"></div>
                                    <span>Days</span>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text setOninput" id="_days">Max</span>
                                    <input type="text" class="form-control text-end" name="days" id="days" placeholder="10">
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>

                        <div class="d-flex align-items-center tooltipWrap mt-3">
                            <div class="toolTipImg me-2">
                                <?php echo getToolTip('A longer staking timeframe will provide
higher daily rewards. Users are given a 50%
bonus in daily rewards for every additional
30 days staking duration. to'); ?>

                            </div>
                            <span>Long Term Bonus: <strong class="txtHighlight">49%</strong></span>
                        </div>

                        <div class="btnWraper mt-5 d-flex justify-content-center">
                            <ul class="steps2 d-flex col-8 mb-3 justify-content-center align-items-center" style="display: none !important;">
                                <li>1</li>
                                <li>2</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button class="w-100 btn btn-lg btn-dark">
                                    Stake Now
                                </button>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of colom -->

                <div class="col-lg-6">
                    <div class="bg-lite-blue">
                        <h3 class="d-flex align-items-center mb-3">
                            <div class="imgWrap imgGrad me-3">
                                <img src="<?php echo SITEURL; ?>newImages/blue_percent_icon-svg.png" alt="percent">
                            </div>
                            <span>Annual Percentage Yield</span>
                        </h3>

                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Estimated APY
                                        <?php echo getToolTip('Estimated APR is calculated based on the
estimated Daily rewards and your staked
SPAD'); ?>
                                    </small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Estimated SPAD Rewards
                                        <?php echo getToolTip('Daily Rewards calculated as per default
values shown in the simulation model
multiplied by number of days staked'); ?></small></p>

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
                                <img src="<?php echo SITEURL; ?>newImages/blue_percent_icon-svg.png" alt="percent">
                            </div>
                            <span>Tier details</span>
                        </h3>

                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Total SPAD Power
                                        <?php echo getToolTip('Total SPAD Power is calculated based on
vour staked tokens (and provided liquidity)
and new tokens to be staked'); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Tier
                                        <?php echo getToolTip('Users participate to SHOs in Tier. Being in a
higher tier offers higher allocations and
winning chances. If you already have staked
SPAD then the shown Tranche will consider
your past deposits as well.'); ?></small></p>

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
                                        <?php echo getToolTip('Number of allocations participant can win T
per SHO. If each allocation provides $200
and the users maximum allocation is 3 then
then user cannot win more than $600.'); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Estimated Winning Chance
                                        <?php echo getToolTip('Chance of winning a ticket per SHO.
Chances depend on total amount of
participation and the total amount raised in
the SHO. Less participants means higher
chances. Larger size raises mean higher
winning chances. The winning chance is
based on the default value shown in the
simulation model'); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>
                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Cooldown
                                        <?php echo getToolTip(); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Social Task
                                        <?php echo getToolTip(); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText">0%</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>





                    </div>
                    <!-- end of bg blue -->
                </div>


            </div>
            <div class="header-container">
                <div class="icon-container ng-star-inserted"><img _ngcontent-kha-c106="" src="<?php echo SITEURL; ?>img/Warning.svg"></div>
                <span class="title-black">Minimum staking for 10 days . Early unstaking will cause penalty. (<?php echo $this->Html->link('FAQ', '/page/faq'); ?>)</span>
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
                            <h2 class="hero-title mb-4">SUPERPAD - TIERS</h2>
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

<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){
$( "#max_spad" ).click(function() {
var t = $("#max_token").val();
$("#bal").val(t);
});

$( "#_days" ).click(function() {
var d = $("#max_days").val();
$("#days").val(d);
});

$("#e_frm").validator();

$( "#login_sbtn" ).click(function() {
$("#e_frm").ajaxForm({
target: '#f_err',
headers : {
'X-CSRF-Token': $('[name="_csrfToken"]').val()
},
beforeSubmit:function(){ $("#login_sbtn").prop("disabled",true); $("#login_sbtn").val('Please wait..'); },
success: function(response) { $("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Sign In'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Sign In');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>