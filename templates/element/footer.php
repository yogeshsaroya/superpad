<?php
$pages = $this->Data->getFooterMenu();
$MenuType = getMenuType();
?>
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
                        <?php */ ?>
                        <p class="my-4 footer-para">The world’s first and largest multichain crypto Launchpad.</p>
                        <ul class="styled-icon">
                            <?php if (!empty($Setting['twitter'])) { ?><li><a href="<?php echo $Setting['twitter']; ?>"><img src="<?php echo SITEURL; ?>img/twitter.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['telegram'])) { ?><li><a href="<?php echo $Setting['telegram']; ?>"><img src="<?php echo SITEURL; ?>img/telegram.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['telegram'])) { ?><li><a href="<?php echo $Setting['telegram_2']; ?>"><img src="<?php echo SITEURL; ?>img/telegram.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['discord'])) { ?><li><a href="<?php echo $Setting['discord']; ?>"><img src="<?php echo SITEURL; ?>img/discord.svg" alt="" class="svg_icon" /></a></li><?php } ?>
                            <?php if (!empty($Setting['medium'])) { ?><li><a href="<?php echo $Setting['medium']; ?>"><img src="<?php echo SITEURL; ?>img/medium.svg" alt="" class="svg_icon" /></a></li><?php } ?>

                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-9">
                    <div class="row g-gs">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-item">
                                <h5 class="mb-4">Social Media</h5>
                                <ul class="list-item list-item-s1">
                                    <?php if (!empty($Setting['twitter'])) { ?> <li><a href="<?php echo $Setting['twitter']; ?>">Twitter</a></li><?php } ?>
                                    <?php if (!empty($Setting['telegram'])) { ?> <li><a href="<?php echo $Setting['telegram']; ?>">Telegram</a></li><?php } ?>
                                    <?php if (!empty($Setting['discord'])) { ?> <li><a href="<?php echo $Setting['discord']; ?>">Telegram Announcement</a></li><?php } ?>
                                    <?php if (!empty($Setting['medium'])) { ?> <li><a href="<?php echo $Setting['medium']; ?>">Medium</a></li><?php } ?>
                                </ul>
                            </div><!-- end footer-item -->
                        </div><!-- end col -->
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-item">
                                <h5 class="mb-4">Help</h5>
                                <ul class="list-item list-item-s1">
                                    <?php if (!empty($pages)) {
                                        foreach ($pages as $list) {
                                            if ($list->heading == 'Help') {
                                                echo '<li><a href="' . SITEURL . 'page/' . $list->slug . '">' . $list->title . '</a></li>';
                                            }
                                        }
                                    } ?>

                                </ul>
                            </div><!-- end footer-item -->
                        </div><!-- end col-lg-3 -->
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-item">
                                <h5 class="mb-4">Company</h5>
                                <ul class="list-item list-item-s1">
                                    <?php if (!empty($pages)) {
                                        foreach ($pages as $list) {
                                            if ($list->heading == 'Company') {
                                                echo '<li><a href="' . SITEURL . 'page/' . $list->slug . '">' . $list->title . '</a></li>';
                                            }
                                        }
                                    } ?>
                                    
                                    <li><a href="<?php echo SITEURL; ?>team">Team</a></li>
                                    
                                    <li><a href="<?php echo SITEURL; ?>contact">Contact Us</a></li>
                                    <?php if (isset($Setting['whitepaper'])) { ?><li><a href="<?php echo $Setting['whitepaper']; ?>">WhitePaper</a></li><?php } ?>

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
                <li><a href="<?php echo SITEURL; ?>explore">Explore</a></li>
                <?php /* ?>
                <li><a href="<?php echo SITEURL; ?>airdrop">Airdrop</a></li>
                <?php */ ?>
            </ul>
        </div>
    </div>
</footer>