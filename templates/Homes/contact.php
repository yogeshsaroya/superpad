<?php $this->assign('title', 'Contact US'); ?>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">How can we help?</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div><!-- hero-content -->
    </div><!-- .container-->
</div><!-- end hero-wrap -->


<section class="contact-section section-space-b">
    <div class="container">
        <div class="row section-space-b">
            <div class="col-lg-12">
                <div class="contact-form-wrap mb-5 mb-lg-0">
                    <div class="section-head-sm">
                        <h2 class="mb-2">Contact Us</h2>
                        <p>Have a question? Need help? Don't hesitate, drop us a line</p>
                    </div>
                    <?php
                    echo $this->Form->create(null, ['autocomplete' => 'off', 'id' => 'e_frm']);

                    ?>
                    <div class="row g-gs">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="full_name" placeholder="Name">
                                <label for="floatingInputName">Your name *</label>
                            </div><!-- end form-floating -->
                        </div><!-- end col -->
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                                <label for="floatingInputEmail">Email address *</label>
                            </div><!-- end form-floating -->
                        </div><!-- end col -->
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="sujbect" placeholder="Subject">
                                <label for="floatingInputPhoneNumber">Subject *</label>
                            </div><!-- end form-floating -->
                        </div><!-- end col -->
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" name="msg"></textarea>
                                <label for="floatingTextarea">Type message here...</label>
                            </div><!-- end form-floating -->
                        </div><!-- end col -->
                        <div class="col-lg-12">

                            <div id="f_err"></div>
                        </div>
                        <div class="col-lg-12">
                            <input class="btn btn-dark" type="button" value="Send Message" id="login_sbtn"/>
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <?php echo $this->Form->end(); ?>
                </div><!-- end card -->
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end contact-section -->



<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
$(document).ready(function(){


$( "#login_sbtn" ).click(function() {
$("#e_frm").ajaxForm({
target: '#f_err',
headers : {
'X-CSRF-Token': $('[name="_csrfToken"]').val()
},
beforeSubmit:function(){ $("#login_sbtn").prop("disabled",true); $("#login_sbtn").val('Please wait..'); },
success: function(response) { $("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Sign In'); },
error : function(response) {
$('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
$("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Sign In');
},
}).submit();
});
});
<?php $this->Html->scriptEnd(); ?>

<?php /* $this->Html->scriptStart(array('block' => 'scriptBottom'));
?>

    $(function() {
        $("#login_sbtn").click(function(e) {
            var form = $('#e_frm');
            
                e.preventDefault();
                var formData = $(form).serialize();
                console.log(formData);
                $("#login_sbtn").prop("disabled",true); $("#login_sbtn").val('Please wait..');
                $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-Token': $('[name="_csrfToken"]').val()
                        },
                        url: $(form).attr('action'),
                        data: formData
                    })
                    .done(function(response) {
                        $("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Send Message'); 
                        $('#e_frm input,#e_frm textarea').val('');
                    })
                    .fail(function(data) {
                        $("#login_sbtn").prop("disabled",false); $("#login_sbtn").val('Send Message'); 
                    });
            
        });
    });

<?php $this->Html->scriptEnd(); */
?>