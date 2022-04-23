<div id="custom-content" class="white-popup-block offer-pop" style="max-width:900px; margin: 20px auto;">
    <style>
        tr th {
            text-align: center;
        }
    </style>
    <?php
    $arr = null;
    if(!empty($data)){$arr = json_decode($data->info, true);}
    
    echo $this->Form->create(null);
    echo $this->Form->end();
    ?>
    <div class="app-contentcontent ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Claim Progress</h4>
                <button type="button" class="btn-close icon-btn" data-bs-dismiss="modal" aria-label="Close" onclick="$.magnificPopup.close();">
                    <em class="ni ni-cross"></em>
                </button>
            </div>
            <div class="modal-body">
                <section class="ranking-section section-space-b">
                    <div class="container">
                        <div class="table-responsive1" id="no-more-tables">
                            <table class="table mb-0 table-s1">
                                <thead>
                                    <tr>
                                        <th scope="col">Claimable Tokens</th>
                                        <th scope="col">Claim Before</th>
                                        <th scope="col">Claimed On</th>
                                        <th scope="col"> %</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($arr)) {
                                        foreach ($arr as $key => $list) {
                                    ?>
                                            <tr>
                                                <td data-title="Claimable Tokens" class="text-center"><?php echo $list['total_token']; ?></td>
                                                <td data-title="Claim Before" class="text-center"><?php echo date("Y-m-d H:i A", strtotime($list['claim_before'])); ?></td>
                                                <td data-title="Claim On" class="text-center" id="on_<?php echo $key; ?>"><?php echo (!empty($list['claim_on']) ? date("Y-m-d H:i A", strtotime($list['claim_on'])) : null); ?></td>
                                                <td data-title="%" class="text-center"><?php echo $list['percentage']; ?>%</td>
                                                <td data-title="Status" class="text-center">
                                                    <?php if (empty($list['claim_on'])) { ?>
                                                        <input type="button" class="btn btn-success" value="Claim" id="btn_<?php echo $key; ?>" onclick="mk_claim(<?php echo $key.','.$data->id; ?>);" />
                                                    <?php }else{ echo "Claimed";} ?>

                                                </td>
                                            </tr>
                                    <?php }
                                    }else{ ?>
                                    <tr> <td colspan="5" class="text-center text-danger"> Tokens not available for claim yet. </td> </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                            <div id="sub_data"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        
            function mk_claim(id,app_id) {

                $("#btn_" + id).prop("disabled", true); $("#btn_" + id).val('wait...');
                $.ajax({
                    type: 'POST',
                    url: SITEURL + 'users/update_claim',
                    headers: {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                    data: {id:id,app_id:app_id},
                    success: function(data) {
                        $("#sub_data").html(data); $("#btn_" + id).prop("disabled", false); $("#btn_" + id).val('Claim');
                    },
                    error: function(comment) {
                        $("#sub_data").html(comment); $("#btn_" + id).prop("disabled", false); $("#btn_" + id).val('Claim');

                    }
                });


            };
        
    </script>

</div>