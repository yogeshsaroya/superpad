<?php $this->assign('title', 'Connect Wallet'); ?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.2.1/dist/umd/index.min.js"></script>

<style>
    
.hkzEld {
    z-index: 999;
}    
</style>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Connect Wallet</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="wallet-section section-space-b">
    <div class="container">
        <div class="row g-gs">
            <div class="col-lg-4col-md-6">
                <div class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block" >
                        <img class="mb-4" src="<?php echo SITEURL; ?>images/brand/metamask.svg" alt="">
                        <h4 class="card-title mb-3">Metamask</h4>
                        <p class="card-text card-text-s1 mb-4">Start exploring blockchain applications in seconds. Trusted by over 1 million users worldwide.</p>
                        <div id="signTheMessage" class="user-login-msg"></div>
                        <span class="btn btn-dark" onclick="userLoginOut()" id="buttonText">Connect</span>
                    </div>
                </div>
            </div>

            <?php /* ?>
            <div class="col-lg-4 col-md-6">
                <a href="javascript:void(0);" class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block">
                        <img class="mb-4" src="<?php echo SITEURL;?>images/brand/wallet-connect.svg" alt="">
                        <h4 class="card-title mb-3">WalletConnect</h4>
                        <p class="card-text card-text-s1 mb-4">Open source protocol for connecting decentralised applications to mobile wallets.</p>
                        <span class="btn btn-dark">Connect</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="javascript:void(0);" class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block">
                        <img class="mb-4" src="<?php echo SITEURL;?>images/brand/coinbase.svg" alt="">
                        <h4 class="card-title mb-3">Coinbase</h4>
                        <p class="card-text card-text-s1 mb-4">The easiest and most secure crypto wallet. No Coinbase account required to connect EnftyMart.</p>
                        <span class="btn btn-dark">Connect</span>
                    </div>
                </a>
            </div>
            <?php */ ?>
        </div>
    </div>
</section>

<script>
    // If this package is in a subfolder, define the backend path
    // backendPath = "php-metamask-user-login/";

    function rd(){
      document.getElementById('buttonText').removeAttribute("onclick");
      document.getElementById('buttonText').remove();


       $('#signTheMessage').html('<div class="alert alert-success">Your MetaMask wallet address been linked with your account.</div>');
       var s = SITEURL+"users/wallet";
       
       setTimeout(function(){ window.location.href =s; }, 2000);
    }

    function err_wallet(){
        //document.getElementById('buttonText').removeAttribute("onclick");
        $('#signTheMessage').html('<div class="alert alert-danger">This wallet address is already in use with other account. Please use other account.</div>');
    }

    function can_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">Your request has been canceled. Please try again.</div>');
    }

    function fail_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">Your request has been failed. Please try again.</div>');
        setTimeout(function(){ location.reload(); }, 1000);

    }

    

    

</script>
<script src="<?php echo SITEURL; ?>web3/web3-login.js?v=<?php echo rand(1111, 9999); ?>"></script>
<script src="<?php echo SITEURL; ?>web3/web3-modal.js?v=<?php echo rand(1111, 9999); ?>"></script>