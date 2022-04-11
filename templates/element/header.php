<header class="header-section has-header-main bg-gradient-2">
    <div class="header-main is-sticky is-transparent">
        <div class="container">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="<?php echo SITEURL; ?>" class="logo-link">
                        <img class="logo-dark logo-img" src="<?php echo SITEURL . "cdn/logo/" . $Setting['logo']; ?>" alt="logo">
                        <img class="logo-light logo-img" src="<?php echo SITEURL . "cdn/logo/" . $Setting['logo']; ?>" alt="logo">
                    </a>
                </div><!-- .header-logo -->
                <div class="header-mobile-action">

                    <div class="header-mobile-wallet me-2">
                        <a class="icon-btn" href="<?php echo SITEURL; ?>connect-wallet">
                            <em class="ni ni-wallet"></em>
                        </a>
                    </div><!-- end hheader-mobile-wallet -->
                    <div class="header-toggle">
                        <button class="menu-toggler">
                            <em class="menu-on menu-icon ni ni-menu"></em>
                            <em class="menu-off menu-icon ni ni-cross"></em>
                        </button>
                    </div>
                </div>
                <nav class="header-menu menu nav">
                    <ul class="menu-list ms-lg-auto">
                        <li class="menu-item"><a href="javascript:void(0);" class="menu-link">Allocation</a></li>
                        <li class="menu-item"><a href="javascript:void(0);" class="menu-link">Stake</a></li>
                        <li class="menu-item"><a href="javascript:void(0);" class="menu-link">Buy SPAD</a></li>
                        <?php /*?>
                        <li class="menu-item has-sub">
                            <a href="#" class="menu-link menu-toggle">Buy SPAD</a>
                            <div class="menu-sub">
                                <ul class="menu-list">
                                    <li class="menu-item"><a href="index.html" class="menu-link">Home Page 1</a></li>
                                    <li class="menu-item"><a href="index-2.html" class="menu-link">Home Page 2</a></li>
                                </ul>
                            </div>
                        </li>
                        <?php */?>
                        
                        <?php if (isset($Auth->role) && !empty($Auth->role)) {
                            if ($Auth->role == 2) { ?>
                                <li class="menu-item"><a href="<?php echo SITEURL; ?>dashboard" class="menu-link">Dashboard</a></li>
                                <li class="menu-item"><a href="<?php echo SITEURL; ?>users/logout" class="menu-link">Logout</a></li>
                            <?php }else{
                                echo '<li class="menu-item"><a href="'.SITEURL.'pages" class="menu-link">Backend</a></li>';
                            } 
                            } else { ?>
                            <li class="menu-item"><a href="<?php echo SITEURL; ?>sign-in" class="menu-link">Sign In</a></li>
                            <li class="menu-item"><a href="<?php echo SITEURL; ?>register" class="menu-link">Register</a></li>
                        <?php } ?>
                    </ul>
                    <?php if (isset($Auth->role) && $Auth->role == 2 && empty($Auth->metamask_wallet_id) ) { ?>
                    <ul class="menu-btns"> <li><a href="<?php echo SITEURL;?>connect-wallet" class="btn btn-dark">Connect Wallet</a></li> </ul>
                    <?php }?>
                </nav>
                <div class="header-overlay"></div>
            </div>
        </div>
    </div>
</header>