<div id="custom-content" class="white-popup-block offer-pop" style="max-width:900px; margin: 20px auto;">

    <div class="app-contentcontent ">
        <div class="content-wrapper">
            <div class="content-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header email-detail-head">
                                <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="mail-items">
                                    <div class="mail-message"><b>To:</b> <?php echo $getData->email_to;?></div>
                                <div class="mail-message"><b>Subject:</b> <?php echo $getData->subject;?></div>
                                <hr>
                                    </div>
                                </div>
                                <div class="mail-meta-item d-flex align-items-center">
                                    <small class="mail-date-time text-muted"><?php echo $getData->modified->format('Y-m-d H:i:s');?></small>
                                </div>
                            </div>
                            <div class="card-body mail-message-wrapper pt-2">
                            
                                <div class="mail-message">
                                <?php echo $getData->message;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>