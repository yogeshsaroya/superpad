<div id="custom-content" class="white-popup-block offer-pop" style="max-width:400px; margin: 20px auto;">
    <style>
        .input_box {
            border-radius: 0px !important;
        }

        #setMax {
            cursor: pointer;
        }
    </style>
    <div class="app-contentcontent ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">UNSTAKE</h4>
                <button type="button" class="btn-close icon-btn" data-bs-dismiss="modal" aria-label="Close" onclick="$.magnificPopup.close();">
                    <em class="ni ni-cross"></em>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $obj = json_decode($getStake->stake_info);
                //ec ($getStake);
                $penaltyArr = [];
                if (!empty($obj->all_stakes)) {
                    foreach ($obj->all_stakes as $a) {
                        $penaltyArr[$a->days] = $a->percentage;
                    }
                }

                $datetime1 = date_create($getStake->stake_date->format("Y-m-d H:i:s"));
                $datetime2 = date_create(DATE);

                $interval = date_diff($datetime1, $datetime2);

                $days = $interval->format('%a');

                echo $this->Form->create($getStake, ['autocomplete' => 'off', 'id' => 'e_frm',]);
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('taken_balance', ['id' => 'max_token']);
                echo $this->Form->hidden('penalty_percentage', ['id' => 'penalty_percentage']);
                echo $this->Form->hidden('final_token', ['id' => 'final_token']);
                echo $this->Form->hidden('penalty', ['id' => 'penalty']);
                ?>
                <input type="hidden" name="hold" id="hold" value="<?php echo ($days > 0 ? $days : 0); ?>" />
                <input type="hidden" name="periods" id="periods" value='<?php echo json_encode($penaltyArr); ?>' />

                <label class="form-label">Enter Unstake Amount</label>
                <div class="input-group mb-3">
                    <input type="number" name="unstake" id="setToken" min='1' max='<?php echo $getStake->taken_balance; ?>' class="form-control input_box" />
                    <div class="input-group-append" id="setMax"><span class="input-group-text input_box">Set Max</span></div>
                </div>
                <small>Amount Staked <?php echo number_format($getStake->taken_balance); ?></small>
                <hr>
                <ul class="total-bid-list mb-4">
                    <li><span>Penalty Percentage</span> <span id="setPer">TBA</span></li>
                    <li><span>Penalty Amount</span> <span id="setAmt">TBA</span></li>
                    <li><span>You will Receive</span> <span id="setBal">TBA</span></li>
                </ul>
                <div id="f_err"></div>
                <?php if( (int)$getStake->taken_balance > 0  ){?>
                <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="unStake" id="reg_sbtn" />
                <?php }?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function getPer(obj, num) {
                var n = 0;
                for (const [key, value] of Object.entries(obj)) {
                    if (num <= key) {
                        n = value;
                        break;
                    }
                }
                return n;
            }

            function setCal() {
                $("#setPer, #setAmt, #setBal").html("TBA");
                $("#final_token, #penalty_percentage, #penalty").val(0);

                var maxToken = parseInt($("#max_token").val());
                var getToken = parseInt($("#setToken").val());
                var hold = $("#hold").val();
                var periods = $("#periods").val();
                var objPer = JSON.parse(periods);
                const lastKey = Object.keys(objPer).pop();
                var penalty = 0;
                penalty = getPer(objPer, hold);
                if (getToken > 0 && getToken <= maxToken) {
                    var penAmt = Math.round(getToken * penalty / 100);
                    var avlBal = getToken - penAmt;
                    $("#final_token").val(avlBal);
                    $("#penalty_percentage").val(penalty);
                    $("#penalty").val(penAmt);

                    $("#setPer").html(penalty + "%");
                    $("#setAmt").html(penAmt.toLocaleString('en-US'));
                    $("#setBal").html(avlBal.toLocaleString('en-US'));
                }


            }

            $("#setMax").click(function() {
                $("#setToken").val($("#max_token").val());
                setCal();
            })
            $('#setToken').on('input', function(e) {
                setCal();
            });


            $("#reg_sbtn").click(function() {
                var maxToken = parseInt($("#max_token").val());
                var getToken = parseInt($("#setToken").val());
                if (getToken > 0 && getToken <= maxToken) {
                    $("#e_frm").ajaxForm({
                        target: '#f_err',
                        headers: { 'X-CSRF-Token': $('[name="_csrfToken"]').val() },
                        beforeSubmit: function() {
                            console.log('clicked');
                            $("#reg_sbtn").prop("disabled", true);
                            $("#reg_sbtn").val('Please wait..');
                        },
                        success: function(response) {
                            $("#reg_sbtn").prop("disabled", false);
                            $("#reg_sbtn").val('unStake');
                        },
                        error: function(response) {
                            $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                            $("#reg_sbtn").prop("disabled", false);
                            $("#reg_sbtn").val('unStake');
                        },
                    }).submit();
                }else{
                    $('#f_err').html('<div class="alert alert-danger">Please enter amount between 1 to '+maxToken+'</div>');
                }
            });
        });
    </script>

</div>