<?php
$list = $data;
$this->assign('title', $list->meta_title);
$this->assign('description', $list->meta_description);
echo $this->Html->css(['magnific-popup'], ['block' => 'css']);
echo $this->Html->script(['jquery.magnific-popup.min'], ['block' => 'scriptBottom']);

$today = strtotime(DATE);
$st_date = $end_date = null;
if (!empty($list->start_date)) {
    $st_date = strtotime($list->start_date->format('Y-m-d H:i:s'));
}
if (!empty($list->end_date)) {
    $end_date = strtotime($list->end_date->format('Y-m-d H:i:s'));
}
$timer_st = $timer_end = null;

if (!empty($st_date) && $st_date > $today) {
    $timer_st = $st_date;
}

if (!empty($end_date)) {
    if (!empty($st_date)) {
        if ($end_date > $st_date && $end_date > $today && $st_date <= $today) {
            $timer_end = $end_date;
        }
    } else {
        if ($end_date > $today) {
            $timer_end = $end_date;
        }
    }
}
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
            <div class="ps--project-show__logo pro_logo">
                <img class="ps--table__project-img" src="<?php echo SITEURL . "cdn/project_logo/" . $list->logo; ?>" alt="" />
            </div>
            <div class="ps--project-show__information">
                <div class="ps--project-show__status">
                    <h1 class="ps--project-show__title"><?php echo $list->title; ?></h1>
                    <div class="ps--badge ps--ido"><?php echo $list->ticker; ?></div>
                </div>
                <h2 class="ps--project-show__subtitle"><?php echo $list->heading; ?></h2>
                <div class="footer-item mb-5 mb-lg-0">
                    <p class="my-4 footer-para"> </p>
                    <ul class="styled-icon">
                        <?php if (!empty($list->website)) { ?><li><a href="<?php echo $list->website; ?>"><img src="<?php echo SITEURL; ?>img/link.svg" alt="" title="Website" class="svg_icon"></a></li><?php } ?>
                        <?php if (!empty($list->whitepaper)) { ?><li><a href="<?php echo $list->whitepaper; ?>"><img src="<?php echo SITEURL; ?>img/doc.svg" alt="" title="Document" class="svg_icon"></a></li><?php } ?>
                        <?php if (!empty($list->sm_accounts)) {
                            foreach ($list->sm_accounts as $sm) {
                                echo '<li><a href="' . $sm->link . '"><img src="' . SITEURL . 'img/' . strtolower($sm->type) . '.svg" alt="" title="' . $sm->type . '" class="svg_icon"></a></li>';
                            }
                        } ?>
                    </ul>
                </div>
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
                            <li class="nav-item" role="presentation"><button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"> Description </button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="token_sale-tab" data-bs-toggle="tab" data-bs-target="#token_sale" type="button" role="tab" aria-controls="token_sale" aria-selected="false"> Token Sale </button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="tokenomics-tab" data-bs-toggle="tab" data-bs-target="#tokenomics" type="button" role="tab" aria-controls="tokenomics" aria-selected="false"> Tokenomics </button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" type="button" role="tab" aria-controls="team" aria-selected="false"> Team </button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="partner-tab" data-bs-toggle="tab" data-bs-target="#partner" type="button" role="tab" aria-controls="partner" aria-selected="false"> Partner and Investor </button></li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="item-detail-tab-wrap"><?php if (!empty($list->description)) {
                                                                        echo $list->description;
                                                                    } else {
                                                                        echo "<h3>Not Available</h3>";
                                                                    } ?>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="tokenomics" role="tabpanel" aria-labelledby="tokenomics-tab">
                                <div class="item-detail-tab-wrap"><?php if (!empty($list->tokenomics)) {
                                                                        echo $list->tokenomics;
                                                                    } else {
                                                                        echo "<h3>Not Available</h3>";
                                                                    } ?></div>
                            </div>

                            <div class="tab-pane fade show" id="team" role="tabpanel" aria-labelledby="team-tab">
                                <div class="item-detail-tab-wrap">
                                    <?php if (!empty($list->teams)) { ?>
                                        <div class="col text-center">
                                            <h2>Meet Our Team</h2>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <?php foreach ($list->teams as $tList) { ?>
                                                <div class="col-xl-4 col-md-6 mb-4">
                                                    <div class="card border-0 shadow">
                                                        <?php echo $this->Html->image(SITEURL . 'cdn/team/' . $tList->img, ['alt' => 'logo', 'class' => 'card-img-top']); ?>
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title mb-0"><?php echo $tList->title; ?></h5>
                                                            <div class="card-text text-black-50"><?php echo $tList->heading; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } else {
                                        echo "<h3>Not Available</h3>";
                                    } ?>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="partner" role="tabpanel" aria-labelledby="partner-tab">
                                <div class="item-detail-tab-wrap">
                                    <?php if (!empty($list->partners)) { ?>
                                        <div class="row">
                                            <div class="col text-center">
                                                <h2 class="">We are backed by</h2>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <?php
                                            foreach ($list->partners as $plist) {
                                                if (!empty($plist->url)) { ?>
                                                    <div class="col-md-3 col-xl-3 mb-4">
                                                        <a href="<?php echo $plist->url; ?>" title="<?php echo $plist->title; ?>" target="_blank">
                                                            <img src="<?php echo SITEURL . "cdn/partners/" . $plist->logo; ?>" alt="" height="45">
                                                        </a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-3 col-xl-3 mb-4">
                                                        <img src="<?php echo SITEURL . "cdn/partners/" . $plist->logo; ?>" alt="" height="45">
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                    <?php } else {
                                        echo "<h3>Not Available</h3>";
                                    } ?>
                                </div>
                            </div>
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
                                                <td><?php
                                                    if ($list->price_per_token > 0) {
                                                        echo "1 " . $list->ticker . " = " . $this->Number->currency($list->price_per_token, 'USD');
                                                    } else {
                                                        echo "TBA";
                                                    } ?></td>
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
                                                <td><?php echo ($list->initial_market_cap > 0 ? "$" . number_format_short($list->initial_market_cap) : 'TBA'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Supply </td>
                                                <td><?php echo ($list->total_supply > 0 ? "$" . number_format_short($list->total_supply) : 'TBA'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Initial Token Circulation </td>
                                                <td><?php echo ($list->initial_token_circulation > 0 ?  number_format_short($list->initial_token_circulation) : 'TBA'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- end item-detail-tab-wrap -->
                            </div><!-- end tab-pane -->
                        </div>
                    </div>
                </div><!-- end item-detail-content -->

            </div><!-- end col -->
            <div class="col-lg-4 mt-lg-0 mt-5 mob_order_1 <?php echo (!$this->request->is('mobile') ?  "sidebarFixed" : null); ?>">
                <div class="item-detail-content mt-4 mt-lg-0 sidebars">
                    <h1 class="item-detail-title mb-3"><?php echo $list->title; ?>
                        <span class="ms-auto">
                            <?php if (isset($list->blockchain->name)) { ?>
                                <img src="<?php echo SITEURL . 'cdn/blockchains/' . $list->blockchain->logo; ?>" title="<?php echo $list->blockchain->name; ?>" alt="" />
                            <?php } ?>
                        </span>
                    </h1>
                    <p class="item-detail-text mb-4">
                    <div class="item-detail-meta d-flex flex-wrap align-items-center mb-3">
                        <div class="card-price-wrap  mb-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">IDO Date</span>
                                <span class="card-price-number text-end"><?php echo (!empty($list->start_date) ? $list->start_date->format('Y-m-d H:i A') : 'TBA'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Fund Raise</span>
                                <span class="card-price-number text-end"><?php echo ($list->total_raise > 0 ?  $this->Number->currency($list->total_raise, 'USD') : 'TBA'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Token Price</span>
                                <span class="card-price-number text-end"><?php echo ($list->price_per_token > 0 ?  $this->Number->currency($list->price_per_token, 'USD') : 'TBA'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Ticket Allocation</span>
                                <span class="card-price-number text-end"><?php echo ($list->ticket_allocation > 0 ? $this->Number->currency($list->ticket_allocation, 'USD') : 'TBA'); ?></span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="item-detail-btns mt-4">
                        <ul class="btns-group d-flex">
                        <?php if(strtolower($list->product_status) == 'whitelist open'){?>
                            <?php if (isset($Auth->role) && $Auth->role == 2 ) {?> 
                                <li class="flex-grow-1"> <a class="btn btn-primary w-100" href="javascript:void(0);" onclick="apply_sale(<?php echo $list->id?>);">Whitelist Now</a></li>
                                <li class="flex-grow-1"> <a class="btn btn-primary w-100 bg-transparent" href="javascript:void(0);">Application Status</a> </li>
                            <?php }else{?>
                                <li class="flex-grow-1"> <a class="btn btn-primary w-100" href="<?php echo SITEURL;?>sign-in?redirect=/explore/kyoko/apply">Login to Whitelist</a></li>
                            <?php }?>
                            
                            <?php }else if(strtolower($list->product_status) == 'whitelist closed'){?>
                                <li class="flex-grow-1"> <a class="btn btn-primary w-100 bg-transparent" href="javascript:void(0);">Sale Ended</a> </li>
                            <?php }else if(strtolower($list->product_status) == 'sold out'){?>
                                <li class="flex-grow-1"> <a class="btn btn-primary w-100 bg-transparent" href="javascript:void(0);">Sold Out</a> </li>
                            <?php }?>    
                            

                        </ul>
                    </div>
                </div>

                <?php if (!empty($timer_st)) { ?>
                    <div class="timers">
                        <div class="rounded">
                            <p class="mb-2 text-uppercase">SALE STARTS IN</p>
                            <div id="clock" class="countdown"></div>
                        </div>
                    </div>
                <?php }

                if (!empty($timer_end)) { ?>
                    <div class="timers">
                        <div class="rounded" id="sales_end">
                            <p class="mb-2 text-uppercase">SALE ENDS IN</p>
                            <div id="clock" class="countdown"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section class="item-detail-section ">
    <div class="container"></div>
</section>

<?php
if (!empty($timer_st)) {
    echo $this->Html->script(['jquery.countdown.min'], ['block' => 'scriptBottom']);
}
if (!empty($timer_end)) {
    echo $this->Html->script(['jquery.countdown.min'], ['block' => 'scriptBottom']);
}

if (!$this->request->is('mobile')) {
    echo $this->Html->script(['sticky-sidebar'], ['block' => 'scriptBottom']);
}
?>
<?php $this->Html->scriptStart(array('block' => 'scriptBottom')); ?>
function apply_sale(id) {
        var d = "<?php echo urlencode(SITEURL . "homes/apply_now/");?>"+id;
        $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>homes/open_pop/1',
            data: {url:d},
            success: function(data) {
                $("#cover").html(data);
            },
            error: function(comment) {
                $("#cover").html(comment);
            }
        });
}

<?php if (!empty($timer_st)) { ?>
    $(function () {
    $('#clock').countdown('<?php echo date("Y-m-d H:i:s", $timer_st); ?>').on('update.countdown', function(event) {
    var $this = $(this).html(event.strftime(''
    + '<span class="clockbx"><span class="font-weight-bold h1">%D</span> Day%!d</span> '
    + '<span class=" clockbx"><span class="h1 font-weight-bold h1">%H</span> Hr</span> '
    + '<span class="clockbx"><span class="h1 font-weight-bold h1">%M</span> Min</span>'
    + '<span class="clockbx"><span class="h1 font-weight-bold h1">%S</span>Sec</span>'));
    })
    .on('finish.countdown', function(event) { location.reload(); });
    });
<?php }  ?>

<?php if (!empty($timer_end)) { ?>
    $(function () {
    $('#clock').countdown('<?php echo date("Y-m-d H:i:s", $timer_end); ?>').on('update.countdown', function(event) {
    var $this = $(this).html(event.strftime(''
    + '<span class="clockbx"><span class="font-weight-bold h1">%D</span> Day%!d</span> '
    + '<span class=" clockbx"><span class="h1 font-weight-bold h1">%H</span> Hr</span> '
    + '<span class="clockbx"><span class="h1 font-weight-bold h1">%M</span> Min</span>'
    + '<span class="clockbx"><span class="h1 font-weight-bold h1">%S</span>Sec</span>'));
    })
    .on('finish.countdown', function(event) {
    $("#sales_end").html('<p class="mb-2 text-uppercase">This sale has ended!</p>');
    });
    });
<?php }  ?>

<?php if (!$this->request->is('mobile')) { ?>
    var a = new StickySidebar('.sidebarFixed', {
    topSpacing: 25,
    containerSelector: '.container',
    innerWrapperSelector: '.sidebar__inner'
    });
<?php }
$this->Html->scriptEnd(); ?>