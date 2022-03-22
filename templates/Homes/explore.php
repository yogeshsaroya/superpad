<section class="explore-section pt-lg-4" id="project_list">
    <div class="container">
        <div class="filter-box pb-5">
            <div class="filter-box-filter justify-content-between align-items-center">
                <div class="filter-box-filter-item form-choice-wrap">
                    <select class="form-choice filter-select">
                        <option value="*">All</option>
                        <option value=".artworks">Artworks</option>
                        <option value=".music">Music</option>
                        <option value=".games">Games</option>
                        <option value=".collectibles">Collectibles</option>
                    </select>
                </div><!-- end filter-box-filter-item -->
                <div class="filter-box-filter-item quicksearch-wrap">
                    <input type="text" placeholder="Search By Name" class="form-control form-control-s1 quicksearch">
                </div><!-- end filter-box-filter-item -->
                <div class="filter-box-filter-item ms-lg-auto filter-btn-wrap">
                    <div class="filter-btn-group">
                        <a href="#" class="btn filter-btn">Recent</a>
                        <a href="#" class="btn filter-btn">Price: Low</a>
                        <a href="#" class="btn filter-btn">Price: High</a>
                    </div>
                </div><!-- end filter-box-filter-item -->
                <div class="filter-box-filter-item filter-mobile-action ms-lg-auto">
                    <div class="filter-box-search-mobile dropdown me-2">
                        <a class="icon-btn" href="#" data-bs-toggle="dropdown">
                            <em class="ni ni-search"></em>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end card-generic card-generic-s2 mt-2 p-3">
                            <input type="text" placeholder="Search By Name" class="form-control form-control-s1 quicksearch">
                        </div>
                    </div><!-- end filter-box-search-mobile -->
                    <div class="filter-box-btn-group-mobile dropdown">
                        <a class="icon-btn" href="#" data-bs-toggle="dropdown">
                            <em class="ni ni-filter"></em>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end card-generic mt-2 p-3">
                            <div class="filter-btn-group filter-btn-group-s1">
                                <a href="#" class="btn filter-btn">Recent</a>
                                <a href="#" class="btn filter-btn">Price: Low</a>
                                <a href="#" class="btn filter-btn">Price: High</a>
                            </div>
                        </div>
                    </div><!-- end filter-box-btn-group-mobile -->
                </div><!-- end filter-box-filter-item -->
            </div><!-- end filter-box-filter -->
        </div><!-- end filter-box -->
        <div class="filter-container row g-gs">
            <?php for ($i = 0; $i < 20; $i++) { ?>
                <div class="col-xl-4 col-lg-4 col-sm-6 filter-item">
                    <div class="card card-full">
                        <a href="product-details-v1.html" class="card-image">
                        <span class="badge rounded-pill bg-success">Comming soon</span>
                            <img src="images/thumb/nft-2.jpg" class="card-img-top" alt="art image">
                        </a>
                        <img src="<?php echo SITEURL; ?>img/tether.svg" width="64px" alt="" />
                        <div class="card-body p-4">
                            <h5 class="card-title text-truncate mb-0"><a href="product-details-v1.html">One Tribe Black Edition</a>
                            <img src="<?php echo SITEURL; ?>img/icon/eth.svg" width="32px" alt="" />
                        </h5>
                        <div class="card-author mb-1 d-flex align-items-center">
                            <span class="me-1 card-author-by">IDO Date</span>
                            <div class="custom-tooltip-wrap">
                                10/10/2022 09:00 AM

                            </div><!-- end custom-tooltip-wrap -->
                        </div><!-- end card-author -->
                        <div class="card-price-wrap d-flex align-items-center justify-content-sm-between mb-3">
                            <div class="me-5 me-sm-2">
                                <span class="card-price-title">Allocation</span>
                                <span class="card-price-number">$14.20</span>
                            </div>
                            <div class="text-sm-end">
                                <span class="card-price-title">Fund Raise</span>
                                <span class="card-price-number">1.32 ETH</span>
                            </div>
                        </div><!-- end card-price-wrap -->
                        <button class="btn btn-sm btn-dark">IDO</button>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            <?php } ?>

        </div><!-- end filter-container -->
    </div><!-- .container -->
</section><!-- end explore-section -->