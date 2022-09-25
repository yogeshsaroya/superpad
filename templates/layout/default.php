<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $this->fetch('title') ?></title>
    <meta name="description" content="<?= $this->fetch('title') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITEURL; ?>favicon.ico">
    <?php echo $this->Html->css(['/assets/css/vendor.bundle', '/assets/css/style']); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script type="text/javascript">
        var SITEURL = "<?php echo SITEURL ?>";
    </script>
</head>

<body>
    <div class="page-wrap">

        <div id="main_locader" class="loader loader-bouncing"></div>
        <?php echo $this->element('header'); ?>
        <?= $this->fetch('content') ?>
        <?php echo $this->element('footer'); ?>
    </div>
    <?php echo $this->Html->script(['/js/vendor/modernizr-2.8.3.min']) ?>
    <?php echo $this->Html->script(['/js/vendor/jquery-3.1.1.min', '/assets/js/bundle', '/assets/js/scripts']) ?>
    <?php echo $this->Html->script(['jquery.form.min.js', 'validator.min']); ?>
    <?php echo $this->Html->script(['/web3/ethers-5.0.umd.min', '/web3/web3.min', '/web3/metamask.web3.min', '/web3/web3modal', '/web3/web3-provider']) ?>

    <?php echo $this->fetch('scriptBottom'); ?>
    <?php if (isset($Auth->role) && !empty($Auth->role)) {
    } else {

        echo $this->Html->script(['/web3/axios.min']);
        $contract = $this->Data->getContract();
        if (!empty($contract)) {
    ?>

            <script>
                "use strict";
                const Web3Modal = window.Web3Modal.default;
                const WalletConnectProvider = window.WalletConnectProvider.default;
                let web3Modal
                let provider;
                let selectedAccount;
                let web3ModalProv;

                function web3ModalInit() {
                    const providerOptions = {
                        walletconnect: {
                            package: WalletConnectProvider,
                            options: {
                                rpc: {
                                    <?php echo $contract->chain_id; ?>: "<?php echo $contract->dataseed_url; ?>"
                                },
                                infuraId: "<?php echo (!empty($contract->infura_id) ? $contract->infura_id : null); ?>",
                            }
                        },
                    };

                    web3Modal = new Web3Modal({
                        cacheProvider: false, // optional
                        providerOptions, // required
                        disableInjectedProvider: false, // optional. For MetaMask / Brave / Opera.
                    });
                }

                async function fetchAccountData() {
                    web3ModalProv = new Web3(provider);

                    // Subscribe to accounts change
                    provider.on("accountsChanged", (accounts) => {
                        console.log('Hello 1');
                        console.log(accounts);
                    });

                    // Subscribe to chainId change
                    provider.on("chainChanged", (chainId) => {
                        console.log('Hello 2');
                        console.log(chainId);
                    });

                    // Subscribe to session disconnection
                    provider.on("disconnect", (code, reason) => {
                        console.log('Hello 3');
                        console.log(code, reason);
                    });
                }

                async function refreshAccountData() {
                    await fetchAccountData(provider);
                }

                async function onConnectLoadWeb3Modal() {

                    try {
                        provider = await web3Modal.connect();
                    } catch (e) {
                        console.log("Could not get a wallet connection", e);
                        return;
                    }

                    await refreshAccountData();
                }

                let userLoginData = {
                    state: "loggedOut",
                    ethAddress: "",
                    buttonText: "Log in",
                    publicName: "",
                    JWT: "",
                    config: {
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        }
                    }
                }


                async function userLoginOut() {
                    console.log(userLoginData);
                    if (userLoginData.state == "loggedOut" || userLoginData.state == "needMetamask") {
                        await onConnectLoadWeb3Modal();
                    }
                    if (web3ModalProv) {
                        window.web3 = web3ModalProv;
                        try {
                            userLogin();
                        } catch (error) {
                            console.log('Hello 4');
                            console.log(error);
                            userLoginData.state = 'needLogInToMetaMask';

                            return;
                        }
                    } else {
                        userLoginData.state = 'needMetamask';
                        return;
                    }
                }

                async function userLogin() {
                    $("#main_locader").addClass('is-active');
                    // Get connected chain id from Ethereum node
                    const chainId = await web3.eth.getChainId();
                    console.log("chain id", chainId);

                    let accountsOnEnable = await web3.eth.getAccounts();
                    let address = accountsOnEnable[0];
                    address = address.toLowerCase();
                    if (address == null) {
                        userLoginData.state = "needLogInToMetaMask";
                        return;
                    }
                    userLoginData.state = "signTheMessage";
                    axios({
                            method: "post",
                            url: "<?php echo SITEURL; ?>users/check_metamask",
                            data: {
                                request: "login",
                                address: address
                            },
                        })
                        .then(function(response) {
                            if (response.data.substring(0, 5) != "Error") {
                                let message = response.data;
                                let publicAddress = address;
                                handleSignMessage(message, publicAddress).then(handleAuthenticate);

                                function handleSignMessage(message, publicAddress) {
                                    return new Promise((resolve, reject) =>
                                        web3.eth.personal.sign(
                                            web3.utils.utf8ToHex(message),
                                            publicAddress,
                                            (err, signature) => {
                                                if (err) {}
                                                return resolve({
                                                    publicAddress,
                                                    signature
                                                });
                                            }
                                        )
                                    );
                                }

                                function handleAuthenticate({
                                    publicAddress,
                                    signature
                                }) {
                                    axios({
                                            method: "post",
                                            url: "<?php echo SITEURL; ?>users/check_metamask",
                                            data: {
                                                request: "auth",
                                                address: arguments[0].publicAddress,
                                                signature: arguments[0].signature
                                            },
                                        })
                                        .then(function(response) {
                                            console.log('Hello 5');
                                            console.log(response.data);
                                            $("#main_locader").removeClass('is-active');
                                            if (response.data[0] == "Success") {
                                                rd();
                                            } else if (response.data[0] == "Error") {
                                                err_wallet();
                                            } else if (response.data[0] == "Cancel") {
                                                can_wallet();
                                            } else if (response.data[0] == "Fail") {
                                                fail_wallet();
                                            }
                                        })
                                        .catch(function(error) {
                                            console.log('Hello 6');
                                            console.error(error);
                                        });
                                }
                            } else {
                                console.log('Hello 7');
                                console.log("Error: " + response.data);
                            }
                        })
                        .catch(function(error) {
                            console.log('Hello 8');
                            console.error(error);
                        });

                }


                function rd() {
                    $('.conn_wallet').hide();
                    $('#signTheMessage').html('<div class="alert alert-success">Your MetaMask wallet address been connected.</div>');
                    location.reload();
                    setTimeout(function() {

                    }, 2000);
                }

                function err_wallet() {
                    $('#signTheMessage').html('<div class="alert alert-danger">This wallet address is already in use with other account. Please use other account.</div>');
                }

                function can_wallet() {
                    $('#signTheMessage').html('<div class="alert alert-danger">Your request has been canceled. Please try again.</div>');
                }

                function wrong_network() {
                    $('#signTheMessage').html('<div class="alert alert-danger">Network not switched. Please switch network to Binance Smart Chain.</div>');
                }

                function fail_wallet() {
                    $('#signTheMessage').html('<div class="alert alert-danger">Your request has been failed. Please try again.</div>');
                    //setTimeout(function(){ location.reload(); }, 1000);

                }


                window.addEventListener('load', async () => {
                    web3ModalInit();
                    const el = document.getElementById('cn_w');
                    const mel = document.getElementById('mob_wal');
                    
                    if (el.style.display === 'none') { el.style.display = 'block'; }
                    if (mel.style.display === 'none') { mel.style.display = 'block'; }

                });
            </script>
    <?php }
    } ?>
    <div id="cover"></div>
</body>

</html>