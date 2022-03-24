<?php
$list = $data;
$this->assign('title', $list->title . ' : SuperPAD');
?>
<section class="item-detail-section ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pe-xl-5">
                <div class="item-detail-content">
                    <div class="item-detail-img-container mb-4">
                        <img src="<?php echo SITEURL . "cdn/project_img/" . $list->hero_image; ?>" alt="<?php echo $list->title; ?>" class="w-100 rounded-3">
                    </div><!-- end item-detail-img-container -->
                    <div class="item-detail-tab">
                        <ul class="nav nav-tabs nav-tabs-s1" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"> Description </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="token_sale-tab" data-bs-toggle="tab" data-bs-target="#token_sale" type="button" role="tab" aria-controls="token_sale" aria-selected="false"> Token Sale </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="item-detail-tab-wrap">
                                    <?php echo $list->description; ?>
                                </div><!-- end item-detail-tab-wrap -->
                            </div><!-- end tab-pane -->
                            <div class="tab-pane fade" id="token_sale" role="tabpanel" aria-labelledby="token_sale-tab">
                                <div class="item-detail-tab-wrap">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="1">Project Key Metrics	</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr><td>Sale Price</td><td><?php echo "1 ".$list->ticker." = ".$this->Number->currency($list->price_per_token, 'USD'); ?></td></tr>
                                        <tr><td>Sale Start Time (UTC)	</td><td><?php echo(!empty($list->start_date)? $list->start_date->format('Y-m-d H:i A') :'TBA'); ?></td></tr>
                                        <tr><td>Sale End Time (UTC)	</td><td><?php echo(!empty($list->end_date)? $list->end_date->format('Y-m-d H:i A') :'TBA'); ?></td></tr>
                                        <tr><td>Token Distribution (UTC)	</td><td><?php echo(!empty($list->token_distribution_date)? $list->token_distribution_date->format('Y-m-d H:i A') :'TBA'); ?></td></tr>
                                        <tr><td>Initial Market Cap	</td><td><?php echo $this->Number->currency($list->initial_market_cap, 'USD'); ?></td></tr>
                                        <tr><td>Initial Token Circulation	</td><td><?php echo number_format($list->initial_token_circulation); ?></td></tr>
                                            


                                        </tbody>
                                    </table>

                                </div><!-- end item-detail-tab-wrap -->
                            </div><!-- end tab-pane -->

                        </div>
                    </div>
                </div><!-- end item-detail-content -->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="item-detail-content mt-4 mt-lg-0">
                    <h1 class="item-detail-title mb-2"><?php echo $list->title; ?></h1>
                    <div class="item-detail-meta d-flex flex-wrap align-items-center mb-3">
                        <span class="item-detail-text-meta">Not for sale</span>
                        <span class="dot-separeted"></span>
                        <span class="item-detail-text-meta">500 editions</span>
                        <span class="dot-separeted"></span>
                        <span class="item-detail-text-meta">Highest bid <span class="text-primary fw-semibold">0.072 ETH</span>
                        </span>
                    </div>
                    <p class="item-detail-text mb-4"><?php echo $list->heading; ?></p>
                    <div class="item-credits">
                        <div class="row g-4">

                        </div><!-- end row -->
                    </div><!-- end row -->
                    <div class="item-detail-btns mt-4">
                        <ul class="btns-group d-flex">
                            <li class="flex-grow-1">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#placeBidModal" class="btn btn-dark d-block">Place a Bid</a>
                            </li>

                        </ul>
                    </div><!-- end item-detail-btns -->
                </div><!-- end item-detail-content -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- .container -->
</section><!-- end item-detail-section -->

<section class="item-detail-section ">
    <div class="container">
    </div></section>