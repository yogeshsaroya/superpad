<?php $this->assign('title', 'Allocations');
?>
<div id="btn_locader" class="loader loader-curtain" data-curtain-text="Updating..."></div>
<style>
    tr th {
        text-align: center;
    }
</style>
<?php
echo $this->Form->create(null);
echo $this->Form->end();

?>

<section class="about-section pt-5 mt-3 cta-section section-space-b bg-pattern">
    <div class="container pt-5 pb-5">
        <div class="pb-5">
            <div class="profile-setting-panel">
                <h3 class="mb-1 text-center"><?php echo $data->project->title; ?></h3>
                <p class="mb-4 fs-14 text-center"><?php echo $data->project->heading; ?></p>
                <div class="row g-gs">
                    <div class="app-contentcontent ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Token Claim Progress <sub><small>(<?php echo $data->project->ticker; ?>)</small></sub> </h4>
                            </div>
                            <div class="modal-body">
                                <section class="ranking-section section-space-b">
                                    <div class="container">
                                        
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
                                                            foreach ($data->claims as $list) { 
                                                                //ec($list);
                                                            ?>
                                                                <tr>
                                                                    <td data-title="Claimable Tokens" class="text-center"><?php echo $list->total_token . " " . strtolower($data->project->ticker); ?></td>
                                                                    <td data-title="Claim After" class="text-center"><?php echo (!empty($list->claim_from) ? $list->claim_from->format("Y-m-d h:i A") : null); ?></td>
                                                                    <td data-title="Claim On" class="text-center" id="on_<?php echo $list->id; ?>"><?php echo (!empty($list->claimed_date) ? $list->claimed_date->format("Y-m-d h:i A") : null); ?></td>
                                                                    <td data-title="%" class="text-center"><?php echo $list->percentage; ?>%</td>
                                                                    <td data-title="Transaction Hash" class="text-center" id="hash_<?php echo $list->id; ?>"><?php echo (!empty($list->transaction_id) ? $this->Html->link('View', env('bscscanHash') . 'tx/' . $list->transaction_id, ['target' => '_blank']) : null); ?></td>
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
                                                                        <?php if ( !empty($list->uuid) && in_array($list->transaction_status, [1, 4]) && strtotime(DATE) > strtotime($list->claim_from->format("Y-m-d H:i:s"))) { ?>
                                                                            <input type="button" class="btn btn-success" value="Claim" id="btn_<?php echo $list->id; ?>" onclick="chk_claim(<?php echo $list->id ?>);" />
                                                                        <?php }elseif(in_array($list->transaction_status, [1, 4])){
                                                                            echo '<span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Your tokens are in review and will be available soon for claim.">In Review</span>';
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
                                                <div id="sub_data"></div>
                                                <div id="aj_res"></div>
                                            </div>
                                        
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?php $this->append('scriptBottom'); ?>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
<?php $this->end(); ?>

<?php if ($data->available_token > 0) {
    $this->append('scriptBottom');
?>
    <script>
        "use strict";

        const CLAIM_CONTRACT_ADDRESS = "<?php echo $contract->claim_token_contract_address; ?>";
        const CLAIM_CONTRACT_ABI = <?php echo $contract->claim_token_contract_abi; ?>;


        const Web3Modal = window.Web3Modal.default;
        const WalletConnectProvider = window.WalletConnectProvider.default;
        let web3Modal;
        let provider;
        let wallet_address;

        function init() {
            const options = new WalletConnectProvider({
                rpc: {
                    <?php echo $contract->chain_id; ?>: "<?php echo $contract->dataseed_url; ?>"
                },
                infuraId: "<?php echo $contract->infura_id; ?>"
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

        init();

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

        async function token_claim(id, uuid, token_address,uwa) {
            $("#sub_data").html('');
            try {
                provider = await web3Modal.connect();
                console.log("provider", provider);
                const web3 = new window.Web3(provider);
                let chainId = await web3.eth.getChainId();
                if (chainId != <?php echo $contract->chain_id; ?>) {
                    await changeToMain("0x<?php echo dechex($contract->chain_id); ?>");
                }

                const accounts = await web3.eth.getAccounts();
                wallet_address = accounts[0].toLowerCase();
                console.log("Got accounts", wallet_address);
                console.log('Chain ID', chainId);

                if (chainId == <?php echo $contract->chain_id; ?>) {
                    if (wallet_address != uwa) {
                        $("#btn_locader").removeClass('is-active');
                        $('#sub_data').html('<div class="alert alert-danger">Wallet address mismatch (' + wallet_address + '). Your account was created by using wallet address <?php echo strtolower($data->user->metamask_wallet_id); ?>. Please switch to same wallet address to join sale.</div>');
                    } else {
                        $("#btn_locader").addClass('is-active');
                        const contract = new web3.eth.Contract(CLAIM_CONTRACT_ABI, CLAIM_CONTRACT_ADDRESS);
                        //amount = web3.utils.toWei(num.toString());
                        await contract.methods
                            .claim(token_address,uuid)
                            .send({
                                from: wallet_address
                            })
                            .on("transactionHash", async (hash) => {
                                $("#btn_locader").attr('data-curtain-text', 'Processing...');
                                // get tx hash
                                console.log('Hello 1');
                                console.log(hash);
                                update_claim(id, uuid, 2, hash, '');
                                $('#sub_data').html('<div class="alert alert-info">Token claim process has been initiated. <a href="<?php echo env('bscscanHash'); ?>tx/' + hash + '" target="_blank">Click here </a> to check transaction status.</div>');
                            })
                            .on("receipt", async (receipt) => {
                                // receipt.status will return your tx status. true & false
                                console.log('Hello 2');
                                console.log(receipt);
                                if (receipt.status === true) {
                                    $("#btn_locader").attr('data-curtain-text', 'Tokens Claimed...');
                                    update_claim(id, uuid, 3, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-success">Tokens has been claimed successfully. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 1000);
                                } else {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction failed...');
                                    update_claim(id, uuid, 4, receipt.transactionHash, receipt);
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed. <a href="<?php echo env('bscscanHash'); ?>tx/' + receipt.transactionHash + '" target="_blank">Click here </a> to check transaction status.</div>');
                                    }, 2000);
                                }
                            })
                            .on('confirmation', function(confirmationNumber, receipt) {
                                // console.log('Hello 3'); console.log(confirmationNumber);  console.log(receipt);
                            })
                            .on('error', function(error) {
                                console.log('Hello 4');
                                console.log('error', error);
                                update_claim(id, uuid, 4, null,null);
                                if (error.code === 4001) {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction Canceled...');
                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed.</div>');
                                    }, 3000);
                                } else {
                                    $("#btn_locader").attr('data-curtain-text', 'Transaction failed...');

                                    setTimeout(function() {
                                        $("#btn_locader").removeClass('is-active');
                                        $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed.</div>');
                                    }, 3000);
                                }

                            });
                    }
                } else {
                    $("#btn_locader").removeClass('is-active');
                    $('#sub_data').html('<div class="alert alert-danger">Please switch to chain ID 97 ( Binance Smart Chain ) to join sale.</div>');
                }

            } catch (error) {
                $("#btn_locader").removeClass('is-active');
                console.log("Error catched");
                $('#sub_data').html('<div class="alert alert-danger">Token claim process has been failed.</div>');
                return;
            }


        }

        function update_claim(id, uuid, status, transaction, tran_data) {
            $.ajax({
                type: 'POST',
                url: '<?php echo SITEURL; ?>users/update_claim',
                data: {
                    id: id,
                    uuid: uuid,
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
<?php $this->end();
} ?>