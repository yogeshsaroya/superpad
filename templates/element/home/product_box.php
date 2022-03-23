<?php
if (!empty($data)) {
    foreach ($data as $list) { ?>
        <div class="col-xl-4 col-lg-4 col-sm-6 filter-item">
            <div class="card card-full">
                <a href="<?php echo SITEURL . "explore/" . $list->slug; ?>" class="card-image">
                    <span class="badge rounded-pill bg-success"><?php echo $list->product_status; ?></span>
                    <img src="<?php echo SITEURL . "cdn/project_img/" . $list->hero_image; ?>" class="card-img-top hero_img" alt="<?php echo $list->title; ?>">

                    <div class="card-body p-4">
                        <div class="logoWrap">
                            <img src="<?php echo SITEURL . "cdn/project_logo/" . $list->logo; ?>" alt="<?php echo $list->title; ?>" />
                        </div>
                        <div class="st_date">
                            10/10/2022 09:00 AM

                        </div>
                        <h5 class="card-title text-truncate mb-0">
                            <p class="mb-0">
                                <span><?php echo $list->title; ?></span>
                                <span><?php echo $list->ticker; ?></span>
                            </p>
                            <?php if (isset($list->blockchain->name)) { ?>
                                <img src="<?php echo SITEURL . 'cdn/blockchains/' . $list->blockchain->logo; ?>" title="<?php echo $list->blockchain->name; ?>" width="32px" alt="" />
                            <?php } ?>

                        </h5>

                        <div class="card-price-wrap d-flex align-items-center justify-content-sm-between mb-3">
                            <div class="me-5 me-sm-2">
                                <span class="card-price-title">Ticket Allocation</span>
                                <span class="card-price-number"><?php echo $this->Number->currency($list->ticket_allocation, 'USD'); ?></span>
                            </div>
                            <div class="text-sm-end">
                                <span class="card-price-title">Fund Raise</span>
                                <span class="card-price-number"><?php echo $this->Number->currency($list->total_raise, 'USD'); ?></span>
                            </div>
                        </div><!-- end card-price-wrap -->
                        <button class="btn btn-sm btn-dark"><?php echo $list->type; ?></button>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col -->
<?php }
} ?>