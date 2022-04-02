<div id="custom-content" class="white-popup-block offer-pop" style="max-width:800px; margin: 20px auto;">
    <?php $this->assign('title', $data->meta_title . ' Application Form'); ?>
    <div class="app-contentcontent ">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Allowlist Application Form for <?php echo $data->meta_title; ?></h4>
                <button type="button" class="btn-close icon-btn" onclick="$.magnificPopup.close();" aria-label="Close">
                    <em class="ni ni-cross"></em>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title">Join the Allowlist</h4>
                <p class="fs-14 mb-3"></p>
                <p class="fs-14 mb-3">We are excited to launch our IDO on <?php echo WEBTITLE; ?>.
                    For a chance to win a allowlist spot, please fill out the form below and perform all tasks accordingly.
                    If you have any questions, please contact us!</p>
                <p class="fs-14 mb-3">Good Luck!</p>
                <h4 class="modal-title">Basic Information</h4>
                <hr>
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'homes', 'action' => 'apply_now'], 'autocomplete' => 'off',
                    'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator'
                ]);  ?>

                <div class="mb-3 form-group"><?php echo $this->Form->control('twitter', ['label' => ['text' => 'Your Twitter Handle', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                </div>
                <div class="mb-3 form-group"><?php echo $this->Form->control('telegram', ['label' => ['text' => 'Your Telegram Handle', 'class' => 'form-label'], 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                </div>

                <?php if (!empty($data->sm_accounts)) { ?>
                    <div class="col-md-12"></div>
                <hr>    
                    <div class="mb-3">
                        <h4 class="modal-title">Social Media</h4>
                        <p class="fs-14 mb-3">Please complete the social tasks below. They're optional, but provide increased chances of getting allowlisted.</p>
                    </div>

                    <div class="col-md-12"></div>
                    <br>

                    <div class="container">
                        <?php foreach ($data->sm_accounts as $sm) { ?>
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
                                    <a href="<?php echo $sm->link; ?>" target="_blank" class="btn btn-lg btn-dark wd-200"><?php echo $sm->label; ?></a>
                                </div>
                                <div class="col-sm">
                                    <a href="javascript:void(0);" class="btn btn-lg btn-outline-dark wd-150"> <em class="icon ni ni-check-circle-fill"></em> I did it </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>

                <div class="col-md-12"></div>
                <hr>
                <div class="col-lg-12 col-md-12">
                    <div class="notification-item mb-4">
                        <h5 class="mb-3">Do you agree with the <?php echo $this->Html->link('Terms and Conditions', '/page/term-and-condition', ['target' => '_blank']); ?>?</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input check-all-input" type="checkbox" id="receiveBidOffer" checked>
                            <label class="form-check-label form-check-label-s1" for="receiveBidOffer"> I accept the terms of service</label>
                        </div><!-- end form-check -->

                    </div><!-- end notification-item -->
                    <div class="notification-item">
                        <h5 class="mb-3">Do you want to receive updates from <?php echo $data->meta_title; ?></h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input check-all-input" type="checkbox" id="sendSomeoneEnfty" checked>
                            <label class="form-check-label form-check-label-s1" for="sendSomeoneEnfty"> Yes, I agree to receive updates from <?php echo $data->meta_title; ?> in the future.</label>
                        </div><!-- end form-check -->

                    </div>
                </div><!-- end col -->
                <div class="col-md-12"></div>
                <hr>
                <div id="f_err">
                    <div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>

                </div>
                <br>

                <input type="button" class="btn btn-dark d-block w-100" value="Submit your application" id="save_frm" />
                <?php echo $this->Form->end(); ?>
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
                        $("#save_frm").html('Add Team Member');
                    },
                    error: function(response) {
                        $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                        $("#save_frm").prop("disabled", false);
                        $("#save_frm").html('Add Team Member');
                    },
                }).submit();
            });
        });
    </script>

</div>