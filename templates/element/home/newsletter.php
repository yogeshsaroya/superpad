<section class="subscibe-section section-space-sm <?php echo (isset($bg_color) ?  $bg_color : null); ?>">
    <div class="container">
        <div class="join-form-wrap">
            <div class="row g-gs align-items-center" id="newsletter_div">
                <?php
                echo $this->Form->create(null, ['autocomplete' => 'off', 'id' => 'ajnews']);
                echo $this->Form->end(); ?>

                <div class="col-lg-3">
                    <h3 class="form-title">Join Our Newsletter</h3>
                </div>
                <div class="col-lg-3 col-md-4">
                    <input class="form-control form-control-s1" type="text" name="name" placeholder="Enter name" id="n_name" />
                </div>
                <div class="col-lg-3 col-md-4">
                    <input class="form-control form-control-s1" type="text" name="email" placeholder="Enter email" id="n_em" />
                </div>
                <div class="col-lg-3 col-md-4">
                    <input type="button" class="btn btn-dark d-md-block" value="Subscribe Now" id="SubscribeNow" />
                </div>
            </div>
            <div class="join-form-wrap">
            <br><br>
            <div class="row g-gs align-items-center">
            
                <div id="news_err"></div>
            </div></div>
        </div>
    </div>
</section>


<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>

$(document).ready(function() {

function validateEmail(emailField){
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,9})$/;

return reg.test(emailField);



}
function s(){
$("#SubscribeNow").prop("disabled",false); $("#SubscribeNow").val('Subscribe Now');
}
$( "#SubscribeNow" ).click(function() {
$("#news_err").html('');
var name = $.trim( $("#n_name").val() );
var email = $.trim( $("#n_em").val() );

if(name == ''){ $("#news_err").html("<div class='alert alert-danger'>Pleae enter name.</div>"); }
else if(email == ''){ $("#news_err").html("<div class='alert alert-danger'>Pleae enter email address.</div>"); }
else if(!validateEmail(email) ){ $("#news_err").html("<div class='alert alert-danger'>Pleae enter valid email address.</div>"); }
else{
$("#SubscribeNow").prop("disabled",true); $("#SubscribeNow").val('Please wait.....');
$.ajax({type: 'POST',
url: '<?php echo SITEURL; ?>homes/aj_sub/',
headers : {'X-CSRF-Token': $('[name="_csrfToken"]').val()},
data: {name:name,email:email},
success: function(data) { s(); $("#news_err").html(data); },
error: function(comment) { s(); $("#news_err").html(comment); }});
}




});
});
<?php $this->Html->scriptEnd(); ?>