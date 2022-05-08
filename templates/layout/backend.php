<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>app-assets/css/plugins/extensions/ext-component-toastr.css">

    <?php echo $this->Html->css(['cake', 'magnific-popup']); ?>

    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo SITEURL; ?>app-assets/vendors/js/vendors.min.js"></script>
    <?php echo $this->Html->script(['jquery.form.min.js', 'validator.min', 'jquery.magnific-popup.min']); ?>
    <!-- BEGIN Vendor JS-->
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script type="text/javascript">
        var SITEURL = "<?php echo SITEURL; ?>";
        $(document).ready(function() {
            $(".magnificAjax").magnificPopup({
                type: "ajax",
                closeOnContentClick: false,
                closeOnBgClick: false,
                showCloseBtn: true,
                enableEscapeKey: false
            });

        });
        window['isNumber'] = function(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (
                (charCode != 45 || $(element).val().indexOf('-') != -1) && // Check minus and only once.
                (charCode != 46 || $(element).val().indexOf('.') != -1) && // Check dot and only once.
                (charCode < 48 || charCode > 57))
                return false;
            return true;
        };
    </script>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
</head>

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
    <?php echo $this->element('backend/top_nav'); ?>
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content'); ?>
    <?php echo $this->element('backend/footer'); ?>
    <?php echo $this->fetch('scriptBottom'); ?>




    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo SITEURL;?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo SITEURL;?>app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo SITEURL;?>app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo SITEURL;?>app-assets/js/scripts/forms/form-tooltip-valid.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <div id="cover"></div>
</body>

</html>