<div id="custom-content" class="white-popup-block offer-pop" style="max-width:900px; margin: 20px auto;">
    <style>
        tr th {
            text-align: center;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.1/web3.min.js"></script>
    <script src="https://unpkg.com/@metamask/legacy-web3@latest/dist/metamask.web3.min.js"></script>

    <?php
    $arr = null;
    if (!empty($data)) {
        $arr = json_decode($data->info, true);
    }

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
                                        <th scope="col">Transaction Hash</th>
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
                                                <td data-title="%" class="text-center"><?php echo (isset($list['transaction_id']) ? $this->Html->link('View','https://bscscan.com/tx/'.$list['transaction_id'],['target'=>'_blank']) : null); ?></td>
                                                <td data-title="Status" class="text-center">
                                                    <?php if (empty($list['claim_on'])) { ?>
                                                        <input type="button" class="btn btn-success" value="Claim" id="btn_<?php echo $key; ?>" onclick="token_claim(<?php echo $key . ',' . $data->id.','.$list['total_token']; ?>);" />
                                                    <?php } else {
                                                        echo "Claimed";
                                                    } ?>

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
                            <div id="sub_data"> </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        const CLAIM_CONTRACT_ADDRESS = "0xb13ef804803b5aa8dd3aaf8ce4341a42421eeca4";
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

        async function token_claim(id, app_id,amt) {
            $("#sub_data").html('');
            $("#btn_locader").addClass('is-active');
           web3 = new Web3(Web3.givenProvider);
           await Web3.givenProvider.enable(); // waiting for metamask provider connectivity
            //   Get your metamask wallet provider Chain ID
            chainId = await web3.eth.getChainId();
            //   Request for get wallet address from metamask
            await ethereum
                .request({ method: "eth_requestAccounts" })
                .then(async (account) => {
                    if (chainId != 97) { await changeToMain(); }
                    //   Claim contract web3 instance
                    instance = new web3.eth.Contract( CLAIM_CONTRACT_ABI, CLAIM_CONTRACT_ADDRESS );
                    //   sending claim function tx from metamask selected account
                    instance.methods .claim(account[0], web3.utils.toWei('' + amt + '', "ether"))
                        .send({ from: account[0] })
                        .on("transactionHash", async (hash) => {
                            // get tx hash
                            console.log('Hello 1');
                            console.log(hash);
                        })
                        .on("receipt", async (receipt) => {
                            // receipt.status will return your tx status. true & false
                            console.log('Hello 2');
                            console.log(receipt);
                            if( receipt.status === true){
                                update_claim(id, app_id, amt, receipt.transactionHash,receipt)
                            }else{
                                $("#btn_locader").removeClass('is-active'); 
                                $('#sub_data').html('<div class="alert alert-danger">Tokens claim process has been failed.</div>');
                            }
                        })
                        .on('confirmation', function(confirmationNumber, receipt) {
                            // console.log('Hello 3'); console.log(confirmationNumber);  console.log(receipt);

                        })
                        .on('error', function(error, receipt) {
                            console.log(error);
                            $("#btn_locader").removeClass('is-active');
                            $('#sub_data').html('<div class="alert alert-danger">Tokens claim process has been failed.</div>');
                        });
                });
        }

        function update_claim(id, app_id, amt, transaction, tran_data) {
            $.ajax({
                type: 'POST',
                url: '<?php echo SITEURL; ?>users/update_claim',
                data: {
                    id: id, app_id: app_id, amt: amt, transaction_id: transaction, tran_data: tran_data
                },
                success: function(data) {
                    $("#btn_locader").removeClass('is-active');
                    $("#sub_data").html(data);
                },
                error: function(comment) {
                    $("#btn_locader").removeClass('is-active');
                    $("#sub_data").html(comment);
                }
            });
        }

        function mk_claim_remvoe(id, app_id) {

            $("#btn_" + id).prop("disabled", true);
            $("#btn_" + id).val('wait...');
            $.ajax({
                type: 'POST',
                url: SITEURL + 'users/update_claim',
                headers: {
                    'X-CSRF-Token': $('[name="_csrfToken"]').val()
                },
                data: {
                    id: id,
                    app_id: app_id
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

</div>