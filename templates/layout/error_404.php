<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Page not found.</title>
    <meta name="robots" content="noindex">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL; ?>favicon.ico">
    <?php echo $this->Html->css(['/assets/css/vendor.bundle', '/assets/css/style']); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <div class="page-wrap">
        <?php echo $this->element('header'); ?>
        <div class="page-wrap d-flex flex-row align-items-center" style="
    padding: 10% 0 10% 0;
">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <span class="display-1 d-block">404</span>
                        <div class="mb-4 lead">The page you are looking for was not found.</div>
                        <a href="<?php echo SITEURL; ?>" class="btn btn-link">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->element('footer'); ?>
    </div>
    <?php echo $this->Html->script(['/js/vendor/jquery-3.1.1.min', '/assets/js/bundle', '/assets/js/scripts']) ?>
    <?php echo $this->fetch('scriptBottom'); ?>
</body>
</html>