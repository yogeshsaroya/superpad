<?php $this->assign('title', 'Stake');
echo $this->Html->css(['/assets/css/stake'], ['block' => 'css']);
?>
<?php
echo $this->Form->create(null);
echo $this->Form->end(); ?>
<input type="hidden" id="max_token" value="10000" />
<input type="hidden" id="max_days" value="<?php echo $max; ?>" />
<input type="hidden" id="min_days" value="<?php echo $min; ?>" />
<input type="hidden" id="min_return" value="<?php echo $min_return; ?>" />
<input type="hidden" id="max_return" value="<?php echo $max_return; ?>" />
<input type="hidden" id="tires" value='<?php echo json_encode($tire); ?>' />
<input type="hidden" id="stakes" value='<?php echo json_encode($stake); ?>' />

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
                            <span>Total SPAD Staked</span>
                        </h3>
                        <h1 class="mb-2 txtHighlight">TBA</h1>
                        <p><small class="d-flex align-items-center">TBA</small></p>
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
                            <span>Average Locking period</span>
                        </h3>
                        <h1 class="mb-2 txtHighlight">TBA</h1>
                        <p><small class="d-flex align-items-center">TBA</small></p>
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
                        <h3 class="pb-0 mb-3">SPAD to be Staked</h3>
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
                                <input type="number" min='0' class="form-control text-end" name="bal" id="bal" data_min="<?php echo (isset($min_token) ? (int)$min_token : 0);?>" value="<?php echo (isset($qr['token']) ? $qr['token'] : null);?>" placeholder="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                
                                </div>
                                <p class="text-end"><small class="d-flex align-items-center">Your balance: 10,000 SPAD
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
                                    <span class="input-group-text setOninput hide" id="_days">Max</span>
                                    
                                    <?php echo $this->Form->input('days',['type'=>'select', 'options'=>$days_list,
                                    'default'=>(isset($qr['days']) ? $qr['days'] : null),
                                    'class'=>'form-control form-choice-choices__input','id'=>'days']);?>
                                </div>
                            </div>
                            <!-- end of colom -->
                        </div>
                        <div class="col-12 mt-3" id="app_err"></div>

                        <div class="row">
                        <?php if(isset($Auth)){ ?>
                            <div class="col-6"> <input type="button" class="w-100 btn btn-lg btn-dark" value="Stake Now" id="doStake" /> </div>
                            <div class="col-6"><?php echo $this->Html->link('unStake','/users/staking',['class'=>'w-100 btn btn-lg btn-outline-dark']);?></div>
                        <?php }else{ ?>
                            <div class="col-12"> <input type="button" class="w-100 btn btn-lg btn-dark" value="Stake Now" id="doLogin"/> </div>
                       <?php } ?>
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
                                    <div class="primaryText" id="est_apy">0%</div>
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
                                    <div class="primaryText" id="est_rewards">0 SPAD</div>
                                    <div class="secondaryText hide">$0</div>
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
                                <p><small class="d-flex align-items-start">Ticket Multiplier
                                        <?php echo getToolTip('Total SPAD Power is calculated based on
vour staked tokens (and provided liquidity)
and new tokens to be staked'); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText" id="tier_spad">0</div>
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
                                    <div class="primaryText" id="tier_name">Not Active yet</div>
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
                                    <div class="primaryText" id="tier_all" >0</div>
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
                                    <div class="primaryText" id="tier_cha">0%</div>
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
                                    <div class="primaryText" id="tier_cooldown">N/A</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                            <!-- end of colom -->

                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Social Task
                                        <?php echo getToolTip(); ?></small></p>

                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText" id="tier_sm">N/A</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row estimatedRow">
                            <div class="col-md-6">
                                <p><small class="d-flex align-items-start">Guaranteed Allocation<?php echo getToolTip(); ?></small></p>
                                <div class="headeredTextContainer d-flex">
                                    <div class="primaryText" id="tier_gua">N/A</div>
                                    <div class="secondaryText"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-container">
                <div class="icon-container ng-star-inserted"><img _ngcontent-kha-c106="" src="<?php echo SITEURL; ?>img/Warning.svg"></div>
                <span class="title-black">Minimum staking for 10 days . Early unstaking will cause penalty. (<?php echo $this->Html->link('FAQ', '/page/faq'); ?>).</span>
                
            </div>
            <div class="header-container">
                <span class="title-black">If You stack for 2-3 years then no cooldown (Applicable from Asteroid Tier)</span>
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
                                            <h2><?php echo (!empty($list->spad) ? number_format($list->spad) : "TBA"); ?></h2>
                                            <ul class="list-unstyled">
                                                <li><b>Ticket Multiplier</b> <?php echo (!empty($list->ticket_multiplier) ? $list->ticket_multiplier : "TBA"); ?></li>
                                                <li><b>Cooldown</b> <?php echo (!empty($list->cooldown) ? $list->cooldown : "TBA");  ?></li>
                                                <li><b>Social Task</b> <?php echo (!empty($list->social_task) ? $list->social_task : "TBA"); ?></li>
                                                <li><b>Max Ticket Allocation</b> <?php echo (!empty($list->max_ticket_allocation) ? $list->max_ticket_allocation : "TBA"); ?></li>
                                                <li><b>Winning Chances</b> <?php echo (!empty($list->winning_chances) ? $list->winning_chances . "%" : "TBA"); ?></li>
                                                <li><b>Guaranteed Allocation</b> <?php echo (!empty($list->guaranteed_allocation) ? $list->guaranteed_allocation : "TBA"); ?></li>
                                                
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
    function ec(s){ console.log(s); }

        function findNearestMinObj(obj, target) {
            const sortedKeys = Object.keys(obj).map(d => Number(d)).sort((a, b) => b - a)
            const key = sortedKeys.find(k => target >= k)
            if (key === undefined) return false
            return obj[key];
        }

        function cal(){
                var tires = $("#tires").val();
                var stakes = $("#stakes").val();
                var obj_stakes = JSON.parse(stakes);
                var obj_tires = JSON.parse(tires);
                var bal = parseInt( $("#bal").val() );
                var days = parseInt( $("#days").val() );
                var min_t = $("#bal").attr('data_min');

                $("#app_err").html('');
                if( bal >= 1 ){
                    var per = obj_stakes[days];
                    if ( days > 0 && bal > 0){
                    var rew = Math.round( (bal*per/100)/365*days );
                        $("#est_apy").html(per+'%');
                        $("#est_rewards").html(rew+' SPAD');
                    }else{
                        $("#est_apy").html('0%');
                        $("#est_rewards").html('0 SPAD');
                    }

                    
                    var ti = findNearestMinObj(obj_tires,bal);
                
                    if (ti === undefined || ti === null || ti === false) {  
                        
                        $("#tier_spad").html('0');
                        $("#tier_name").html('Not Active yet');
                        $("#tier_all").html('0');
                        $("#tier_cha").html("0%");
                        $("#tier_cooldown").html('N/A');
                        $("#tier_sm").html('N/A');
                        $("#tier_gua").html('N/A');
                        
                    }else{
                        ec(ti);
                        $("#tier_spad").html(ti.ticket_multiplier);
                        $("#tier_name").html(ti.title);
                        $("#tier_all").html(ti.max_ticket_allocation);
                        $("#tier_cha").html(ti.winning_chances+"%");
                        $("#tier_cooldown").html(ti.cooldown);
                        $("#tier_sm").html(ti.social_task);
                        $("#tier_gua").html(ti.guaranteed_allocation);
                        
                    }
                }else{
                    $("#app_err").html('<div class="alert alert-danger">Minimum '+min_t+' token can be staked.</div>');
                    $("#est_apy").html('0%');
                    $("#est_rewards").html('0 SPAD');
                    $("#tier_spad").html('0');
                    $("#tier_name").html('Not Active yet');
                    $("#tier_all").html('0');
                    $("#tier_cha").html("0%");
                    $("#tier_cooldown").html('N/A');
                    $("#tier_sm").html('N/A');
                    $("#tier_gua").html('N/A');
                }
        }

<?php if( isset($qr['days']) && isset($qr['token']) ){
    echo "cal();";
}?>

        $('#bal, #days').on('input', function(e) { cal(); });
        $( "#days" ).change(function() { cal(); });


        $( "#max_spad" ).click(function() {
        var t = $("#max_token").val();
        $("#bal").val(t);
        cal();
        });

        $( "#_days" ).click(function() {
        var d = $("#max_days").val();
        $("#days").val(d);
        cal();
        });



        $( "#doLogin" ).click(function() {
        var bal = parseInt( $("#bal").val() );
        var days = parseInt( $("#days").val() );
        var min_t = $("#bal").attr('data_min');
        if(bal >= 1 && days  > 0 ){ window.location.href = "sign-in?redirect=stake&days="+days+"&token="+bal; }
        });

        $( "#doStake" ).click(function() {
            var bal = parseInt( $("#bal").val() );
            var days = parseInt( $("#days").val() );
            var min_t = $("#bal").attr('data_min');
            if(bal >= 1 && days  > 0 ){

            $.ajax({type: 'POST',
            headers : { 'X-CSRF-Token': $('[name="_csrfToken"]').val() },
            url: SITEURL+'users/do_stake',
            data: {bal:bal,days:days},
            success: function(data) { $("#cover").html(data); },
            error: function(comment) { $("#cover").html(comment); }});

            }

        });

});
<?php $this->Html->scriptEnd(); ?>
