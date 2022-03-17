<?= $this->Html->css([
    '/app-assets/css/pages/page-blog',
    '/app-assets/vendors/css/forms/select/select2.min'
], ['block' => 'css']) ?>

<?php $this->assign('title', 'Manage Consultant');?>
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Consultant</h2>

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
                                echo $this->Form->create($blog_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'mt-2', 'data-toggle' => 'validator']);
                                $file_req = true;
                                if (isset($blog_data->id) && !empty($blog_data->id)) {
                                    $file_req = false;
                                }
                                echo $this->Form->hidden('id');
                                ?>

                                <div class="row">
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('name', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('title', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('phone', ['label'=>'Fixed Line','type'=>'tel','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('email', ['type'=>'email','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('contact', ['label'=>'WhatsApp','type'=>'text','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('skype', ['label'=>'Wechat','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('facebook', ['type'=>'url','class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('twitter', ['type'=>'url','class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-4 col-12 form-group mb-2"><?php echo $this->Form->control('linkedin', ['type'=>'url', 'class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                    
                                    <div class="col-12 form-group mb-2"><?php echo $this->Form->control('about', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-12 form-group mb-2"><?php echo $this->Form->control('biography', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-12 form-group mb-2"><?php echo $this->Form->control('experience', ['type'=>'textarea','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                    </div>
                                    
                                    
                                    <div class="col-12 mb-2 form-group">
                                        <h4 class="mb-1">Consultant Image</h4>
                                        <?php echo $this->Form->file('img', ['label' => 'Hero Image', 'required' => $file_req]) ?>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <div id="f_err"></div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <input type="button" class="btn btn-primary mr-1" value="Save Changes" id="save_frm" />
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
<!-- END: Content-->
<?php
echo $this->Html->script(
    [
        '/app-assets/vendors/js/forms/select/select2.full.min',
        '//cdn.ckeditor.com/4.16.2/standard/ckeditor.js'
    ],
    //['block' => 'scriptBottom']
);
?>

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
                    $("#save_frm").html('Save Changes');
                },
                error: function(response) {
                    $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                    $("#save_frm").prop("disabled", false);
                    $("#save_frm").html('Save Changes');
                },
            }).submit();
        });
    });

    (function(window, document, $) {
        'use strict';


        var $ckfield1 = CKEDITOR.replace('experience');
        $ckfield1.config.height = 200;
        $ckfield1.on('change', function() {
            $ckfield1.updateElement();
        });

    })(window, document, jQuery);
</script>