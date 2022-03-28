<?php
$list = $data;
$this->assign('title', $list->title . ' : SuperPAD');
?>
<?php echo $this->Html->css(['/assets/css/pro_dt']); ?>
<section class="item-detail-section ">
    <div class="container">
        <div class="ps--project-show">
            <div class="ps--project-show__secondary">
                <nav class="ps--project-show__breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><?php echo $this->Html->link('Projects', '/explore'); ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $list->title; ?></li>
                    </ol>
                </nav>
                <div class="ps--project-show__status">
                    <div class="ps--badge ps--secondary" data-project-partial-target="status"><?php echo $list->product_status; ?></div>
                </div>
            </div>
        </div>
        <div class="ps--project-show__main">
            <div class="ps--project-show__logo">
                <img class="ps--table__project-img" src="<?php echo SITEURL . "cdn/project_logo/" . $list->logo; ?>" alt=""/>
            </div>
            <div class="ps--project-show__information">
                <div class="ps--project-show__status">
                    <h1 class="ps--project-show__title"><?php echo $list->title; ?></h1>
                    <div class="ps--badge ps--ido"><?php echo $list->ticker; ?></div>
                </div>
                <h2 class="ps--project-show__subtitle"><?php echo $list->heading; ?></h2>
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col-lg-8">
                <div class="item-detail-content">
                    <div class="item-detail-img-container mb-4">
                        <img src="<?php echo SITEURL . "cdn/project_img/" . $list->hero_image; ?>" alt="<?php echo $list->title; ?>" class="w-100 rounded-3">
                    </div><!-- end item-detail-img-container -->
                    <div class="item-detail-tab textContent">
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
                                                <th colspan="1">Project Key Metrics </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sale Price</td>
                                                <td><?php echo "1 " . $list->ticker . " = " . $this->Number->currency($list->price_per_token, 'USD'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sale Start Time (UTC) </td>
                                                <td><?php echo (!empty($list->start_date) ? $list->start_date->format('Y-m-d H:i A') : 'TBA'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sale End Time (UTC) </td>
                                                <td><?php echo (!empty($list->end_date) ? $list->end_date->format('Y-m-d H:i A') : 'TBA'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Token Distribution (UTC) </td>
                                                <td><?php echo (!empty($list->token_distribution_date) ? $list->token_distribution_date->format('Y-m-d H:i A') : 'TBA'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Initial Market Cap </td>
                                                <td><?php echo $this->Number->currency($list->initial_market_cap, 'USD'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Initial Token Circulation </td>
                                                <td><?php echo number_format($list->initial_token_circulation); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- end item-detail-tab-wrap -->
                            </div><!-- end tab-pane -->
                        </div>
                    </div>
                </div><!-- end item-detail-content -->

            </div><!-- end col -->
            <div class="col-lg-4 mt-lg-0 mt-5 <?php if(!$this->request->is('mobile')){ echo "sidebarFixed";}?>">
                <div class="item-detail-content mt-4 mt-lg-0 sidebars">
                    <h6 class="subHead">Fundraise Goal</h6>
                    <h1 class="item-detail-title mb-3"><?php echo $list->title; ?>
                    <span class="ms-auto">
                    <?php if (isset($list->blockchain->name)) { ?>
                                <img src="<?php echo SITEURL . 'cdn/blockchains/' . $list->blockchain->logo; ?>" title="<?php echo $list->blockchain->name; ?>" alt="" />
                    <?php } ?>    
                    </span>
                    </h1>
                    <p class="item-detail-text mb-4"><?php echo $list->heading; ?></p>
                    <div class="item-detail-meta d-flex flex-wrap align-items-center mb-3">
                        <div class="card-price-wrap  mb-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Ticket Allocation</span>
                                <span class="card-price-number text-end"><?php echo $this->Number->currency($list->ticket_allocation, 'USD'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Fund Raise</span>
                                <span class="card-price-number text-end"><?php echo $this->Number->currency($list->total_raise, 'USD'); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="item-detail-text mb-2 hide">The allowlist for Kyoko is now available and you can apply for it below. Note</p>
                    <p class="item-detail-text mb-2 hide"> that you need to have at least 250 POLS Power to qualify for this allowlist. Learn more.</p>
                        
                    <div class="item-detail-btns mt-4">
                        <ul class="btns-group d-flex">
                            <li class="flex-grow-1">
                                <a class="btn btn-primary w-100" href="javascript:void(0);">Application Status</a></a>
                            </li>
                            <li class="flex-grow-1">
                                <a class="btn btn-primary w-100 bg-transparent" href="javascript:void(0);">Application Status</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <?php if (!empty( check_date($list->start_date->format('Y-m-d')))) {?>
                <div class="timers">
                    <div class="rounded">
                        <p class="mb-2 text-uppercase">SALE STARTS IN</p>
                        <div id="clock" class="countdown"></div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>

<section class="item-detail-section ">
    <div class="container">
    </div>
</section>

<?php 
if (!empty( check_date($list->start_date->format('Y-m-d')))) {
echo $this->Html->script(['jquery.countdown.min'],['block' => 'scriptBottom']); 
}
if(!$this->request->is('mobile')){
    echo $this->Html->script(['sticky-sidebar'],['block' => 'scriptBottom']); 
}
?>
<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
<?php if (!empty( check_date($list->start_date->format('Y-m-d')))) {?>
$(function () {
$('#clock').countdown('<?php echo $list->start_date->format('Y/m/d');?>').on('update.countdown', function(event) {
var $this = $(this).html(event.strftime(''
+ '<span class="clockbx"><span class="font-weight-bold h1">%D</span> Day%!d</span> '
+ '<span class=" clockbx"><span class="h1 font-weight-bold h1">%H</span> Hr</span> '
+ '<span class="clockbx"><span class="h1 font-weight-bold h1">%M</span> Min</span>'
+ '<span class="clockbx"><span class="h1 font-weight-bold h1">%S</span>Sec</span>'));
});
});
<?php }
if(!$this->request->is('mobile')){ ?>
var a = new StickySidebar('.sidebarFixed', {
topSpacing: 25,
containerSelector: '.container',
innerWrapperSelector: '.sidebar__inner'
});
<?php } 
$this->Html->scriptEnd(); ?>