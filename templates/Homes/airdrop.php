<?php
$this->assign('title', 'AirDrop Application');
if (!empty($Setting['recaptcha_site_key']) && !empty($Setting['recaptcha_secret_key'])) { ?>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('g-recaptcha', {
                'sitekey': '<?php echo $Setting['recaptcha_site_key']; ?>'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<?php } ?>
<section class="create-section section-space-b pt-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-head-sm">
                    <h3>AirDrop Application</h3><br>
                    <p></p>
                </div>
                <div id="ido_frm">
                    <?php echo $this->Form->create(null, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'form-create mb-5 mb-lg-0', 'data-toggle' => 'validator']);
                    $a1 = rand(100,999);
                    $a2 = rand(999,100);
                    $que = $a1." + ".$a2;
                    echo $this->Form->hidden('id');
                    echo $this->Form->hidden('a1',['value'=>$a1]);
                    echo $this->Form->hidden('a2',['value'=>$a2]);
                    ?>
                    <div class="form-item mb-4">

                        <div class="mb-3 form-group"><?php echo $this->Form->control('twitter', ['label' => ['text' => 'Your Twitter Handle', 'class' => 'form-label'], 'placeholder' => '@handle name', 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('telegram', ['label' => ['text' => 'Your Telegram Handle', 'class' => 'form-label'], 'placeholder' => '@handle name', 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('wallet_address', ['label' => ['text' => 'BSC Wallet Address', 'class' => 'form-label'], 'placeholder' => 'wallet adddress', 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>

                        <?php if (!empty($sm_accounts)) { ?>
                            <div class="col-md-12"></div>
                            <hr>
                            <div class="mb-3">
                                <h4 class="modal-title">Social Media</h4>
                                <p class="fs-14 mb-3">Please complete the social tasks below.</p>
                            </div>

                            <div class="col-md-12"></div>
                            <br>

                            <div class="container">
                                <?php foreach ($sm_accounts as $sm) { ?>
                                    <div class="row sm_row">
                                        <div class="col-sm">
                                            <div class="card-media card-media-s2 mb-3">
                                                <a href="author.html" class="card-media-img flex-shrink-0 d-block">
                                                    <img src="<?php echo SITEURL . "web3/" . strtolower($sm->type) . ".svg"; ?>" alt="" title="" width="64">
                                                </a>
                                                <div class="card-media-body">
                                                    <p class="fw-semibold"><?php echo $sm->heading; ?></p>
                                                    <p class="small"><?php echo $sm->sub_heading; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <a href="<?php echo $sm->link; ?>" target="_blank" class="btn btn-lg btn-dark wd-200" id="ac_<?php echo $sm->id; ?>"><?php echo $sm->label; ?></a>
                                        </div>
                                        <div class="col-sm sm_chk">
                                            <div class="form-check mb-2 form-group">
                                                <?php echo $this->Form->checkbox('follow.', ['hiddenField' => true, 'div' => ['class' => 'btn btn-primary w-100 bg-transparent'], 'value' => 1, 'class' => 'form-check-input check-all-input sm_follow', 'required' => true, 'checked' => false]); ?>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <hr>
                    </div>

                    <div class="col-sm-12 form-group">

                        <label for="basic-url" class="form-label">Solve this math questions </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3"><?php echo $que;?> = ? </span>
                            <input type="text" name="ans" value="" aria-describedby="basic-addon3" class="form-control" required="required" id="ans">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <br>
                    <hr>

                    <div class="col-sm-12">
                        <div id="g-recaptcha"></div>
                        <hr>
                        <div id="f_err"></div>
                        <br>
                        <input type="button" class="btn btn-dark" id="reg_sbtn" value="Submit" />
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){


$("#e_frm").validator();

$( "#reg_sbtn" ).click(function() {
$("#e_frm").ajaxForm({
target: '#f_err',
headers : { 'X-CSRF-Token': $('[name="_csrfToken"]').val() },
beforeSubmit:function(){ console.log('clicked'); $("#reg_sbtn").prop("disabled",true); $("#reg_sbtn").val('Please wait..'); },
success: function(response) { $("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Submit'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Submit');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>