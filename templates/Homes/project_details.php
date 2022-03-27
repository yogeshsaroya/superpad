<style>
    .ps--project-show .ps--project-show__secondary {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .ps--project-show__status {
        display: flex;
        align-items: center;
        margin-left: auto;
    }
    .ps--project-show__status button {
        border: 0;
        background: transparent;
        max-width: 20px;
        margin-left: 15px;
    }
    .ps--badge.ps--secondary {
        border-color: #98aac0;
        border-color: #9caabc;
        background-color: #98aac0;
        background-color: #9caabc;
        color: #171d26;
        color: #fff;
            padding: 0.1875rem 0.375rem;
        border-radius: 0.25rem;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-align: center;
        align-items: center;
        border: 0.0625rem solid;
        white-space: nowrap;
    }
    .ps--project-show .breadcrumb {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding: 0;
    margin-bottom: 0;
    font-size: .8125rem;
    list-style: none;
}
    .ps--project-show  .breadcrumb a {
    color: #8c96a6;
        text-decoration: none;
    }
    .breadcrumb-item+.breadcrumb-item:before {
    float: left;
    padding-right: 0.5rem;
    color: #717988;
    content: "/";
}
.breadcrumb-item.active {
    color: #e2e4e9;
    color: #0a0c10;
}

.ps--project-show__main {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    margin-bottom: 3.5rem;
}
.ps--project-show__logo img {
    height: 5rem;
    width: 5rem;
        border-radius: 100%;
    margin-right: 20px;
}
.ps--project-show__status {
    grid-gap: 1rem;
    gap: 1rem;
    margin-left: auto;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}
.ps--project-show__title {
    color: #e2e4e9;
    color: #0a0c10;
    margin-bottom: 0;
}
.ps--badge.ps--ido {
    background-color: rgba(73,87,203,.16);
    color: #3a46a2;
    padding: 0.1875rem 0.375rem;
    border-radius: 0.25rem;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -ms-flex-align: center;
    align-items: center;
    border: 0.0625rem solid;
    white-space: nowrap;
}
.ps--project-show__subtitle {
    color: #4e5665;
    margin-bottom: 0;
    font-weight: 400;
    font-size: 1.125rem;
    line-height: 1.875rem;
}
 .item-detail-content.sidebars {
    padding: 2rem;
    grid-gap: 1.5rem;
    gap: 1.5rem;
    border: 1px solid #e2e4e9;
    border-radius: 10px;
}
.card-price-wrap .card-price-title {
    font-size: 16px;
    font-weight: 600;
    color: #05050c;
}
.card-price-wrap > div > span {
    font-size: 16px;
    margin: 0.8rem 0 0 !important;
    color: #05050c;
}
</style>
<?php
$list = $data;
$this->assign('title', $list->title . ' : SuperPAD');
?>
<section class="item-detail-section ">
    <div class="container">
        <div class="ps--project-show">
<div class="ps--project-show__secondary">
<nav class="ps--project-show__breadcrumb" aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="/projects">Projects</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
CryptoCitizen
</li>
</ol>
</nav>
<div class="ps--project-show__status">
<div class="ps--project-show__date d-none" data-project-partial-target="nextDateHolder">
<span data-project-partial-target="nextDatePrefix"></span>
<span data-project-partial-target="nextDateLabel" data-partial-type="topNav"></span>
<div data-bs-toggle="tooltip" data-bs-placement="left" title="" data-controller="tooltip" data-project-partial-target="nextDateTooltip" class="d-none" data-bs-original-title="12 Aug 2021, 12:00 PM UTC">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M8 0C3.6 0 0 3.6 0 8C0 12.4 3.6 16 8 16C12.4 16 16 12.4 16 8C16 3.6 12.4 0 8 0ZM9 12H7V7H9V12ZM8 6C7.4 6 7 5.6 7 5C7 4.4 7.4 4 8 4C8.6 4 9 4.4 9 5C9 5.6 8.6 6 8 6Z" fill="#212121"></path>
</svg>
</div>
</div>
<div class="ps--badge ps--secondary" data-project-partial-target="status">Allowlist Closed</div>
<div class="ps--project-show__share" data-controller="project-social" data-id="54">
<button type="button" data-bs-toggle="dropdown" aria-expanded="false">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M17 6L12 0L7 6H11V17H13V6H17Z" fill="#828997"></path>
<path d="M22 23H2C1.84623 23 1.69452 22.9646 1.55667 22.8965C1.41882 22.8283 1.29854 22.7293 1.20519 22.6071C1.11183 22.4849 1.04791 22.3429 1.01839 22.192C0.988873 22.041 0.994556 21.8854 1.035 21.737L4.035 10.737C4.09271 10.5253 4.21845 10.3385 4.39283 10.2053C4.56722 10.0721 4.78057 9.99996 5 10H8V12H5.764L3.31 21H20.69L18.236 12H16V10H19C19.2194 9.99996 19.4328 10.0721 19.6072 10.2053C19.7815 10.3385 19.9073 10.5253 19.965 10.737L22.965 21.737C23.0054 21.8854 23.0111 22.041 22.9816 22.192C22.9521 22.3429 22.8882 22.4849 22.7948 22.6071C22.7015 22.7293 22.5812 22.8283 22.4433 22.8965C22.3055 22.9646 22.1538 23 22 23Z" fill="#828997"></path>
</svg>
</button>

</div>
</div>
</div>
</div>


<div class="ps--project-show__main">
<div class="ps--project-show__logo">
<img class="ps--table__project-img" src="https://storage.googleapis.com/polkastarter-production-assets/jojahimbvu38dwjbrr8oh9p01oh9">
</div>
<div class="ps--project-show__information">
<div class="ps--project-show__status">
<h1 class="ps--project-show__title">CryptoCitizen</h1>
<div class="ps--badge ps--ido">ido</div>
</div>
<h2 class="ps--project-show__subtitle">Become the Metaverse highest ranking citizen</h2>
</div>
</div>


        <div class="row align-items-start">
            <div class="col-lg-8">
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
            <div class="col-lg-4 mt-lg-0 mt-5">
                <div class="item-detail-content mt-4 mt-lg-0 sidebars">
                    <h1 class="item-detail-title mb-2"><?php echo $list->title; ?></h1>
                    <div class="item-detail-meta d-flex flex-wrap align-items-center mb-3">
                        <div class="card-price-wrap  mb-3">
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Ticket Allocation</span>
                                <span class="card-price-number text-end">$250.00</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center col-12">
                                <span class="card-price-title">Fund Raise</span>
                                <span class="card-price-number text-end">$150,000.00</span>
                            </div>
                        </div>
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
    </div>
</section>