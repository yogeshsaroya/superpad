<?php $this->assign('title', 'Welcome');
$is_fb = $is_google = null;
if (!empty($Setting['fb_app_id']) && !empty($Setting['fb_app_secret'])) {
    $is_fb = 1;
}
if (!empty($Setting['google_client_id']) && !empty($Setting['google_client_secret'])) {
    $is_google = 1;
}
?>
<section class="login-section section-space-b pt-4 pt-md-5 mt-md-3">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 mb-5 mb-lg-0 d-none d-lg-block">
                <img src="<?php echo SITEURL;?>images/thumb/remote.png" alt="" class="img-fluid">
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6 col-md-9">
                <div class="section-head-sm">
                    <h2 class="mb-2">Welcome Back!</h2>
                    <p>Login to countinue</p>
                </div>
                <?php echo $this->Form->create($user_data, ['url' => ['controller' => 'users', 'action' => 'login'], 'autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator']);  ?>
                <div class="form-floating mb-4 form-group">
                    <?php echo $this->Form->control('email', [
                        'id' => 'email', 'label' => false, 'type' => 'email', 'class' => 'form-control',
                        'autocomplete' => 'new-email',
                        'templates' => ['inputContainer' => '{{content}}'], 'required' => true
                    ]); ?>

                    <label for="email">Email address</label><div class="help-block with-errors"></div>
                </div><!-- end form-floating -->
                <div class="form-floating mb-4 form-group">
                    <?php echo $this->Form->control('password', [
                        'id' => 'password', 'label' => false, 'type' => 'password', 'class' => 'form-control password',
                        'autocomplete' => 'new-password',
                        'templates' => ['inputContainer' => '{{content}}'], 'required' => true
                    ]); ?>

                    <label for="password">Password</label><div class="help-block with-errors"></div>
                    <a href="password" class="password-toggle" title="Toggle show/hide pasword">
                        <em class="password-shown ni ni-eye-off"></em>
                        <em class="password-hidden ni ni-eye"></em>
                    </a>
                </div><!-- end form-floating -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="logMeIn">
                        <label class="form-check-label form-check-label-s1" for="logMeIn"> Remember me </label>
                    </div>
                    <?php echo $this->Html->link('Forgot Password','/forget-password',['class'=>'btn-link form-forget-password']);?>
                    
                </div>
                <div id="f_err"></div>
                <input type="button" class="btn btn-dark w-100" value="Login Now" id="login_sbtn" />

                <?php if ($is_fb == 1 || $is_google == 1) { ?>
                    <span class="d-block my-4">— or login with —</span>
                    <ul class="btns-group d-flex">
                        <?php if ($is_google == 1) { ?><li class="flex-grow-1"><a href="<?php echo SITEURL; ?>users/g_auth" class="btn d-block bg-red-100 text-red g-btn"><em class="ni ni-google"></em> Google</a></li><?php } ?>
                        <?php if ($is_fb == 1) { ?><li class="flex-grow-1"><a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $Setting['fb_app_id']; ?>&redirect_uri=<?php echo SITEURL; ?>users/check?facebook=true&state=<?php echo md5(uniqid(rand(), TRUE)) ?>&scope=public_profile,email" class="btn d-block bg-blue-100 text-blue f-btn"><em class="ni ni-facebook-f"></em> Facebook</a></li><?php } ?>
                    </ul>
                <?php } ?>
                <p class="mt-3 form-text">Don't have an account <a href="<?php echo SITEURL; ?>register" class="btn-link">Sign Up</a></p>
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
success: function(response) { $("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Sign In'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Sign In');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>