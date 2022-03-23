

<?php $this->assign('title', 'Manage Roadmap');
$getStatus = getStatus();
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
                        <h2 class="content-header-title float-left mb-0">Roadmap</h2>

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
                                $file_req = true;
                                if (isset($get_data->id) && !empty($get_data->id)) {
                                    $file_req = false;
                                }
                                echo $this->Form->hidden('id');
                                ?>

                                <div class="row">
                                    <div class="col-md-6 col-12 form-group mb-2"><?php echo $this->Form->control('date', ['class' => 'form-control date-mask','placeholder'=>'YYYY-MM-DD','required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-6 col-12 form-group mb-2"><?php echo $this->Form->control('title', ['class' => 'form-control','required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-6 col-12 form-group mb-2"><?php echo $this->Form->control('status', ['options' => $getStatus,'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    <div class="col-md-12 col-12 form-group mb-2"><?php echo $this->Form->control('description', ['type'=>'textarea','rows'=>4, 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                    

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
echo $this->Html->script(['/app-assets/vendors/js/forms/cleave/cleave.min', '/app-assets/js/scripts/forms/form-input-mask'],
    //['block' => 'scriptBottom']
);?>
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
</script>