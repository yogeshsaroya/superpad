<footer class="footer-section bg-dark on-dark">
    <div class="container">
        <div class="section-space-sm">
            <div class="row">
                <div class="col-lg-3 col-md-9 me-auto">
                    <div class="footer-item mb-5 mb-lg-0">
                    <?php /*?>
                        <a href="<?php echo SITEURL;?>" class="footer-logo-link logo-link">
                            <img class="logo-dark logo-img" src="<?php echo SITEURL; ?>images/logo.png" alt="logo">
                            <img class="logo-light logo-img" src="<?php echo SITEURL; ?>images/logo.png" alt="logo">
                        </a>
                        <?php */?>
                        <p class="my-4 footer-para">The world's first and largest digital marketplace for crypto collectibles and non-fungible tokens (NFTs).</p>
                        <ul class="styled-icon">
                            <?php if (!empty($Setting['twitter'])) { ?><li><a href="<?php echo $Setting['twitter']; ?>"><img src="<?php echo SITEURL; ?>img/twitter.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['telegram'])) { ?><li><a href="<?php echo $Setting['telegram']; ?>"><img src="<?php echo SITEURL; ?>img/telegram.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['medium'])) { ?><li><a href="<?php echo $Setting['medium']; ?>"><img src="<?php echo SITEURL; ?>img/medium.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['discord'])) { ?><li><a href="<?php echo $Setting['discord']; ?>"><img src="<?php echo SITEURL; ?>img/discord.svg" alt="" class="svg_icon" /></a></li><?php } ?>

                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-8">
                    <div class="row g-gs">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-item">
                                <h5 class="mb-4">Social Media</h5>
                                <ul class="list-item list-item-s1">
                                    <?php if (!empty($Setting['twitter'])) { ?> <li><a href="<?php echo $Setting['twitter']; ?>">Twitter</a></li><?php } ?>
                                    <?php if (!empty($Setting['telegram'])) { ?> <li><a href="<?php echo $Setting['telegram']; ?>">Telegram</a></li><?php } ?>
                                    <?php if (!empty($Setting['medium'])) { ?> <li><a href="<?php echo $Setting['medium']; ?>">Discord</a></li><?php } ?>
                                    <?php if (!empty($Setting['discord'])) { ?> <li><a href="<?php echo $Setting['discord']; ?>">Medium</a></li><?php } ?>
                                </ul>
                            </div><!-- end footer-item -->
                        </div><!-- end col -->
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-item">
                                <h5 class="mb-4">Help</h5>
                                <ul class="list-item list-item-s1">
                                    <li><a href="<?php echo SITEURL;?>page/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="<?php echo SITEURL;?>page/faq">FAQ</a></li>
                                    <li><a href="<?php echo SITEURL;?>page/term-and-condition">Term And Condition</a></li>
                                </ul>
                            </div><!-- end footer-item -->
                        </div><!-- end col-lg-3 -->
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-item">
                                <h5 class="mb-4">Company</h5>
                                <ul class="list-item list-item-s1">
                                    <li><a href="<?php echo SITEURL;?>page/about-us">About</a></li>
                                    <li><a href="<?php echo SITEURL;?>page/team">Team</a></li>
                                    <li><a href="<?php echo SITEURL;?>contact">Contact</a></li>
                                    <li><a href="<?php echo SITEURL;?>page/careers">Careers</a></li>
                                </ul>
                            </div><!-- end footer-item -->
                        </div><!-- end col-lg-3 -->
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end section-space-sm -->
        <hr class="bg-white-slim my-0">
        <div class="copyright-wrap d-flex flex-wrap py-3 align-items-center justify-content-between">
            <p class="footer-copy-text py-2">Copyright &copy; <?php echo date('Y'); ?> <?php echo WEBTITLE; ?>.</p>
            <ul class="list-item list-item-s1 list-item-inline">
                <li><a href="<?php echo SITEURL;?>explore">Explore</a></li>
                <li><a href="<?php echo SITEURL;?>sign-in">Login</a></li>
                <li><a href="<?php echo SITEURL;?>connect-wallet">Wallet</a></li>
            </ul>
        </div><!-- end d-flex -->
    </div><!-- .container -->
</footer><!-- end footer-section -->