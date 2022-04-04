<div id="custom-content" class="white-popup-block offer-pop" style="max-width:800px; margin: 20px auto;">
<style>
    .sm_follow{
    border-radius: 0.25em;

    padding: 10px;
    margin: 16px 0 0 0;
}
.sm_chk .help-block.with-errors {
    margin-left: 18px !important;
}
</style>
    <div class="app-contentcontent ">
        <div class="modal-content">
            <?php if (!empty($data)) { ?>
                <?php $this->assign('title', $data->meta_title . ' Application Form'); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Whitelist Application Form for <?php echo $data->meta_title; ?></h4>
                    <button type="button" class="btn-close icon-btn" onclick="$.magnificPopup.close();" aria-label="Close">
                        <em class="ni ni-cross"></em>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="fs-14 mb-3"></p>

                    <h4 class="modal-title">Basic Information</h4>
                    <hr>
                    <?php echo $this->Form->create(null, ['url' => ['controller' => 'homes', 'action' => 'apply_now'], 'autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'auth-login-form mt-2', 'data-toggle' => 'validator']);
                    echo $this->Form->hidden('id');
                    echo $this->Form->hidden('project_id', ['value' => $id]);
                    ?>

                    <div class="mb-3 form-group"><?php echo $this->Form->control('twitter', ['label' => ['text' => 'Your Twitter Handle', 'class' => 'form-label'], 'placeholder' => '@handle name', 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                    </div>
                    <div class="mb-3 form-group"><?php echo $this->Form->control('telegram', ['label' => ['text' => 'Your Telegram Handle', 'class' => 'form-label'], 'placeholder' => '@handle name', 'type' => 'text', 'class' => 'form-control form-control-s1', 'required' => true]); ?><div class="help-block with-errors"></div>
                    </div>

                    <?php if (!empty($data->sm_accounts)) { ?>
                        <div class="col-md-12"></div>
                        <hr>
                        <div class="mb-3">
                            <h4 class="modal-title">Social Media</h4>
                            <p class="fs-14 mb-3">Please complete the social tasks below.</p>
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
                                        <a href="<?php echo $sm->link; ?>" target="_blank" class="btn btn-lg btn-dark wd-200" id="ac_<?php echo $sm->id; ?>"><?php echo $sm->label; ?></a>
                                    </div>
                                    <div class="col-sm sm_chk">
                                        <div class="form-check mb-2 form-group">
                                            <?php echo $this->Form->checkbox('follow.', ['id' => 'agree', 'hiddenField' => true,'div'=>['class'=>'btn btn-primary w-100 bg-transparent'], 'value' => 1, 'class' => 'form-check-input check-all-input sm_follow', 'required' => true, 'checked' => false]); ?> 
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <?php /* ?>
                                        <a href="javascript:void(0);" class="btn btn-lg btn-outline-dark wd-150 hide" onclick="did(<?php echo $sm->id; ?>)" id="did_<?php echo $sm->id; ?>"> I did it </a>
                                        <?php */ ?>
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
                            <div class="form-check mb-2 form-group">
                                <?php
                                echo $this->Form->label('agree', ' I accept the terms of service', ['class' => 'form-check-label form-check-label-s1']);
                                echo $this->Form->checkbox('agree', ['id' => 'agree', 'hiddenField' => true, 'value' => 1, 'class' => 'form-check-input check-all-input', 'required' => true, 'checked' => false]);
                                ?>
                                <div class="help-block with-errors"></div>
                            </div><!-- end form-check -->

                        </div><!-- end notification-item -->
                        <div class="notification-item">
                            <h5 class="mb-3">Do you want to receive updates from <?php echo $data->meta_title; ?></h5>
                            <div class="form-check mb-2 form-group">
                                <?php
                                echo $this->Form->label('subscribe', 'Yes, I agree to receive updates from ' . $data->meta_title . ' in the future.', ['class' => 'form-check-label form-check-label-s1']);
                                echo $this->Form->checkbox('subscribe', ['id' => 'subscribe', 'hiddenField' => true, 'value' => 1, 'class' => 'form-check-input check-all-input', 'required' => false, 'checked' => false]);
                                ?>
                                <div class="help-block with-errors"></div>
                            </div><!-- end form-check -->

                        </div>
                    </div><!-- end col -->
                    <div class="col-md-12"></div>
                    <hr>
                    <div id="f_err"></div>
                    <br>

                    <input type="button" class="btn btn-dark d-block w-100" value="Submit your application" id="save_frm" />
                    <?php echo $this->Form->end(); ?>
                </div>
        </div>
        <script>
            function did(id) {
                $("#ac_" + id).removeClass('btn btn-lg btn-dark').addClass("btn btn-lg btn-outline-dark");
                $("#did_" + id).html('<em class="icon ni ni-check-circle-fill"></em>');

            }
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
        <?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>

        <?php $this->Html->scriptEnd(); ?>
    <?php } else { ?>
        <div class="modal-header">
            <h4 class="modal-title">Application Not Found</h4>
            <button type="button" class="btn-close icon-btn" onclick="$.magnificPopup.close();" aria-label="Close">
                <em class="ni ni-cross"></em>
            </button>
        </div>
        <div class="modal-body">

            <div class="alert alert-danger d-flex mb-4" role="alert">
                <svg class="flex-shrink-0 me-3" width="30" height="30" viewBox="0 0 24 24" fill="#ff6a8e">
                    <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"></path>
                </svg>
                <p class="fs-14">Application Not Found. Please try again later</p>
            </div>
        </div>
    <?php } ?>
    </div>

</div>