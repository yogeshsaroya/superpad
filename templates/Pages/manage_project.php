<?php 
$getStatus = getStatus();
$type = getProjectType();
$status = getProjectStatus();
$this->assign('title', 'Manage Projects'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>app-assets/css/plugins/forms/pickers/form-pickadate.css">

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Projects</h2>
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
                                echo $this->Form->create($get_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'mt-2', 'data-toggle' => 'validator']);
                                echo $this->Form->hidden('id');
                                $file_req = true;
                                if (isset($get_data->id) && !empty($get_data->id)) {
                                    $file_req = false;
                                }
                                ?>

                                <div class="row">
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('title', ['label'=>['escape' => false, 'text'=>'Title <small>(unique project title)</small>'],'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('heading', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('type', ['options' => $type,'empty'=>'Select Type', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('ticker', ['label'=>['escape' => false, 'text'=>'Tiker <small>(unique tiker name)</small>'],'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('product_status', ['options' => $status, 'empty'=>'Select Status','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('blockchain_id', ['options' => $this->Data->getBlockchains('list'),'empty'=>'Select Blockchain Network','class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>

                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('total_raise', ['class' => 'form-control amt','placeholder'=>'00.00', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('ticket_allocation', ['class' => 'form-control amt','placeholder'=>'00.00', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('price_per_token', ['label'=>['escape' => false, 'text'=>'Sale Price <small>(Price per token)</small>'],'class' => 'form-control amt','placeholder'=>'00.00', 'required' => true]); ?><div class="help-block with-errors"></div></div>

                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('start_date', ['label'=>['escape' => false, 'text'=>'Sale Start Time'],'class' => 'form-control flatpickr-date-time','placeholder'=>'YYY-MM-DD HH:MM','required' => false]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('end_date', ['label'=>['escape' => false, 'text'=>'Sale End Time'],'class' => 'form-control flatpickr-date-time','placeholder'=>'YYY-MM-DD HH:MM', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('token_distribution_date', ['label'=>['escape' => false, 'text'=>'Token Distribution Time'],'class' => 'form-control flatpickr-date-time','placeholder'=>'YYY-MM-DD HH:MM','required' => false]); ?><div class="help-block with-errors"></div></div>
                                    
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('initial_market_cap', ['class' => 'form-control amt','placeholder'=>'00.00','required' => false]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('initial_token_circulation', ['class' => 'form-control', 'required' => false]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-3 col-12 form-group mb-2"><?php echo $this->Form->control('status', ['options' => $getStatus,'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    

                                </div>
                                <hr><br>
                                    <div class="row">
                                    <div class="col-4 form-group"><h4 class="mb-1">Logo <small>(Image size should be 400x400px or 200x200px or 1:1 aspect ratio)</small></h4>
                                        <?php echo $this->Form->file('logo_img', ['label' => 'Logo', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-4 form-group"><h4 class="mb-1">Hero Image <small>(image size should be 500×375px or 4:3 aspect ratio)</small></h4>
                                        <?php echo $this->Form->file('hero_img', ['label' => 'Hero Image', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-4 form-group"><h4 class="mb-1">Banner Image <small>(image size should be 1080*360 or 1024x768px or 16:9 aspect ratio)</small></h4>
                                        <?php echo $this->Form->file('banner_img', ['label' => 'Banner Image', 'required' => $file_req]) ?><div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <hr><br>
                                    <div class="row">
                                    <div class="col-md-12 col-12 form-group mb-2">
                                            <?php echo $this->Form->control('description', ['id' => 'editor', 'type' => 'textarea', 'class' => 'form-control', 'required' => true]); ?>
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

<?php
    

echo $this->Html->script([
    "/app-assets/vendors/js/pickers/pickadate/picker.js",
    "/app-assets/vendors/js/pickers/pickadate/picker.date.js",
    "/app-assets/vendors/js/pickers/pickadate/picker.time.js",
    "/app-assets/vendors/js/pickers/pickadate/legacy.js",
    '/app-assets/vendors/js/pickers/flatpickr/flatpickr.min', '/app-assets/js/scripts/forms/pickers/form-pickers'],
    //['block' => 'scriptBottom'] 
);
echo $this->Html->script(
    ['//cdn.ckeditor.com/4.16.2/standard/ckeditor.js'],
    //['block' => 'scriptBottom']
);
?>

<script>
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // Check minus and only once.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // Check dot and only once.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    

    $(document).ready(function() {
        $('.amt').keypress(function (event) {
            return isNumber(event, this)
        });

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


        var $ckfield1 = CKEDITOR.replace('editor');
        $ckfield1.config.height = 300;
        $ckfield1.on('change', function() {
            $ckfield1.updateElement();
        });


        var select = $('.select2');

        // Basic Select2 select
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });

    })(window, document, jQuery);
</script>