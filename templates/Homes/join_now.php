<div id="custom-content" class="white-popup-block offer-pop" style="max-width:500px; margin: 20px auto;">
    <style>
        .input_box { border-radius: 0px !important; }
        #setMax { cursor: pointer; }
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
                <?php
                echo $this->Form->create($data, ['autocomplete' => 'off', 'id' => 'e_frm',]);
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('max_amt',['id'=>'max_amt', 'value'=>$max_amt]);
                echo $this->Form->hidden('max_tickets',['id'=>'max_tickets', 'value'=>$max_tickets]);
                
                ?>
                
                <label class="form-label">Enter Amount</label>
                <div class="input-group mb-3">
                    <input type="text" name="amt" id="setAmt" class="form-control input_box" />
                    <div class="input-group-append" id="setMax"><span class="input-group-text input_box">Set Max</span></div>
                </div>
                
                <hr>
                <ul class="total-bid-list mb-4">
                    <li><span>Max allocation: </span> <span class="text-bold"><?php echo $max_amt." ".$short_name;?></span></li>
                    <li><span>You have </span> <span class="text-bold"><?php echo $max_tickets;?> winning ticket(s)</span></li>
                </ul>
                <div id="f_err"></div>
                
                <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Join Now" id="reg_sbtn" />
                
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
            $("#setMax").click(function() {
                $("#setAmt").val($("#max_amt").val());
            })

            $("#reg_sbtn").click(function() {
                var max_amt = $("#max_amt").val();
                var setAmt = $("#setAmt").val();
                if (setAmt > 0 && setAmt <= max_amt) {
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