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
                        <div class="card2">
                            <div class="card-body2">

                                <?php
                                echo $this->Form->create($tbl_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'mt-2', 'data-toggle' => 'validator']);
                                echo $this->Form->hidden('id');
                                $file_req = true;
                                if (isset($tbl_data->id) && !empty($tbl_data->id)) {
                                    $file_req = false;
                                }
                                ?>

                                <section><div class="row"><div class="col-md-12"><div class="card">
                                <div class="card-header"><h4 class="card-title">Basic Details</h4></div><div class="card-body">
                                <div class="row">
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('heading', ['label' => ['escape' => false, 'text' => 'Heading'], 'type' => 'text', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('sub_heading', ['label' => ['escape' => false, 'text' => 'Sub Heading'], 'type' => 'text', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('meta_title', ['type' => 'text', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('meta_description', ['type' => 'text', 'class' => 'form-control', 'required' => false  ]); ?><div class="help-block with-errors"></div></div>
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('whitepaper', ['label' => ['escape' => false, 'text' => 'Whitepaper Link'], 'type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>

                            </div></div></div></div></div></section>

                                <section><div class="row"><div class="col-md-12"><div class="card">
                                <div class="card-header"><h4 class="card-title">Social Media Accounts</h4></div><div class="card-body">
                                <div class="row">
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('twitter', ['label' => ['escape' => false, 'text' => 'Twitter Link'], 'type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('telegram', ['label' => ['escape' => false, 'text' => 'Telegram Link'], 'type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('discord', ['label' => ['escape' => false, 'text' => 'Telegram Announcement Link'], 'type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('medium', ['label' => ['escape' => false, 'text' => 'Medium Link'], 'type' => 'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>

                                </div></div></div></div></div></section>

                                <section><div class="row"><div class="col-md-12"><div class="card">
                                <div class="card-header"><h4 class="card-title">SMTP Details</h4></div><div class="card-body">
                                <div class="row">
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('email_sender', ['label' => ['escape' => false, 'text' => 'SMTP Email Sender Name <small>(For SMTP)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('email_address', ['label' => ['escape' => false, 'text' => 'Email Address <small>(For SMTP)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('email_password', ['label' => ['escape' => false, 'text' => 'Email Password <small>(For SMTP)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('email_host', ['label' => ['escape' => false, 'text' => 'Email Host Name <small>(For SMTP)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                </div></div></div></div></div></section>
                                
                                <section><div class="row"><div class="col-md-12"><div class="card">
                                <div class="card-header"><h4 class="card-title">Social Media Login</h4></div><div class="card-body">
                                <div class="row">
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('fb_app_id', ['type' => 'text', 'label' => ['escape' => false, 'text' => 'Facebook App ID <small>(For FB Login)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('fb_app_secret', ['label' => ['escape' => false, 'text' => 'Facebook App Secret <small>(For FB Login)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('google_client_id', ['type' => 'text', 'label' => ['escape' => false, 'text' => 'Google Client ID <small>(For Google Login)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('google_client_secret', ['label' => ['escape' => false, 'text' => 'Google Client Secret <small>(For Google Login)</small>'], 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                </div></div></div></div></div></section>

                                <section><div class="row"><div class="col-md-12"><div class="card">
                                <div class="card-header"><h4 class="card-title">reCaptcha</h4></div><div class="card-body">
                                <div class="row">
                                <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('recaptcha_site_key', ['type' => 'text', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('recaptcha_secret_key', ['class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div>
                                    </div>
                                </div></div></div></div></div></section>
                                
                                
                                <section><div class="row"><div class="col-md-12"><div class="card">
                                <div class="card-header"><h4 class="card-title">Other Details</h4></div><div class="card-body">
                                <div class="row">
                                <div class="col-4 mb-2 form-group">
                                        <h4 class="mb-1">Website Logo <small>(164x60 px or 500x195 px)</small></h4>
                                        <?php echo $this->Form->file('logo_img', ['label' => 'Website Logo', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                    </div>
                                </div></div></div></div></div></section>


                                <section><div class="row"><div class="col-md-12"><div class="card">
                                
                                <div class="card-body">
                                <div class="row">
                                <div class="col-12 mt-50">
                                        <div id="f_err"></div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <input type="button" class="btn btn-primary mr-1" value="Save" id="save_frm" />
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div></div></div></div></div></section>


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