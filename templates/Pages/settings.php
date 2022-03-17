<?= $this->Html->css(['/app-assets/css/pages/page-blog'], ['block' => 'css']) ?>

<?php $this->assign('title', 'Portal Settings');
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Protal Settings</h2>

                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">

            </div>
        </div>
        <div class="content-body">
            <!-- Blog Edit -->
            <div class="blog-edit-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <?php
                                echo $this->Form->create($tbl_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'mt-2', 'data-toggle' => 'validator']);
                                echo $this->Form->hidden('id');
                                ?>

                                <div class="row">
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('fb_app_id', ['type'=>'text','label'=>['escape' => false, 'text'=>'Facebook App ID <small>(For FB Login)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('fb_app_secret', ['label'=>['escape' => false, 'text'=>'Facebook App Secret <small>(For FB Login)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('google_client_id', ['type'=>'text','label'=>['escape' => false, 'text'=>'Google Client ID <small>(For Google Login)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('google_client_secret', ['label'=>['escape' => false, 'text'=>'Google Client Secret <small>(For Google Login)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('email_sender', ['label'=>['escape' => false, 'text'=>'SMTP Email Sender Name <small>(For SMTP)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('email_address', ['label'=>['escape' => false, 'text'=>'Email Address <small>(For SMTP)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('email_password', ['label'=>['escape' => false, 'text'=>'Email Password <small>(For SMTP)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('email_host', ['label'=>['escape' => false, 'text'=>'Email Host Name <small>(For SMTP)</small>'],'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('whitepaper', ['label'=>['escape' => false, 'text'=>'Whitepaper Link'],'type'=>'url','class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>

                                    


                                    <div class="col-12 mt-50">
                                        <div id="f_err"></div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <input type="button" class="btn btn-primary mr-1" value="Save" id="save_frm" />
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                                </form>
                                <!--/ Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Blog Edit -->

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $("#e_frm").validator();

        $("#save_frm").click(function() {
            $("#e_frm").ajaxForm({
                target: '#f_err',
                headers: {
                    'X-CSRF-Token': $('[name="_csrfToken"]').val()
                },
                beforeSubmit: function() {
                    $("#save_frm").prop("disabled", true);
                    $("#save_frm").html('Please wait..');
                },
                success: function(response) {
                    $("#save_frm").prop("disabled", false);
                    $("#save_frm").html('Save');
                },
                error: function(response) {
                    $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                    $("#save_frm").prop("disabled", false);
                    $("#save_frm").html('Save');
                },
            }).submit();
        });
    });
</script>