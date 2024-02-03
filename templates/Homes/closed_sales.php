<?php $this->assign('title', 'Closed Sale'); ?>

<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Closed Sale</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Explore</li>
                </ol>
            </nav>
        </div><!-- hero-content -->
    </div><!-- .container-->
</div>

<section class="explore-section pt-lg-4" id="project_list">
    <div class="container">

        <div class="filter-container row g-gs">
            <?php
            $data = $this->Data->getClosedSales(50);
            if ( !$data->isEmpty() ) {
                echo $this->element('home/product_box', ['data' => $data]);
            }else{ ?>
            <center>
<h1>Please stay tuned for next upcoming sales</h1>
</center>


            <?php }?>
        </div><!-- end filter-container -->
    </div><!-- .container -->
</section><!-- end explore-section -->

<section class="top-creator-section section-space-sm-t">
<br>
<br>
<br>
</section>