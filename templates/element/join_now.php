<style>
    .input_box {
        border-radius: 0px !important;
    }

    #setMax {
        cursor: pointer;
    }
</style>
<div class="app-contentcontent">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Join Now</h4>
        </div>
        <div class="modal-body">
            <?php if (empty($join_data)) {  ?>
                <div class="alert alert-danger d-flex mb-4" role="alert">
                    <svg class="flex-shrink-0 me-3" width="30" height="30" viewBox="0 0 24 24" fill="#ff6a8e">
                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"></path>
                    </svg>
                    <p class="fs-14">You have not applied for this sale or lottery ticket not allocated yet. check your email for lottery status</p>
                </div>
            <?php } elseif ($join_data->user->kyc_completed != 2) { ?>
                <div class="alert alert-danger d-flex mb-4" role="alert">
                    <svg class="flex-shrink-0 me-3" width="30" height="30" viewBox="0 0 24 24" fill="#ff6a8e">
                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"></path>
                    </svg>
                    <p class="fs-14">Please complete your KYC to join this sale. <br><a href="<?php echo SITEURL; ?>users/kyc">Click Here</a> to complete KYC.</p>
                </div>
            <?php } elseif ($join_data->user->kyc_completed == 2) {  ?>
                <?php

                echo $this->Form->create($join_data, [/*'url' => ['action' => 'updateJoinNow'],*/'autocomplete' => 'off', 'id' => 'e_frm',]);
                echo $this->Form->hidden('id', ['id' => 'app_id',]);
                echo $this->Form->hidden('max_amt', ['id' => 'max_amt', 'value' => $join_data->allocation]);
                echo $this->Form->hidden('joined', ['id' => 'joined', 'value' => $join_data->joined]);
                echo $this->Form->hidden('remaining', ['id' => 'remaining', 'value' => $join_data->remaining]);
                echo $this->Form->hidden('max_tickets', ['id' => 'max_tickets', 'value' => $max_tickets]);
                ?>

                <?php if (empty($is_pending)) { ?>
                    <label class="form-label">Enter Amount</label>
                    <div class="input-group mb-3">
                        <input type="text" name="amt" id="setAmt" class="form-control input_box" />
                        <div class="input-group-append" id="setMax"><span class="input-group-text input_box">Set Max</span></div>
                    </div>
                    <hr>
                <?php } ?>
                <ul class="total-bid-list mb-4">
                    <li><span>Max allocation: </span> <span class="text-bold"><?php echo $join_data->allocation . " " . $short_name; ?></span></li>
                    <li><span>Joined: </span> <span class="text-bold"><?php echo $join_data->joined . " " . $short_name; ?></span></li>
                    <li><span>Remaining: </span> <span class="text-bold"><?php echo $join_data->remaining . " " . $short_name; ?></span></li>
                    <?php if ($join_data->project->token_required == 1) { ?>
                        <li><span>You have </span> <span class="text-bold"><?php echo $max_tickets; ?> winning ticket(s)</span></li>
                    <?php } ?>
                </ul>
                <div id="f_err"></div>
                <?php if ($join_data->remaining > 0) {
                    if (empty($is_pending)) {
                        echo '<input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Join Now!" id="paybusd" onclick="payBUSD()" />';
                    } else {
                        echo '<div class="alert alert-danger">Your last transaction is still in progress. Please wait for transaction confirmation then after you can make payment for join sales.</div>';
                    }
                ?>

                <?php } else { ?>
                    <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Close" onclick="$.magnificPopup.close();" />
                <?php } ?>

            <?php echo $this->Form->end();
            }
            ?>
        </div>
    </div>
</div>
<?php $this->append('scriptBottom'); ?>
<script>
    const paymentAddress = "0x819D387045e7853ce0C0126ee4D69ce61047593E";
    const BUSD_CONTRACT = "0x50adc5ac7ba0c3676ecdb0a2e9cd448325e6f3a2";
    const BUSD_ABI = [{
            "inputs": [],
            "stateMutability": "nonpayable",
            "type": "constructor"
        },
        {
            "anonymous": false,
            "inputs": [{
                    "indexed": true,
                    "internalType": "address",
                    "name": "owner",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "internalType": "address",
                    "name": "spender",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "internalType": "uint256",
                    "name": "value",
                    "type": "uint256"
                }
            ],
            "name": "Approval",
            "type": "event"
        },
        {
            "inputs": [{
                    "internalType": "address",
                    "name": "spender",
                    "type": "address"
                },
                {
                    "internalType": "uint256",
                    "name": "amount",
                    "type": "uint256"
                }
            ],
            "name": "approve",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [{
                "internalType": "uint256",
                "name": "amount",
                "type": "uint256"
            }],
            "name": "burn",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [{
                    "internalType": "address",
                    "name": "spender",
                    "type": "address"
                },
                {
                    "internalType": "uint256",
                    "name": "subtractedValue",
                    "type": "uint256"
                }
            ],
            "name": "decreaseAllowance",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [{
                    "internalType": "address",
                    "name": "spender",
                    "type": "address"
                },
                {
                    "internalType": "uint256",
                    "name": "addedValue",
                    "type": "uint256"
                }
            ],
            "name": "increaseAllowance",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [{
                "internalType": "uint256",
                "name": "amount",
                "type": "uint256"
            }],
            "name": "mint",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "anonymous": false,
            "inputs": [{
                    "indexed": true,
                    "internalType": "address",
                    "name": "previousOwner",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "internalType": "address",
                    "name": "newOwner",
                    "type": "address"
                }
            ],
            "name": "OwnershipTransferred",
            "type": "event"
        },
        {
            "inputs": [],
            "name": "renounceOwnership",
            "outputs": [],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [{
                    "internalType": "address",
                    "name": "recipient",
                    "type": "address"
                },
                {
                    "internalType": "uint256",
                    "name": "amount",
                    "type": "uint256"
                }
            ],
            "name": "transfer",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "anonymous": false,
            "inputs": [{
                    "indexed": true,
                    "internalType": "address",
                    "name": "from",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "internalType": "address",
                    "name": "to",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "internalType": "uint256",
                    "name": "value",
                    "type": "uint256"
                }
            ],
            "name": "Transfer",
            "type": "event"
        },
        {
            "inputs": [{
                    "internalType": "address",
                    "name": "sender",
                    "type": "address"
                },
                {
                    "internalType": "address",
                    "name": "recipient",
                    "type": "address"
                },
                {
                    "internalType": "uint256",
                    "name": "amount",
                    "type": "uint256"
                }
            ],
            "name": "transferFrom",
            "outputs": [{
                "internalType": "bool",
                "name": "",
                "type": "bool"
            }],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [{
                "internalType": "address",
                "name": "newOwner",
                "type": "address"
            }],
            "name": "transferOwnership",
            "outputs": [],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "_decimals",
            "outputs": [{
                "internalType": "uint8",
                "name": "",
                "type": "uint8"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "_name",
            "outputs": [{
                "internalType": "string",
                "name": "",
                "type": "string"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "_symbol",
            "outputs": [{
                "internalType": "string",
                "name": "",
                "type": "string"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [{
                    "internalType": "address",
                    "name": "owner",
                    "type": "address"
                },
                {
                    "internalType": "address",
                    "name": "spender",
                    "type": "address"
                }
            ],
            "name": "allowance",
            "outputs": [{
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [{
                "internalType": "address",
                "name": "account",
                "type": "address"
            }],
            "name": "balanceOf",
            "outputs": [{
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "decimals",
            "outputs": [{
                "internalType": "uint8",
                "name": "",
                "type": "uint8"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "getOwner",
            "outputs": [{
                "internalType": "address",
                "name": "",
                "type": "address"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "name",
            "outputs": [{
                "internalType": "string",
                "name": "",
                "type": "string"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "owner",
            "outputs": [{
                "internalType": "address",
                "name": "",
                "type": "address"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "symbol",
            "outputs": [{
                "internalType": "string",
                "name": "",
                "type": "string"
            }],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [],
            "name": "totalSupply",
            "outputs": [{
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
            }],
            "stateMutability": "view",
            "type": "function"
        }
    ];

    "use strict";
    const Web3Modal = window.Web3Modal.default;
    const WalletConnectProvider = window.WalletConnectProvider.default;
    let web3Modal;
    let provider;
    let wallet_address;

    function init() {
        const options = new WalletConnectProvider({
            rpc: {
                <?php echo (int)env('chain_id'); ?>: "<?php echo env('dataseed'); ?>"
            },
            infuraId: "<?php echo env('infuraId'); ?>"
        });
        const providerOptions = {
            walletconnect: {
                package: WalletConnectProvider,
                options: options,
            },
        };

        web3Modal = new Web3Modal({
            cacheProvider: false,
            providerOptions
        });
    }

    async function changeToMain(id) {
        try {
            await ethereum.request({
                method: "wallet_switchEthereumChain",
                params: [{
                    chainId: id
                }],
            });
        } catch (error) {
            console.log("Wrong network");

        }
    }


    async function fetchAccountData() {

    }
    async function payBUSD111() {
        $('#f_err').html('');
        console.log("Opening a dialog", web3Modal);
        try {
            provider = await web3Modal.connect();
            console.log("provider", provider);
        } catch (e) {
            console.log("Connection Error");
            console.log("Could not get a wallet connection", e);
            return;
        }
        // Subscribe to accounts change
        provider.on("accountsChanged", (accounts) => {
            console.log("Account Changed");
            fetchAccountData();
        });

        // Subscribe to chainId change
        provider.on("chainChanged", (chainId) => {
            console.log("ChainID Changed");
            fetchAccountData();
        });

        // Subscribe to networkId change
        provider.on("networkChanged", (networkId) => {
            console.log("Network Changed");
            fetchAccountData();
        });

        await make_pmt();
    }

    async function payBUSD() {
        $('#f_err').html('');
        var remaining = parseFloat($("#remaining").val());
        var setAmt = parseFloat($("#setAmt").val());

        var app_id = $("#app_id").val();
        var max_amt = $("#max_amt").val();
        var joined = $("#joined").val();
        var max_tickets = $("#max_tickets").val();

        if (setAmt > 0 && setAmt <= remaining) {
            try {
                provider = await web3Modal.connect();
                console.log("provider", provider);
                const web3 = new window.Web3(provider);
                let chainId = await web3.eth.getChainId();
                //if (chainId != 56) { await changeToMain("0x38"); }
                if (chainId != 97) {
                    await changeToMain("0x61");
                }

                const accounts = await web3.eth.getAccounts();
                wallet_address = accounts[0].toLowerCase();
                console.log("Got accounts", wallet_address);
                console.log('Chain ID', chainId);

                if (chainId == 97) {
                    if (wallet_address != '<?php echo strtolower($join_data->user->metamask_wallet_id) ?>') {
                        $("#btn_locader").removeClass('is-active');
                        $('#f_err').html('<div class="alert alert-danger">Wallet address mismatch (' + wallet_address + '). Your account was created by using wallet address <?php echo strtolower($join_data->user->metamask_wallet_id); ?>. Please switch to same wallet address to join sale.</div>');
                    } else {
                        $("#btn_locader").addClass('is-active');
                        const contract = new web3.eth.Contract(BUSD_ABI, BUSD_CONTRACT);
                        await contract.methods
                            .transfer(
                                paymentAddress,
                                web3.utils.toWei(setAmt.toString(), "ether")
                            )
                            .send({
                                from: wallet_address
                            })
                            .on('transactionHash', function(hash) {
                                console.log('tran ini ', hash);
                                $("#btn_locader").attr('data-curtain-text', 'Transaction initiated...');
                                $("#btn_locader").addClass('is-active');
                                update_tran(app_id, 2, wallet_address, chainId, 'busd', setAmt, hash, null);
                            })
                            .on('receipt', function(receipt) {
                                $("#btn_locader").addClass('is-active');
                                console.log('transaction completed');
                                console.log(receipt.status);
                                console.log(receipt.transactionHash);
                                if (receipt.status === true) {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction completed...');
                                    update_tran(app_id, 3, wallet_address, chainId, 'busd', setAmt, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-success">Transaction has been completed. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 1000);
                                } else {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction failed...');
                                    update_tran(app_id, 4, wallet_address, chainId, 'busd', setAmt, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Transaction has been failed. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 2000);
                                }

                            })
                            .on('confirmation', function(confirmationNumber, receipt) {

                            })
                            .on('error', function(error) {
                                console.log('On error ', error);
                                if (error.code === 4001) {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction Canceled...');
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#f_err').html('<div class="alert alert-danger">Transaction Failed. ' + error.message + '</div>');
                                    }, 3000);
                                } else {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction failed...');
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#f_err').html('<div class="alert alert-danger">Transaction Failed. ' + error.message + '</div>');
                                    }, 3000);
                                }
                            });
                    }
                } else {
                    $("#btn_locader").removeClass('is-active');
                    $('#f_err').html('<div class="alert alert-danger">Please switch to chain ID 97 ( Binance Smart Chain ) to join sale.</div>');
                }
            } catch (e) {
                $("#btn_locader").removeClass('is-active');
                console.log("Error catched");
                $('#f_err').html('<div class="alert alert-danger">' + e.message + '</div>');
                return;
            }
        } else {
            $("#btn_locader").removeClass('is-active');
            $('#f_err').html('<div class="alert alert-danger">Please enter amount between 0.1 to ' + max_amt + '</div>');
        }
    }

    function update_tran(app_id, status, wallet_address, chain_id, currency, amount, transaction, tran_data) {
        $.ajax({
            type: 'POST',
            url: '<?php echo SITEURL; ?>homes/update_join_now',
            data: {
                id: app_id,
                status: status,
                wallet_address: wallet_address,
                chain_id: chain_id,
                currency: currency,
                amount: amount,
                transaction_id: transaction,
                transaction_data: tran_data
            },
            success: function(data) {
                $("#f_err").html(data);
            },
            error: function(comment) {
                $("#btn_locader").removeClass('is-active');
                $("#f_err").html(comment);
            }
        });
    }

    $(document).ready(function() {
        function getPer(obj, num) {
            var n = 0;
            for (const [key, value] of Object.entries(obj)) {
                if (num <= key) {
                    n = value;
                    break;
                }
            }
            return n;
        }
        $("#setMax").click(function() {
            $("#setAmt").val($("#remaining").val());
        })

        $("#reg_sbtn").click(function() {
            var max_amt = parseFloat($("#remaining").val());
            var setAmt = parseFloat($("#setAmt").val());
            if (setAmt > 0 && setAmt <= max_amt) {
                $("#e_frm").ajaxForm({
                    target: '#f_err',
                    headers: {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                    beforeSubmit: function() {
                        console.log('clicked');
                        $("#reg_sbtn").prop("disabled", true);
                        $("#reg_sbtn").val('Please wait..');
                    },
                    success: function(response) {
                        $("#reg_sbtn").prop("disabled", false);
                        $("#reg_sbtn").val('Join Now');
                    },
                    error: function(response) {
                        $('#f_err').html('<div class="alert alert-danger">Sorry, this is not working at the moment. Please try again later.</div>');
                        $("#reg_sbtn").prop("disabled", false);
                        $("#reg_sbtn").val('Join Now');
                    },
                }).submit();
            } else {
                $('#f_err').html('<div class="alert alert-danger">Please enter amount between 0.1 to ' + max_amt + '</div>');
            }
        });
    });
    init();
</script>
<?php $this->end(); ?>