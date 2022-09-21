<div id="custom-content" class="white-popup-block offer-pop" style="max-width:1200px; margin: 20px auto;">
    <style>
        tr th {
            text-align: center;
        }
    </style>

    <?php
    if ($data->available_token > 0) {
        echo $this->Html->script(['https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.1/web3.min.js', 'https://unpkg.com/@metamask/legacy-web3@latest/dist/metamask.web3.min.js']);
    }
    ?>

    <?php
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
                        <?php if ($percentage == 100) { ?>
                            <div class="table-responsive1" id="no-more-tables">
                                <table class="table mb-0 table-s1">
                                    <thead>
                                        <tr>
                                            <th scope="col">Claimable Tokens</th>
                                            <th scope="col">Claim After</th>
                                            <th scope="col">Claimed On</th>
                                            <th scope="col"> %</th>
                                            <th scope="col">Transaction Hash</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($data->claims) && !empty($data->claims)) {
                                            foreach ($data->claims as $list) { ?>
                                                <tr>
                                                    <td data-title="Claimable Tokens" class="text-center"><?php echo $list->total_token; ?></td>
                                                    <td data-title="Claim After" class="text-center"><?php echo (!empty($list->claim_from) ? $list->claim_from->format("Y-m-d h:i A") : null); ?></td>
                                                    <td data-title="Claim On" class="text-center" id="on_<?php echo $list->id; ?>"><?php echo (!empty($list->claimed_date) ? $list->claimed_date->format("Y-m-d h:i A") : null); ?></td>
                                                    <td data-title="%" class="text-center"><?php echo $list->percentage; ?>%</td>
                                                    <td data-title="Transaction Hash" class="text-center" id="hash_<?php echo $list->id; ?>"><?php echo (isset($list->transaction_id) ? $this->Html->link('View', env('bscscanHash') . 'tx/' . $list->transaction_id, ['target' => '_blank']) : null); ?></td>
                                                    <td data-title="Status" class="text-center" id="st_<?php echo $list->id; ?>">
                                                        <?php
                                                        if ($list->transaction_status == 1) {
                                                            echo '<span class="badge bg-light">Not Claimed</span>';
                                                        } elseif ($list->transaction_status == 2) {
                                                            echo '<span class="badge bg-warning">Panding</span>';
                                                        } elseif ($list->transaction_status == 3) {
                                                            echo '<span class="badge bg-success">Completed</span>';
                                                        } elseif ($list->transaction_status == 4) {
                                                            echo '<span class="badge bg-danger">Failed</span>';
                                                        }
                                                        ?> </td>
                                                    <td data-title="Action" class="text-center">
                                                        <?php if (in_array($list->transaction_status, [1, 4]) && strtotime(DATE) > strtotime($list->claim_from->format("Y-m-d H:i:s"))) { ?>
                                                            <input type="button" class="btn btn-success" value="Claim" id="btn_<?php echo $list->id; ?>" onclick="chk_claim(<?php echo $list->id ?>);" />
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-danger"> Tokens not available for claim yet. </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                <br><br>
                                <div id="sub_data"></div>
                                <div id="aj_res"></div>
                            </div>
                        <?php  } else {
                            echo '<h3 class="text-center text-danger">Allocation will be available soon.</h3>';
                        } ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php if ($data->available_token > 0) { ?>
        <script>
            const CLAIM_CONTRACT_ADDRESS = "<?php echo env('CLAIM_CONTRACT_ADDRESS'); ?>";
            const CLAIM_CONTRACT_ABI = [{
                    inputs: [{
                        internalType: "address",
                        name: "_BEP20Address",
                        type: "address",
                    }, ],
                    stateMutability: "nonpayable",
                    type: "constructor",
                },
                {
                    anonymous: false,
                    inputs: [{
                            indexed: true,
                            internalType: "address",
                            name: "previousOwner",
                            type: "address",
                        },
                        {
                            indexed: true,
                            internalType: "address",
                            name: "newOwner",
                            type: "address",
                        },
                    ],
                    name: "OwnershipTransferred",
                    type: "event",
                },
                {
                    inputs: [],
                    name: "BEP20Address",
                    outputs: [{
                        internalType: "contract IBEP20",
                        name: "",
                        type: "address",
                    }, ],
                    stateMutability: "view",
                    type: "function",
                },
                {
                    inputs: [{
                        internalType: "address",
                        name: "_BEP20Address",
                        type: "address",
                    }, ],
                    name: "ChangeTokenAddress",
                    outputs: [],
                    stateMutability: "nonpayable",
                    type: "function",
                },
                {
                    inputs: [{
                            internalType: "address",
                            name: "_claimer",
                            type: "address",
                        },
                        {
                            internalType: "uint256",
                            name: "_amount",
                            type: "uint256",
                        },
                    ],
                    name: "claim",
                    outputs: [],
                    stateMutability: "nonpayable",
                    type: "function",
                },
                {
                    inputs: [],
                    name: "owner",
                    outputs: [{
                        internalType: "address",
                        name: "",
                        type: "address",
                    }, ],
                    stateMutability: "view",
                    type: "function",
                },
                {
                    inputs: [],
                    name: "renounceOwnership",
                    outputs: [],
                    stateMutability: "nonpayable",
                    type: "function",
                },
                {
                    inputs: [{
                        internalType: "address",
                        name: "newOwner",
                        type: "address",
                    }, ],
                    name: "transferOwnership",
                    outputs: [],
                    stateMutability: "nonpayable",
                    type: "function",
                },
            ];

            var web3 = null;
            var instance = null;
            var chainId = null;

            async function changeToMain() {
                await ethereum.request({
                    method: "wallet_switchEthereumChain",
                    // params: [{ chainId: "0x38" }], //MAIN BSC
                    params: [{
                        chainId: "0x61"
                    }], //TESTNET BSC
                });
            }

            async function token_claim(id, num) {
                $("#sub_data").html('');
                $("#btn_locader").addClass('is-active');
                web3 = new Web3(Web3.givenProvider);
                await Web3.givenProvider.enable(); // waiting for metamask provider connectivity
                //   Get your metamask wallet provider Chain ID
                chainId = await web3.eth.getChainId();
                //   Request for get wallet address from metamask
                await ethereum
                    .request({
                        method: "eth_requestAccounts"
                    })
                    .then(async (account) => {
                        if (chainId != 97) {
                            await changeToMain();
                        }
                        //   Claim contract web3 instance
                        instance = new web3.eth.Contract(CLAIM_CONTRACT_ABI, CLAIM_CONTRACT_ADDRESS);
                        //   sending claim function tx from metamask selected account
                        instance.methods.claim(account[0], web3.utils.toWei('' + num + '', "ether"))
                            .send({
                                from: account[0]
                            })
                            .on("transactionHash", async (hash) => {
                                $("#btn_locader").attr('data-curtain-text', 'Processing...');
                                // get tx hash
                                console.log('Hello 1');
                                console.log(hash);
                                update_claim(id, num, 2, hash, '');
                                $('#sub_data').html('<div class="alert alert-info">Token claim process has been initiated. <a href="<?php echo env('bscscanHash'); ?>tx/' + hash + '" target="_blank">Click here </a> to check transaction status.</div>');
                            })
                            .on("receipt", async (receipt) => {
                                // receipt.status will return your tx status. true & false
                                console.log('Hello 2');
                                console.log(receipt);
                                if (receipt.status === true) {
                                    $("#btn_locader").attr('data-curtain-text', 'Token Claimed...');
                                    update_claim(id, num, 3, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-success">Tokens has been claimed successfully. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 1000);
                                } else {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction failed...');
                                    update_claim(id, num, 4, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 2000);
                                }
                            })
                            .on('confirmation', function(confirmationNumber, receipt) {
                                // console.log('Hello 3'); console.log(confirmationNumber);  console.log(receipt);
                            })
                            .on('error', function(error, receipt) {
                                console.log('Hello 4');
                                console.log(error);
                                console.log(receipt);
                                if (error.code === 4001) {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction Canceled...');
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed.</div>');
                                    }, 3000);
                                } else {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction failed...');
                                    update_claim(id, num, 4, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 3000);
                                }

                            });
                    });
            }

            function update_claim(id, num, status, transaction, tran_data) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo SITEURL; ?>users/update_claim',
                    data: {
                        id: id,
                        amt: num,
                        status: status,
                        transaction_id: transaction,
                        tran_data: tran_data
                    },
                    success: function(data) {
                        $("#aj_res").html(data);
                    },
                    error: function(comment) {
                        $("#aj_res").html(comment);
                    }
                });
            }

            function chk_claim(id) {
                $("#btn_locader").attr('data-curtain-text', 'Updating...');
                $("#btn_" + id).prop("disabled", true);
                $("#btn_" + id).val('wait...');
                $.ajax({
                    type: 'POST',
                    url: SITEURL + 'users/check_claim',
                    headers: {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#sub_data").html(data);
                        $("#btn_" + id).prop("disabled", false);
                        $("#btn_" + id).val('Claim');
                    },
                    error: function(comment) {
                        $("#sub_data").html(comment);
                        $("#btn_" + id).prop("disabled", false);
                        $("#btn_" + id).val('Claim');
                    }
                });


            };
        </script>
    <?php } ?>

</div>