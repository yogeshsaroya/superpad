<?php $this->assign('title', 'Error');  ?>
<br><br>
<section class="cta-section section-space-b bg-pattern">
            <div class="container">
                <div class="cta-box text-center">
                    <h1 class="cta-title mb-3">
                    <em class="icon ni ni-info-fill"></em>
                    </h1>
                    <p class="cta-text mb-4"><?php if(!empty($err_msg)){ echo $err_msg; } else{ echo "Authentication error. Please try again later.";}?></p>
                    
                </div><!-- end cta-box -->
            </div><!-- .container -->
            <br><br><br><br>
        </section><!-- end cta-section -->