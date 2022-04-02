<?php
$this->assign('title', 'Know Your Customer');
echo $this->element('profile/header', ['bg_color' => 'bg-gray']); ?>
<style>
    .choices__inner {
        background-color: #fff;
        color: #000;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        border-color: rgba(65, 80, 118, 0.2);
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        color: #1c2b46;
    }
</style>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
            <?php echo $this->element('profile/menu', ['menu_act' => 'kyc']);

            //ec($user_data->kyc_completed); ec($user_data->kyc_approved); die;
            ?>
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>KYC <small>(Know Your Customer)</small> </h3>
                </div><!-- end user-panel-title-box -->
                <div class="profile-setting-panel-wrap">
                    <div class="profile-setting-panel">
                    <h5 class="mb-4">KYC <small>(Know Your Customer)</small> </h5>
                            <hr>
                        <?php 
                        if ($user_data->kyc_completed == 3) {
                            echo '<div class="alert alert-danger"><h4 class="alert-heading"> Rejected </h4>
                            <p>Your KYC attempt has been rejected. Please try again.</p>
                            <hr>
                            <p><b>Note:</b> '.$user_data->kyc_reject_reason.'<p>
                            </div>';
                        }
                        if ($user_data->kyc_completed == 2) {
                            echo '<div class="alert alert-success alert-dismissible fade show"><h4 class="alert-heading"> Verified </h4><hr>
                            <p>Your identity has been verified.</p></div>';
                        } elseif ($user_data->kyc_completed == 1) {
                            echo '<div class="alert alert-info alert-dismissible fade show"><h4 class="alert-heading"> KYC under review</h4><hr>
                            <p>We are reviewing your submitted KYC details. We will notify you when the review is complete. You can try out our products until then</p></div>';
                        } else {
                            
                        ?>

                            <?php echo $this->Form->create($user_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator']);
                            echo $this->Form->hidden('id');
                            ?>
                            
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
                                    <p class="file-name mb-4" id="file-name3">PNG, JPG and JPEG.</p>
                                    <?php echo $this->Form->file('kyc_user_pic1', ['label' => false, 'required' => true, 'id' => 'file-upload', 'class' => 'file-upload-input', 'data-target' => 'file-name3', 'hidden' => true]) ?>
                                    <label for="file-upload" class="input-label btn btn-dark">Choose File</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_full_name', ['label' => ['text' => 'Full Name', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_dob', ['label' => ['text' => 'Date of Birth', 'class' => 'form-label'], 'type' => 'date', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_address', ['label' => ['text' => 'Address', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_address_other', ['label' => ['text' => 'Address 2', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => false]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_city', ['label' => ['text' => 'City', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_state', ['label' => ['text' => 'State', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('kyc_zip', ['label' => ['text' => 'Zip Code', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group"><?php echo $this->Form->control('country_id', ['options' => $this->Data->getCountries(), 'autocomplete' => 'new-country_id', 'empty' => 'Select Country', 'label' => ['text' => 'Country Name', 'class' => 'form-label'], 'type' => 'select', 'class' => 'form-control form-control-s1 form-choice', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>

                            </div><!-- end row -->

                            <div class="row mt-4">
                                <div class="col-lg-12 mb-3 form-group"><?php echo $this->Form->control('kyc_doc_type', ['options' => getDocType(), 'empty' => 'Select Document Type', 'label' => ['text' => 'Document', 'class' => 'form-label'], 'type' => 'select', 'class' => 'form-control form-control-s1 form-choice', 'required' => true]); ?><div class="help-block with-errors"></div>
                                </div>
                                <div class="col-lg-6 mb-3 form-group">
                                    <h5 class="mb-3">Document Front Page Photo</h5>
                                    <div class="file-upload-wrap">
                                        <p class="file-name mb-4" id="file-name2">PNG, JPG and JPEG.</p>
                                        <?php echo $this->Form->file('kyc_doc_file1', ['label' => false, 'required' => true, 'id' => 'front_pic', 'class' => 'file-upload-input', 'data-target' => 'file-name2', 'hidden' => true]) ?>
                                        <label for="front_pic" class="input-label btn btn-dark">Choose File</label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3 form-group">
                                    <h5 class="mb-3">Document Back Page Photo</h5>
                                    <div class="file-upload-wrap">
                                        <p class="file-name mb-4" id="file-name1">PNG, JPG and JPEG.</p>
                                        <?php echo $this->Form->file('kyc_doc_file_back1', ['label' => false, 'required' => true, 'id' => 'end_pic', 'class' => 'file-upload-input', 'data-target' => 'file-name1', 'hidden' => true]) ?>
                                        <label for="end_pic" class="input-label btn btn-dark">Choose File</label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div id="f_err"></div>
                            </div>
                            <input class="btn btn-dark mt-3" type="button" id="reg_sbtn" value="Update KYC" />
                        <?php } ?>
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
success: function(response) { $("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Update KYC'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#reg_sbtn").prop("disabled",false); $("#reg_sbtn").val('Update KYC');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>