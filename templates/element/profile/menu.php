<div class="col-lg-3">
    <div class="sidebar-head d-flex flex-wrap align-items-center justify-content-between">
        <h3 class="sidebar-head-title">Account Settings</h3>
        <div class="sidebar-head-action d-flex align-items-center">
            <div class="sidebar-drop">
                <a class="icon-btn menu-toggler-user-open" href="#"><em class="ni ni-menu"></em></a>
            </div>
        </div>
    </div>
    <div class="sidebar sidebar-user-mobile">
        <a href="#" class="icon-btn menu-toggler-user-close">
            <em class="ni ni-cross"></em>
        </a>
        <div class="sidebar-widget">
            <ul class="user-nav">
                <li class="<?php echo (isset($menu_act) && $menu_act == 'kyc' ? 'active' : null); ?>"><a href="<?php echo SITEURL; ?>users/kyc"><em class="ni ni-money me-2"></em>KYC</a></li>
                <li class="<?php echo (isset($menu_act) && $menu_act == 'wallet' ? 'active' : null); ?>"><a href="<?php echo SITEURL; ?>users/wallet"><em class="ni ni-user me-2"></em>Walllet</a></li>
                <li class="<?php echo (isset($menu_act) && $menu_act == 'staking' ? 'active' : null); ?>"><a href="<?php echo SITEURL; ?>users/staking"><em class="icon ni ni-invest me-2"></em>My Staking</a></li>
                <li class="<?php echo (isset($menu_act) && $menu_act == 'tier' ? 'active' : null); ?>"><a href="<?php echo SITEURL; ?>users/tier"><em class="icon ni ni-coin-alt me-2"></em>My Tier</a></li>
                <li class="<?php echo (isset($menu_act) && $menu_act == 'application_status' ? 'active' : null); ?>"><a href="<?php echo SITEURL; ?>users/application_status"><em class="ni ni-archive me-2"></em>Applications</a></li>
                <li><a href="<?php echo SITEURL; ?>users/logout"><em class="ni ni-setting-alt me-2"></em>Logout</a></li>
            </ul>
        </div>
    </div>
</div>