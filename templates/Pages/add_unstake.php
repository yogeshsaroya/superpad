<div id="custom-content" class="white-popup-block offer-pop" style="max-width:500px; margin: 20px auto;">
    <div class="app-contentcontent ">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">unStake</h2>
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
                                    echo $this->Form->create($post_data, ['autocomplete' => 'off', 'id' => 'e_frm', 'class' => 'mt-2', 'data-toggle' => 'validator']);
                                    echo $this->Form->hidden('id');
                                    ?>
                                    <div class="row">
                                    <div class="col-md-12 col-12 form-group mb-2"><?php echo $this->Form->control('stake_id', ['options' => $this->Data->getStake(),'default'=>'Select Stake', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                        <div class="col-md-12 col-12 form-group mb-2"><?php echo $this->Form->control('days', ['type' => 'number', 'class' => 'form-control', 'required' => true]); ?><div class="help-block with-errors"></div></div>
                                        <div class="col-md-12 col-12 form-group mb-2"><?php echo $this->Form->control('percentage', ['label'=>'Penalty', 'class' => 'form-control amt numeral-mask', 'placeholder' => '00.00', 'required' => true]); ?><div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-12 mt-50">
                                            <div id="f_err"></div>
                                        </div>

                                        <div class="col-12 mt-50">
                                            <input type="button" class="btn btn-primary mr-1" value="Save" id="save_frm" />
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
        function isNumber(evt, element) {

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (
                (charCode != 45 || $(element).val().indexOf('-') != -1) && // Check minus and only once.
                (charCode != 46 || $(element).val().indexOf('.') != -1) && // Check dot and only once.
                (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        $(document).ready(function() {
            $('.amt').keypress(function(event) {
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

</div>