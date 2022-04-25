<div id="custom-content" class="white-popup-block offer-pop" style="max-width:500px; margin: 20px auto;">
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
                <h4 class="modal-title">Join Now</h4>
                <button type="button" class="btn-close icon-btn" data-bs-dismiss="modal" aria-label="Close" onclick="$.magnificPopup.close();">
                    <em class="ni ni-cross"></em>
                </button>
            </div>
            <div class="modal-body">
                <?php if (empty($data)) { ?>
                    <div class="alert alert-danger d-flex mb-4" role="alert">
                        <svg class="flex-shrink-0 me-3" width="30" height="30" viewBox="0 0 24 24" fill="#ff6a8e">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"></path>
                        </svg>
                        <p class="fs-14">You have not applied for this sale or lottery ticket not allocated yet. check your email for lottery status</p>
                    </div>
                <?php } else { ?>
                    <?php
                    echo $this->Form->create($data, ['autocomplete' => 'off', 'id' => 'e_frm',]);
                    echo $this->Form->hidden('id');
                    echo $this->Form->hidden('max_amt', ['id' => 'max_amt', 'value' => $max_amt]);

                    echo $this->Form->hidden('joined', ['id' => 'joined', 'value' => $data->joined]);
                    echo $this->Form->hidden('remaining', ['id' => 'remaining', 'value' => $data->remaining]);

                    echo $this->Form->hidden('max_tickets', ['id' => 'max_tickets', 'value' => $max_tickets]);
                    ?>

                    <label class="form-label">Enter Amount</label>
                    <div class="input-group mb-3">
                        <input type="text" name="amt" id="setAmt" class="form-control input_box" />
                        <div class="input-group-append" id="setMax"><span class="input-group-text input_box">Set Max</span></div>
                    </div>

                    <hr>
                    <ul class="total-bid-list mb-4">
                        <li><span>Max allocation: </span> <span class="text-bold"><?php echo $max_amt . " " . $short_name; ?></span></li>
                        <li><span>Joined: </span> <span class="text-bold"><?php echo $data->joined . " " . $short_name; ?></span></li>
                        <li><span>Remaining: </span> <span class="text-bold"><?php echo $data->remaining . " " . $short_name; ?></span></li>
                        <li><span>You have </span> <span class="text-bold"><?php echo $max_tickets; ?> winning ticket(s)</span></li>
                    </ul>
                    <div id="f_err"></div>
                    <?php if ($data->remaining > 0 && $max_tickets > 0) { ?>
                        <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Join Now" id="reg_sbtn" />
                    <?php } else { ?>
                        <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Close" onclick="$.magnificPopup.close();"/>
                    <?php } ?>

                <?php echo $this->Form->end();
                } ?>
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
            $("#setMax").click(function() {
                $("#setAmt").val($("#remaining").val());
            })

            $("#reg_sbtn").click(function() {
                var max_amt = $("#remaining").val();
                var setAmt = $("#setAmt").val();
                if (setAmt > 0 && setAmt <= max_amt) {
                    $("#e_frm").ajaxForm({
                        target: '#f_err',
                        headers: {
                            'X-CSRF-Token': $('[name="_csrfToken"]').val()
                        },
                        beforeSubmit: function() {
                            console.log('clicked');
                            $("#reg_sbtn").prop("disabled", true);
                            $("#reg_sbtn").val('Please wait..');
                        },
                        success: function(response) {
                            $("#reg_sbtn").prop("disabled", false);
                            $("#reg_sbtn").val('Join Now');
                        },
                        error: function(response) {
                            $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                            $("#reg_sbtn").prop("disabled", false);
                            $("#reg_sbtn").val('Join Now');
                        },
                    }).submit();
                } else {
                    $('#f_err').html('<div class="alert alert-danger">Please enter amount between 0.1 to ' + max_amt + '</div>');
                }
            });
        });
    </script>

</div>