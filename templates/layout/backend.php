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
    <?php echo $this->Html->css([
        '/app-assets/vendors/css/vendors.min',
        '/app-assets/css/bootstrap',
        '/app-assets/css/bootstrap-extended',
        '/app-assets/css/colors',
        '/app-assets/css/components',
        '/app-assets/css/themes/bordered-layout',
        '/app-assets/css/core/menu/menu-types/horizontal-menu',
        'cake',

    ]); ?>
    <?php echo $this->Html->script(['/app-assets/vendors/js/vendors.min.js', 'jquery.form.min.js', 'validator.min']); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
</head>
<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
    <?php echo $this->element('backend/top_nav'); ?>
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content'); ?>
    <?php echo $this->element('backend/footer'); ?>
    <?php echo $this->fetch('scriptBottom'); ?>
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

</body>

</html>