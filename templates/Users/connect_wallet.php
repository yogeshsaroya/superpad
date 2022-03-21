<?php $this->assign('title', 'Connect Wallet'); ?>
<style>
    .btn.btn-dark{display: none;}
</style>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Connect Wallet</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL;?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                </ol>
            </nav>
        </div>
        <!-- hero-content -->
    </div>
    <!-- .container-->
</div>

<section class="wallet-section section-space-b">
    <div class="container">
        <div class="row g-gs">
            <div class="col-lg-4 col-md-6">
                <a href="javascript:void(0);" class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block">
                        <img class="mb-4" src="<?php echo SITEURL;?>images/brand/metamask.svg" alt="">
                        <h4 class="card-title mb-3">Metamask</h4>
                        <p class="card-text card-text-s1 mb-4">Start exploring blockchain applications in seconds. Trusted by over 1 million users worldwide.</p>
                        <span class="btn btn-dark">Connect</span>
                    </div>
                    <!-- end card-body -->
                </a>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-lg-4 col-md-6">
                <a href="javascript:void(0);" class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block">
                        <img class="mb-4" src="<?php echo SITEURL;?>images/brand/wallet-connect.svg" alt="">
                        <h4 class="card-title mb-3">WalletConnect</h4>
                        <p class="card-text card-text-s1 mb-4">Open source protocol for connecting decentralised applications to mobile wallets.</p>
                        <span class="btn btn-dark">Connect</span>
                    </div>
                    <!-- end card-body -->
                </a>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-lg-4 col-md-6">
                <a href="javascript:void(0);" class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block">
                        <img class="mb-4" src="<?php echo SITEURL;?>images/brand/coinbase.svg" alt="">
                        <h4 class="card-title mb-3">Coinbase</h4>
                        <p class="card-text card-text-s1 mb-4">The easiest and most secure crypto wallet. No Coinbase account required to connect EnftyMart.</p>
                        <span class="btn btn-dark">Connect</span>
                    </div>
                    <!-- end card-body -->
                </a>
                <!-- end card -->
            </div>
            <!-- end col -->




        </div>
        <!-- row -->
    </div>
    <!-- .container -->
</section>
<!-- end wallet-section -->