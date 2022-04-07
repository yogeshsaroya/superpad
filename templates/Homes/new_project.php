<?php
$this->assign('title', 'Apply to launch IDO');
if(!empty($Setting['recaptcha_site_key']) && !empty($Setting['recaptcha_secret_key']) )
{?>
<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('g-recaptcha', {
          'sitekey' : '<?php echo $Setting['recaptcha_site_key'];?>'
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
                    <h3>IDO Application</h3><br>
                    <p>Welcome to the future of decentralised fundraising on SuperPAD. Our mission is to bring the highest quality projects together with investors to enable the launch of innovative startups and technology. With this goal, it is the responsibility of the SuperPAD Council to act as a governance board to ensure quality and due diligence for the projects we launch.</p>
                </div>
                <div id="ido_frm">
                    <?php echo $this->Form->create($tbl_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'form-create mb-5 mb-lg-0', 'data-toggle' => 'validator']); ?>
                    <div class="form-item mb-4">

                        <div class="mb-3 form-group"><?php echo $this->Form->control('name', ['label' => ['text' => 'Project Name', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('website', ['type' => 'url', 'label' => ['text' => 'Project Website', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('token_name', ['label' => ['text' => 'Token/Coin Full Name', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('token_symbol', ['label' => ['text' => 'Token/Coin Symbol', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('blockchain', ['label' => ['text' => 'Blockchain (BSC, Ethereum, Solana etc)', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('contract_address_link', ['label' => ['text' => 'Token/Coin Contract Address Link', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('marketing_deck', ['type'=>'url','label' => ['text' => 'Marketing Deck (Please provide a link, or upload into google docs, paste the URL here, and make sure to change permissions to "anyone with the link)', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        
                        <div class="mb-3 form-group"><?php echo $this->Form->control('telegram', ['type' => 'url', 'label' => ['text' => 'Project Telegram Chat Link', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('twitter', ['type' => 'url', 'label' => ['text' => 'Project Twitter Link', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('other_account', ['type' => 'textarea', 'rows' => 3, 'label' => ['text' => 'Other Social Media Links (Please put all you have)', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('email', ['type' => 'email', 'label' => ['text' => 'Your Email', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('telegram_username', ['label' => ['text' => 'Your Telegram Username', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('investors', ['type' => 'textarea', 'rows' => 3, 'label' => ['text' => 'Please provide us with the full list of backers/ investors (Whether confirmed or in discussion)', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('main_investor', ['label' => ['text' => 'Who is your incubator/lead investor/main advisor?', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('audited', ['options' => ['Yes' => 'Yes', 'No' => 'No'], 'empty' => 'Select', 'label' => ['text' => 'Has your project been audited?', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('hear_about', ['type' => 'textarea', 'rows' => 3, 'label' => ['text' => 'How did you hear about superPAD?', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('other_comment', ['type' => 'textarea', 'rows' => 3, 'label' => ['text' => 'Anything else we should know? *', 'class' => 'mb-2 form-label'], 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-sm-12"><div id="g-recaptcha"></div>
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