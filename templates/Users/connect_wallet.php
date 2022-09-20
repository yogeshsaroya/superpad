<?php $this->assign('title', 'Connect Wallet'); ?>
<?php /*https://github.com/giekaton/php-metamask-user-login*/ ?>
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
        </div>
    </div>
</section>

<script>
    function rd(){
      document.getElementById('buttonText').removeAttribute("onclick");
      document.getElementById('buttonText').remove();


       $('#signTheMessage').html('<div class="alert alert-success">Your MetaMask wallet address been connected.</div>');
       var s = SITEURL+"users/dashboard";
       setTimeout(function(){ window.location.href =s; }, 2000);
    }

    function err_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">This wallet address is already in use with other account. Please use other account.</div>');
    }

    function can_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">Your request has been canceled. Please try again.</div>');
    }

    function wrong_network(){
        $('#signTheMessage').html('<div class="alert alert-danger">Network not switched. Please switch network to Binance Smart Chain.</div>');
    }

    function fail_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">Your request has been failed. Please try again.</div>');
        //setTimeout(function(){ location.reload(); }, 1000);

    }
</script>
<?php echo $this->Html->script(['/web3/axios.min']); 
echo $this->Html->script(['/web3/web3-login','/web3/web3-modal'],['block'=>'scriptBottom']);
?>
