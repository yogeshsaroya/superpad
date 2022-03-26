<?php 
$session = $this->request->getSession()->read('Auth'); //read session data
?>

<header class="header-section has-header-main bg-gradient-2">
            <div class="header-main is-sticky is-transparent">
                <div class="container">
                    <div class="header-wrap">
                        <div class="header-logo">
                            <a href="<?php echo SITEURL;?>" class="logo-link">
                                <img class="logo-dark logo-img" src="<?php echo SITEURL;?>images/logo.png" alt="logo">
                                <img class="logo-light logo-img" src="<?php echo SITEURL;?>images/logo.png" alt="logo">
                            </a>
                        </div><!-- .header-logo -->
                        <div class="header-mobile-action">
                            
                            <div class="header-mobile-wallet me-2">
                                <a class="icon-btn" href="<?php echo SITEURL;?>connect-wallet">
                                    <em class="ni ni-wallet"></em>
                                </a>
                            </div><!-- end hheader-mobile-wallet -->
                            <div class="header-toggle">
                                <button class="menu-toggler">
                                    <em class="menu-on menu-icon ni ni-menu"></em>
                                    <em class="menu-off menu-icon ni ni-cross"></em>
                                </button>
                            </div><!-- .header-toggle -->
                        </div><!-- end header-mobile-action -->
                        
                        <nav class="header-menu menu nav">
                            <ul class="menu-list ms-lg-auto">
                                <li class="menu-item"><a href="<?php echo SITEURL;?>allocation" class="menu-link">Allocation</a></li>
                                <li class="menu-item"><a href="<?php echo SITEURL;?>stake" class="menu-link">Stake</a></li>
                                <li class="menu-item"><a href="javascript:void(0);" class="menu-link">Buy SPAD</a></li>
                                <?php if(isset($session['User']['role']) && $session['User']['role'] == 2 ){?>
                                <li class="menu-item"><a href="<?php echo SITEURL;?>dashboard" class="menu-link">Dashboard</a></li>
                                <li class="menu-item"><a href="<?php echo SITEURL;?>users/logout" class="menu-link">Logout</a></li>
                                <?php }else{?>
                                <li class="menu-item"><a href="<?php echo SITEURL;?>sign-in" class="menu-link">Sign In</a></li>
                                <li class="menu-item"><a href="<?php echo SITEURL;?>register" class="menu-link">Register</a></li>
                                <?php } ?>
                            </ul>
                            <ul class="menu-btns">
                                <li><a href="<?php echo SITEURL;?>connect-wallet" class="btn btn-dark">Connect Wallet</a></li>
                            </ul>
                            
                        </nav><!-- .header-menu -->
                        <div class="header-overlay"></div>
                    </div><!-- .header-warp-->
                </div><!-- .container-->
            </div><!-- .header-main-->
           
        </header><!-- end header-section -->