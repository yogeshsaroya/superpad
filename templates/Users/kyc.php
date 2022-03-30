<?php
$this->assign('title', 'Dashboard');
echo $this->element('profile/header', ['bg_color' => 'bg-gray']); ?>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
            <?php echo $this->element('profile/menu', ['menu_act' => 'kyc']); ?>
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>KYC <small>(Know Your Customer)</small> </h3>
                </div><!-- end user-panel-title-box -->
                <div class="profile-setting-panel-wrap">
                    <div class="profile-setting-panel">
                        <?php echo $this->Form->create($user_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator']);
                        echo $this->Form->hidden('id');
                        ?>
                        <h5 class="mb-4">KYC <small>(Know Your Customer)</small> </h5>
                        <hr>
                        <div class="form-item mb-4 form-group">
                                <h5 class="mb-3">Upload Your Latest Photo</h5>
                                <small class="text-danger">
                                    <ul>
                                    <li>It should have full face, front view, eyes open. </li>
                                    <li>Photo should present full head from top of hair to bottom of chin. </li>
                                    <li>Center head within frame. </li>
                                    </ul>
                                    </small>
                                <div class="file-upload-wrap">
                                    <p class="pro_pic mb-4" id="pro_pic">PNG, JPG and JPEG.</p>
                                    <?php echo $this->Form->file('kyc_user_pic', ['label' => false, 'required' => true,
                                    'id'=>'file-upload','class'=>'file-upload-input','data-target'=>'pro_pic','hidden'=>true]) ?>
                                    <label for="file-upload" class="input-label btn btn-dark">Choose File</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_full_name', ['label' => ['text' => 'Full Name', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_dob', ['label' => ['text' => 'Date of Birth', 'class' => 'form-label'], 'type' => 'date', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_phone', ['label' => ['text' => 'Phone Number', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_address', ['label' => ['text' => 'Address', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_address_other', ['label' => ['text' => 'Address 2', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_city', ['label' => ['text' => 'City', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_state', ['label' => ['text' => 'State', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>

                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_zip', ['label' => ['text' => 'Zip Code', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_country', ['label' => ['text' => 'Country Name', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div></div>

                            <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_doc_type', ['options'=>getDocType(),'empty'=>'Select Document Type', 'label' => ['text'=>'Document','class' => 'form-label'], 'type' => 'select', 'class' => 'form-control form-control-s1 form-choice', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                        </div><!-- end row -->
                        
                        <div class="row mt-4">

                        <div class="form-item mb-4 form-group">
                                <h5 class="mb-3">Upload Your Latest Photo</h5>
                                <small class="text-danger">
                                    <ul>
                                    <li>It should have full face, front view, eyes open. </li>
                                    <li>Photo should present full head from top of hair to bottom of chin. </li>
                                    <li>Center head within frame. </li>
                                    </ul>
                                    </small>
                                <div class="file-upload-wrap">
                                    <p class="pro_pic mb-4" id="pro_pic">PNG, JPG and JPEG.</p>
                                    <?php echo $this->Form->file('kyc_user_pic', ['label' => false, 'required' => true,
                                    'id'=>'file-upload','class'=>'file-upload-input','data-target'=>'pro_pic','hidden'=>true]) ?>
                                    <label for="file-upload" class="input-label btn btn-dark">Choose File</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                        </div>



                            <div class="col-lg-6 mb-3 form-group">
                                    <h5 class="mb-3">Document Front Page Photo</h5>
                                    <div class="file-upload-wrap">
                                        <p class="file-name mb-4" id="file-name">PNG, JPG and JPEG.</p>
                                        <input id="file-upload" class="file-upload-input" data-target="file-name" type="file" hidden required>
                                        <label for="file-upload" class="input-label btn btn-dark">Choose File</label>
                                    </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                    <h5 class="mb-3">Document Back Page Photo</h5>
                                    <div class="file-upload-wrap">
                                        <p class="file-name mb-4" id="file-name">PNG, JPG and JPEG.</p>
                                        <input id="file-upload" class="file-upload-input" data-target="file-name" type="file" hidden required>
                                        <label for="file-upload" class="input-label btn btn-dark">Choose File</label>
                                    </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="f_err"></div>
                        </div>

                        <input class="btn btn-dark mt-3" type="button" id="reg_sbtn" value="Update KYC" />
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