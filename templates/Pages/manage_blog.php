<?= $this->Html->css([
    '/app-assets/css/pages/page-blog',
    '/app-assets/vendors/css/forms/select/select2.min'
], ['block' => 'css']) ?>

<?php $this->assign('title', 'Manage Blogs');
$blog_type = blog_type();
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
                        <h2 class="content-header-title float-left mb-0">Blog Edit</h2>

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


                                if (isset($blog_data->tags) && !empty($blog_data->tags)) {
                                    $blog_data->tags = explode(',', $blog_data->tags);
                                }
                                echo $this->Form->hidden('id');
                                ?>

                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mb-2"><?php echo $this->Form->control('title', ['class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2"><?php echo $this->Form->control('tags', ['options' => $this->Data->blog_tags(), 'multiple' => true, 'class' => 'form-control select2']); ?><div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <?php echo $this->Form->control('description', ['id' => 'editor','type'=>'textarea', 'class' => 'form-control','required' => true]); ?>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2 form-group">
                                        <h4 class="mb-1">Featured Image</h4>
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


var $ckfield1 = CKEDITOR.replace( 'editor' );
$ckfield1.config.height = 300;
$ckfield1.on('change', function() { $ckfield1.updateElement(); });


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