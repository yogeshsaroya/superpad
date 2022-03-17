<?php $this->assign('title', 'Forget Password');?>
<section class="login-section section-space-b pt-4 pt-md-5 mt-md-3">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 mb-5 mb-lg-0 d-none d-lg-block">
                <img src="images/forgot-password-v2.svg" alt="" class="img-fluid">
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6 col-md-9">
                <div class="section-head-sm">
                    <h2 class="mb-2">Forgot Password?</h2>
                    <p>Enter your email and we'll send you instructions to reset your password</p>
                </div>
                <?php echo $this->Form->create($user_data, ['url' => ['controller' => 'users', 'action' => 'forget-password'], 'autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator']);  ?>
                <div class="form-floating mb-4 form-group">
                    <?php echo $this->Form->control('email', [
                        'id' => 'email', 'label' => false, 'type' => 'email', 'class' => 'form-control',
                        'autocomplete' => 'new-email','templates' => ['inputContainer' => '{{content}}'], 'required' => true]); ?>
                    <label for="email">Email address</label><div class="help-block with-errors"></div>
                </div><!-- end form-floating -->
                <div id="f_err"></div>
                <input type="button" class="btn btn-dark w-100" value="Submit" id="login_sbtn" />
                <?php echo $this->Form->end(); ?>
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end login-section -->


<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){


$("#e_frm").validator();

$( "#login_sbtn" ).click(function() {
$("#e_frm").ajaxForm({
target: '#f_err',
headers : {
'X-CSRF-Token': $('[name="_csrfToken"]').val()
},
beforeSubmit:function(){ $("#login_sbtn").prop("disabled",true); $("#login_sbtn").val('Please wait..'); },
success: function(response) { $("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Submit'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Submit');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>