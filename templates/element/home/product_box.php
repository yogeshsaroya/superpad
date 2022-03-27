<style>
    .filter-item .card-body{
        padding-bottom: 70px !important;
        position: relative;
    }
    .filter-item .card-body{color: #09090f;}
    .filter-item button.btn-dark {
    position: absolute;
    bottom: 0;
    border-radius: 0;
    left: 0;
    right: 0;
    background: #d9dbf1;
    border: 0;
    color: #434fa7;
    font-size: 16px;
    font-weight: 600;
    padding: 10px 12px;
}
.filter-item button.btn-dark:hover {
    background: #434fa7;
    color: #fff;
}
.supDt {
    position: absolute;
    top: 0;
    right: 0;
    background: #242931;
    width: calc(100% - 114px);
    /* text-align: right; */
    color: #fff;
    justify-content: flex-end;
    padding: 2px 20px;
    font-size: 14px;
}
.logoWrap {
    margin-top: -72px;
    margin-bottom: 14px;
}
.filter-item span.headins {
    color: #05050c;
    font-size: 25px;
    margin-bottom: 5px;
}
.card-price-wrap > div > span {
    font-size: 16px;
    margin: 0.8rem 0 0 !important;
    color: #05050c;
}
.card-price-wrap .card-price-title {
    font-size: 16px;
    font-weight: 600;
    color: #05050c;
}
</style>
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
                        <div class="supDt d-flex">
                           <div class="st_date"><?php if (!empty($list->start_date)) {
                                                    echo $list->start_date->format('Y-m-d');
                                                } ?></div>
                        </div>
                        
                        <h5 class="card-title text-truncate mb-3">
                            <p class="mb-0">
                                <span class="headins"><?php echo $list->title; ?></span>
                                <span><?php echo $list->ticker; ?></span>
                            </p>
                            <?php if (isset($list->blockchain->name)) { ?>
                                <img src="<?php echo SITEURL . 'cdn/blockchains/' . $list->blockchain->logo; ?>" title="<?php echo $list->blockchain->name; ?>" width="32px" alt="" />
                            <?php } ?>
               </h5>

                        <div class="card-price-wrap  mb-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Ticket Allocation</span>
                                <span class="card-price-number text-end"><?php echo $this->Number->currency($list->ticket_allocation, 'USD'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Fund Raise</span>
                                <span class="card-price-number text-end"><?php echo $this->Number->currency($list->total_raise, 'USD'); ?></span>
                            </div>
                        </div><!-- end card-price-wrap -->
                        <button class="btn btn-sm btn-dark"><?php echo $list->type; ?></button>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col -->
<?php }
} ?>