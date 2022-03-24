<?php $this->assign('title', 'Contact US'); ?>
<!-- Start page content -->
<section id="page-content" class="page-wrapper">

    <!-- CONTACT AREA START -->
    <div class="contact-area pt-115 pb-115">
<!-- BREADCRUMBS AREA START -->
<?php echo $this->element('breadcrumbs', ['ele_data' => ['contact-us'=>'CONTACT'] ]); ?>        
<!-- BREADCRUMBS AREA END -->
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-12">
                    <!-- get-in-toch -->
                    <div class="get-in-toch">
                        <div class="section-title mb-30">
                            <h3>GET IN</h3>
                            <h2>TOUCH</h2>
                        </div>
                        <div class="contact-desc mb-50">
                            <p><span data-placement="top" data-toggle="tooltip" data-original-title="The name you can trust" class="tooltip-content">Sheltek</span> is the best theme for elit, sed do
                                eiusmod tempor dolor sit ame tse ctetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et lorna aliquatd minim veniam, quis nostrud exercitation
                                oris nisi ut aliquip</p>
                        </div>
                        <ul class="contact-address">
                            <li>
                                <div class="contact-address-icon">
                                    <img src="images/icons/location-2.png" alt="">
                                </div>
                                <div class="contact-address-info">
                                    <span>8901 Marmora Raod, New Yourk City </span>
                                    <span>25 Glasgow, D04 89GR</span>
                                </div>
                            </li>
                            <li>
                                <div class="contact-address-icon">
                                    <img src="images/icons/phone-3.png" alt="">
                                </div>
                                <div class="contact-address-info">
                                <span><a href="javascript:void(0);" class="show_info" data-tel="Telephone : +0 123-456-7890">Telephone : +0 123-456-XXXX</a></span>
                                <span><a href="javascript:void(0);" class="show_info" data-tel="Telephone : +0 123-456-7890">Telephone : +0 123-456-XXXX</a></span>
                                </div>
                            </li>
                            <li>
                                <div class="contact-address-icon">
                                    <img src="images/icons/world.png" alt="">
                                </div>
                                <div class="contact-address-info">
                                    <span class="show_info" data-tel="Email : info@domain.com">Email : xxxx@domain.com</span>
                                    <span>Web :<a href="#" target="_blank"> www.yoursite.com</a></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="contact-messge contact-bg">
                        <!-- blog-details-reply -->
                        <div class="leave-review">
                            <h5>Leave a Message</h5>
                            <form id="contact-form" action="homes/aj_frm/cotnact" method="post">
          <?php 
       echo $this->Form->create(null,['autocomplete'=>'off','id'=>'contact-form']); 
       
       ?>                             
                                <input type="text" name="name" placeholder="Your name">
                                <input type="email" name="email" placeholder="Email">
                                <textarea name="message" placeholder="Write here"></textarea>
                                <button type="submit" class="submit-btn-1">SUBMIT</button>
                            <?php echo $this->Form->end();?>
                            <p class="form-messege mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT AREA END -->

    <!-- GOOGLE MAP AREA START -->
    <div class="google-map-area">
        <div id="googleMap"></div>
    </div>
    <!-- GOOGLE MAP AREA END -->

    
</section>
<!-- End page content -->

<!-- Google Map js -->
<?php
$this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyDTJOmKkNe8xa0t4bM3itOAH7-izeI_2hc', array('block' => 'scriptBottom'));
$this->Html->script('google-map', array('block' => 'scriptBottom'));
?>

<?php $this->Html->scriptStart(array('block' => 'scriptBottom'));?>
$(function() {

// Get the form.
var form = $('#contact-form');

// Get the messages div.
var formMessages = $('.form-messege');

// Set up an event listener for the contact form.
$(form).submit(function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        headers : {
            'X-CSRF-Token': $('[name="_csrfToken"]').val()
         },
        url: $(form).attr('action'),
        data: formData
    })
    .done(function(response) {
        // Make sure that the formMessages div has the 'success' class.
        $(formMessages).removeClass('error');
        $(formMessages).addClass('success');

        // Set the message text.
        $(formMessages).text(response);

        // Clear the form.
        $('#contact-form input,#contact-form textarea').val('');
    })
    .fail(function(data) {
        // Make sure that the formMessages div has the 'error' class.
        $(formMessages).removeClass('success');
        $(formMessages).addClass('error');

        // Set the message text.
        if (data.responseText !== '') {
            $(formMessages).text(data.responseText);
        } else {
            $(formMessages).text('Oops! An error occured and your message could not be sent.');
        }
    });
});

});
<?php $this->Html->scriptEnd(); ?>