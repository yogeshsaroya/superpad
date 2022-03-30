<?php
$this->assign('title', 'Dashboard');
echo $this->element('profile/header', ['bg_color' => 'bg-gray']); ?>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
        <?php echo $this->element('profile/menu', ['menu_act' => 'profile']); ?>
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>Account Settings</h3>
                </div><!-- end user-panel-title-box -->
                <div class="profile-setting-panel-wrap">
                    <div class="profile-setting-panel">
                        <?php echo $this->Form->create($user_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator']);  
                        echo $this->Form->hidden('id');
                        ?>
                        <h5 class="mb-4">Edit Profile</h5>
                        <div class="row mt-4">
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('first_name', ['label' => ['class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1','required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('last_name', ['label' => ['class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1','required' => true]); ?><div class="help-block with-errors"></div></div>
                        </div><!-- end row -->
                        <div class="mb-3 form-group"><?php echo $this->Form->control('email', ['label' => ['class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1','required' => true]); ?><div class="help-block with-errors"></div></div>
                        <div class="mb-3 form-group"><?php echo $this->Form->control('password1', ['label' => ['escape' => false,'text'=>'Password <small>(Leave blank if do not want to change password)</small>', 'class' => 'form-label'], 
                        'autocomplete' => 'new-password','type' => 'password', 'class' => 'form-control form-control-s1','required' => false]); ?><div class="help-block with-errors"></div></div>
                        
                        <div class="mb-3">
                        <div id="f_err"></div>
                        </div>

                        <input class="btn btn-dark mt-3" type="button" id="reg_sbtn" value="Update Profile" />
                    </div><!-- end tab-content -->
                </div><!-- end profile-setting-panel-wrap-->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end profile-section -->




<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){


$("#e_frm").validator();

$( "#reg_sbtn" ).click(function() {
$("#e_frm").ajaxForm({
target: '#f_err',
headers : { 'X-CSRF-Token': $('[name="_csrfToken"]').val() },
beforeSubmit:function(){ console.log('clicked'); $("#reg_sbtn").prop("disabled",true); $("#reg_sbtn").val('Please wait..'); },
success: function(response) { $("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Create an Account'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Create an Account');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>