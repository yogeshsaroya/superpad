<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $this->fetch('title') ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL;?>favicon.ico">
    <?php echo $this->Html->css(['/assets/css/vendor.bundle', '/assets/css/style']); ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    
    <?php echo $this->Html->script(['/js/vendor/modernizr-2.8.3.min']) ?>
</head>

<body>
<div class="page-wrap">
        <?php echo $this->element('header'); ?>
        <?= $this->fetch('content') ?>
        <?php echo $this->element('footer'); ?>
</div>
    <?php echo $this->Html->script(['/js/vendor/jquery-3.1.1.min','/assets/js/bundle','/assets/js/scripts']) ?>
    <?php echo $this->Html->script(['jquery.form.min.js', 'validator.min']); ?>
    <?php echo $this->fetch('scriptBottom'); ?>
</body>
</html>