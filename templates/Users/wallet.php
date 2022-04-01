<?php
$this->assign('title', 'MetaMask Wallet Address');
echo $this->element('profile/header', ['bg_color' => 'bg-gray']); ?>
<section class="profile-section section-space">
    <div class="container">
        <div class="row">
            <?php echo $this->element('profile/menu', ['menu_act' => 'wallet']); ?>
            <div class="col-lg-9 ps-xl-5">
                <div class="user-panel-title-box">
                    <h3>Account Settings</h3>
                </div>
                <div class="profile-setting-panel-wrap">
                    <h5 class="mb-3">MetaMask Wallet Address</h5>
                    <a href="#" class="btn btn-outline-dark"><?php echo $user_data->metamask_wallet_id?></a>
                    <p class="fs-14 mt-2">Please allow for up to 40 seconds for your changes to be reflected on your display screen</p>

                </div>
            </div>
        </div>
    </div>
</section>