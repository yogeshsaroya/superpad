<?php
$this->assign('title', 'KYC');
echo $this->Html->css(['/app-assets/css/pages/app-invoice']); ?>
<style>
    #doc_type .card {
        padding: 50px;
    }
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">

                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 p-0">
                                        <h6 class="mb-2">User ID : #<?php echo $get_data->id; ?></h6>
                                        <p class="card-text mb-25"><?php echo $get_data->first_name . " " . $get_data->last_name; ?></p>
                                        <p class="card-text mb-25"><?php echo $get_data->email; ?></p>
                                        <h6 class="mb-25">KYC Submitted : <?php if (!empty($get_data->kyc_submitted)) echo $get_data->kyc_submitted->format('Y-m-d H:i:s'); ?></h6>

                                    </div>
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">KYC Details:</h6>

                                        <h5 class="mb-2">KYC Status:
                                            <?php 
                                            if($get_data->kyc_completed == 1){ echo '<div class="badge badge-glow badge-primary">Under Review</div>';}
                                            elseif($get_data->kyc_completed == 2){ echo '<div class="badge badge-glow badge-success">Approved</div>';}
                                            elseif($get_data->kyc_completed == 3){ echo '<div class="badge badge-glow badge-danger">Rejected</div>';}
                                            ?>

                                        
                                        
                                        </h5>

                                        <h6 class="mb-2">Full Name : #<?php echo $get_data->kyc_full_name; ?></h6>
                                        <h6 class="mb-25">Date of Birth : <?php echo $get_data->kyc_dob; ?></h6>
                                        <p class="card-text mb-25"><b>Address:</b></p>
                                        <p class="card-text mb-25"><?php echo $get_data->kyc_address . " " . $get_data->kyc_address; ?></p>
                                        <p class="card-text mb-25"><?php echo $get_data->kyc_city . ", " . $get_data->kyc_state . ", " . (isset($get_data->country->name) ? $get_data->country->name : null); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <?php if (!in_array($get_data->kyc_completed, [0, 2])) {
                                    echo $this->Html->Link('Reject', SITEURL . "pages/manage_kyc/" . $get_data->id . "?st=3", ['escape' => false, 'class' => 'btn btn-danger btn-block', 'onclick' => "return confirm('Are you sure you want to Reject this KYC?')"]);
                                    echo $this->Html->Link('Approve', SITEURL . "pages/manage_kyc/" . $get_data->id . "?st=2", ['escape' => false, 'class' => 'btn btn-success btn-block', 'onclick' => "return confirm('Are you sure you want to Approve this KYC?')"]);
                                } ?>
                                <?php echo $this->Html->Link('Back to Users', SITEURL . "pages/users/", ['escape' => false, 'class' => 'btn btn-dark btn-block']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card invoice-preview-card">

                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="card-body invoice-padding pt-0">
                                        <div class="card-group" id="doc_type">
                                            <div class="card">
                                                <a href="<?php echo SITEURL . "cdn/kyc/" . $get_data->kyc_user_pic; ?>" target="_blank">
                                                    <img class="card-img-top" src="<?php echo SITEURL . "cdn/kyc/" . $get_data->kyc_user_pic; ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title">User Photo</h4>
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="card">
                                                <a href="<?php echo SITEURL . "cdn/kyc/" . $get_data->kyc_doc_file; ?>" target="_blank">
                                                    <img class="card-img-top" src="<?php echo SITEURL . "cdn/kyc/" . $get_data->kyc_doc_file; ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Document Front Page</h4>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card">
                                                <a href="<?php echo SITEURL . "cdn/kyc/" . $get_data->kyc_doc_file_back; ?>" target="_blank">
                                                    <img class="card-img-top" src="<?php echo SITEURL . "cdn/kyc/" . $get_data->kyc_doc_file_back; ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Document Last Page</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Invoice Actions -->

                </div>
            </section>
        </div>
    </div>
</div>