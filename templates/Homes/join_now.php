<div id="custom-content" class="white-popup-block offer-pop" style="max-width:500px; margin: 20px auto;">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.1/web3.min.js"></script>
    <script src="https://unpkg.com/@metamask/legacy-web3@latest/dist/metamask.web3.min.js"></script>
    <style>
        .input_box {
            border-radius: 0px !important;
        }

        #setMax {
            cursor: pointer;
        }
    </style>
    <div class="app-contentcontent ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Join Now</h4>
                <button type="button" class="btn-close icon-btn" data-bs-dismiss="modal" aria-label="Close" onclick="$.magnificPopup.close();">
                    <em class="ni ni-cross"></em>
                </button>
            </div>
            <div class="modal-body">
                <?php if (empty($data)) { ?>
                    <div class="alert alert-danger d-flex mb-4" role="alert">
                        <svg class="flex-shrink-0 me-3" width="30" height="30" viewBox="0 0 24 24" fill="#ff6a8e">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"></path>
                        </svg>
                        <p class="fs-14">You have not applied for this sale or lottery ticket not allocated yet. check your email for lottery status</p>
                    </div>
                <?php } elseif ($data->user->kyc_completed != 2) { ?>
                    <div class="alert alert-danger d-flex mb-4" role="alert">
                        <svg class="flex-shrink-0 me-3" width="30" height="30" viewBox="0 0 24 24" fill="#ff6a8e">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20, 12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10, 10 0 0,0 12,2M11,17H13V11H11V17Z"></path>
                        </svg>
                        <p class="fs-14">Please complete your KYC to join this sale. <br><a href="<?php echo SITEURL; ?>users/kyc">Click Here</a> to complete KYC.</p>
                    </div>
                <?php } elseif ($data->user->kyc_completed == 2) {  ?>
                    <?php
                    echo $this->Form->create($data, [/*'url' => ['action' => 'updateJoinNow'],*/'autocomplete' => 'off', 'id' => 'e_frm',]);
                    echo $this->Form->hidden('id', ['id' => 'app_id',]);
                    echo $this->Form->hidden('max_amt', ['id' => 'max_amt', 'value' => $data->allocation]);
                    echo $this->Form->hidden('joined', ['id' => 'joined', 'value' => $data->joined]);
                    echo $this->Form->hidden('remaining', ['id' => 'remaining', 'value' => $data->remaining]);
                    echo $this->Form->hidden('max_tickets', ['id' => 'max_tickets', 'value' => $max_tickets]);
                    ?>

                    <label class="form-label">Enter Amount</label>
                    <div class="input-group mb-3">
                        <input type="text" name="amt" id="setAmt" class="form-control input_box" />
                        <div class="input-group-append" id="setMax"><span class="input-group-text input_box">Set Max</span></div>
                    </div>

                    <hr>
                    <ul class="total-bid-list mb-4">
                        <li><span>Max allocation: </span> <span class="text-bold"><?php echo $data->allocation . " " . $short_name; ?></span></li>
                        <li><span>Joined: </span> <span class="text-bold"><?php echo $data->joined . " " . $short_name; ?></span></li>
                        <li><span>Remaining: </span> <span class="text-bold"><?php echo $data->remaining . " " . $short_name; ?></span></li>
                        <?php if ($data->project->token_required == 1) { ?>
                            <li><span>You have </span> <span class="text-bold"><?php echo $max_tickets; ?> winning ticket(s)</span></li>
                        <?php } ?>
                    </ul>
                    <div id="f_err"></div>
                    <?php if ($data->remaining > 0) { ?>
                        <input type="button" class="w-100 btn btn-lg btn-outline-dark hide" value="Join Now" id="reg_sbtn" />
                        <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Join Now!" id="paybusd" onclick="payBUSD()" />
                    <?php } else { ?>
                        <input type="button" class="w-100 btn btn-lg btn-outline-dark" value="Close" onclick="$.magnificPopup.close();" />
                    <?php } ?>

                <?php echo $this->Form->end();
                }
                ?>
            </div>
        </div>
    </div>
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

        var web3 = null;
        var instance = null;
        var chainId = null;
        async function changeToMain(id) {
            await ethereum.request({
                method: "wallet_switchEthereumChain",
                params: [{
                    chainId: id
                }],
            });
        }

        async function payBUSD() {
            $("#btn_locader").addClass('is-active');
            var remaining = parseFloat($("#remaining").val());
            var setAmt = parseFloat($("#setAmt").val());

            var app_id = $("#app_id").val();
            var max_amt = $("#max_amt").val();
            var joined = $("#joined").val();
            var max_tickets = $("#max_tickets").val();

            if (setAmt > 0 && setAmt <= remaining) {
                web3 = new Web3(Web3.givenProvider);
                await Web3.givenProvider.enable();
                chainId = await web3.eth.getChainId();

                await ethereum
                    .request({
                        method: "eth_requestAccounts"
                    })
                    .then(async (account) => {
                        //if (chainId != 56) { await changeToMain("0x38"); }
                        if (chainId != 97) {
                            await changeToMain('0x61');
                        }
                        console.log(account);
                        instance = new web3.eth.Contract(BUSD_ABI, BUSD_CONTRACT);
                        instance.methods
                            .transfer(paymentAddress, web3.utils.toWei('' + setAmt + '', "ether"))
                            .send({
                                from: account[0]
                            })
                            .on('transactionHash', function(hash) {
                                console.log('Hello 1');
                                console.log(hash);
                            })
                            .on('receipt', function(receipt) {
                                console.log('Hello 2');
                                console.log(receipt.transactionHash);
                                update_tran(app_id, max_amt, joined, remaining, max_tickets, setAmt, receipt.transactionHash,receipt);
                            })
                            .on('confirmation', function(confirmationNumber, receipt) {
                                //console.log('Hello 3'); console.log(confirmationNumber); console.log(receipt);

                            })
                            .on('error', function(error, receipt) {
                                console.log(error);
                                $("#btn_locader").removeClass('is-active');
                                $('#f_err').html('<div class="alert alert-danger">Payment Failed</div>');
                            });
                    });
            } else {
                $('#f_err').html('<div class="alert alert-danger">Please enter amount between 0.1 to ' + max_amt + '</div>');
            }
        }

        async function payBNB() {
            var max_amt = parseFloat($("#remaining").val());
            var setAmt = parseFloat($("#setAmt").val());
            if (setAmt > 0 && setAmt <= max_amt) {

                web3 = new Web3(Web3.givenProvider);
                await Web3.givenProvider.enable();

                chainId = await web3.eth.getChainId();

                await ethereum
                    .request({
                        method: "eth_requestAccounts"
                    })
                    .then(async (account) => {
                        if (chainId != 56) {
                            await changeToMain('0x61');
                        }
                        web3.eth.sendTransaction({
                                from: account[0],
                                to: paymentAddress,
                                value: web3.utils.toWei('' + setAmt + '', "ether"),
                            },
                            (err, transactionId) => {
                                if (err) {
                                    console.log("Payment failed", err);

                                } else {
                                    console.log("Payment successful", transactionId);

                                }
                            }
                        );
                    });
            }
        }

        function update_tran(app_id, max_amt, joined, remaining, max_tickets, setAmt, transaction, tran_data) {
            $.ajax({
                type: 'POST',
                url: '<?php echo SITEURL; ?>homes/update_join_now',
                data: {
                    id: app_id,
                    max_amt: max_amt,
                    joined: joined,
                    remaining: remaining,
                    max_tickets: max_tickets,
                    amt: setAmt,
                    transaction_id: transaction,
                    tran_data: tran_data
                },
                success: function(data) {
                    $("#btn_locader").removeClass('is-active');
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
    </script>

</div>