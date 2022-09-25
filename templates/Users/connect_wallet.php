<?php $this->assign('title', 'Connect Wallet'); ?>
<?php /*https://github.com/giekaton/php-metamask-user-login*/ ?>
<style>
 .hkzEld {
    z-index: 999;
}    
</style>
<div class="hero-wrap sub-header">
    <div class="container">
        <div class="hero-content text-center py-0">
            <h1 class="hero-title">Connect Wallet</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-s1 justify-content-center mt-3 mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="wallet-section section-space-b">
    <div class="container">
        <div class="row g-gs">
            <div class="col-lg-4col-md-6">
                <div class="card card-full text-center">
                    <div class="card-body card-body-s1 d-block" >
                        <img class="mb-4" src="<?php echo SITEURL; ?>images/brand/metamask.svg" alt="">
                        <h4 class="card-title mb-3">Metamask</h4>
                        <p class="card-text card-text-s1 mb-4">Start exploring blockchain applications in seconds. Trusted by over 1 million users worldwide.</p>
                        <div id="signTheMessage" class="user-login-msg"></div>
                        <span class="btn btn-dark" onclick="userLoginOut()" id="buttonText">Connect</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $this->Html->script(['/web3/axios.min'],['block' => 'scriptBottom']);?>
<?php $this->append('scriptBottom'); ?>
<script>
    function rd(){
      document.getElementById('buttonText').removeAttribute("onclick");
      document.getElementById('buttonText').remove();


       $('#signTheMessage').html('<div class="alert alert-success">Your MetaMask wallet address been connected.</div>');
       var s = SITEURL+"users/dashboard";
       setTimeout(function(){ window.location.href =s; }, 2000);
    }

    function err_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">This wallet address is already in use with other account. Please use other account.</div>');
    }

    function can_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">Your request has been canceled. Please try again.</div>');
    }

    function wrong_network(){
        $('#signTheMessage').html('<div class="alert alert-danger">Network not switched. Please switch network to Binance Smart Chain.</div>');
    }

    function fail_wallet(){
        $('#signTheMessage').html('<div class="alert alert-danger">Your request has been failed. Please try again.</div>');
        //setTimeout(function(){ location.reload(); }, 1000);

    }

    let userLoginData = {
    state: "loggedOut",
    ethAddress: "",
    buttonText: "Log in",
    publicName: "",
    JWT: "",
    config: { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
}

if (typeof(backendPath) == 'undefined') {
    var backendPath = '';
}

function ethInit() {
    ethereum.on('accountsChanged', (_chainId) => ethNetworkUpdate());

    async function ethNetworkUpdate() {
        let accountsOnEnable = await web3.eth.getAccounts();
        let address = accountsOnEnable[0];
        address = address.toLowerCase();
        if (userLoginData.ethAddress != address) {
            userLoginData.ethAddress = address;
            showAddress();
            if (userLoginData.state == "loggedIn") {
                userLoginData.JWT = "";
                userLoginData.state = "loggedOut";
                userLoginData.buttonText = "Log in";
            }
        }
        if (userLoginData.ethAddress != null && userLoginData.state == "needLogInToMetaMask") {
            userLoginData.state = "loggedOut";
        }
    }
}


// Show current msg
function showMsg(id) {
    let x = document.getElementsByClassName("user-login-msg");
    let i;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = 'none';
    }
    document.getElementById(id).style.display = 'block';
}


// Show current address
function showAddress() {
    document.getElementById('ethAddress').innerHTML = userLoginData.ethAddress;
}


// Show current button text
function showButtonText() {
    document.getElementById('buttonText').innerHTML = userLoginData.buttonText;
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
            showMsg(userLoginData.state);
            return;
        }
    } else {
        userLoginData.state = 'needMetamask';
        return;
    }
}

    /**
     * Kick in the UI action after Web3modal dialog has chosen a provider
     */
     async function changeToMain(id) {
        try {
          await ethereum.request({
            method: "wallet_switchEthereumChain",
            params: [{ chainId: id }],
          });
        } catch (error) {
          console.log("Wrong network");
          wrong_network();
          
        }
      }

async function userLogin() {
    /*
    if (userLoginData.state == "loggedIn") {
        userLoginData.state = "loggedOut";
        showMsg(userLoginData.state);
        userLoginData.JWT = "";
        userLoginData.buttonText = "Log in";
        showButtonText();
        return;
    }
    if (typeof window.web3 === "undefined") {
        userLoginData.state = "needMetamask";
        showMsg(userLoginData.state);
        return;
    }
    */

    // Get connected chain id from Ethereum node
    const chainId = await web3.eth.getChainId();
    console.log("chain id", chainId);
    //if (chainId != 56) { await changeToMain("0x38"); }
    if (chainId != 97) {
      try {
        await changeToMain("0x61");
      } catch (error) {
        //wrong_network();
      }
    }
    else{
    }

    let accountsOnEnable = await web3.eth.getAccounts();
    let address = accountsOnEnable[0];
    address = address.toLowerCase();
    if (address == null) {
        userLoginData.state = "needLogInToMetaMask";
        showMsg(userLoginData.state);
        return;
    }
    userLoginData.state = "signTheMessage";
    showMsg(userLoginData.state);

    axios({
            method: "post",
            url: "users/check_metamask",
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
                                if (err) {
                                    //userLoginData.state = "loggedOut";
                                    //showMsg(userLoginData.state);
                                }
                                return resolve({ publicAddress, signature });
                            }
                        )
                    );
                }

                function handleAuthenticate({ publicAddress, signature }) {
                    axios({
                            method: "post",
                            url: "users/check_metamask",
                            data: {
                                request: "auth",
                                address: arguments[0].publicAddress,
                                signature: arguments[0].signature
                            },
                        })
                        .then(function(response) {
                            console.log('Hello 5');
                            console.log(response.data);
                            if (response.data[0] == "Success") {
                                rd();
                                /*
                                userLoginData.state = "loggedIn";
                                showMsg(userLoginData.state);
                                userLoginData.buttonText = "Log out";
                                showButtonText();
                                userLoginData.ethAddress = address;
                                showAddress();
                                userLoginData.publicName = response.data[1];
                                getPublicName();
                                userLoginData.JWT = response.data[2];
                                localStorage.clear();
                                */
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

/*
function getPublicName() {
    document.getElementById('updatePublicName').value = userLoginData.publicName;
}
function setPublicName() {
    let value = document.getElementById('updatePublicName').value;
    axios.post(
            backendPath + "backend/server.php", {
                request: "updatePublicName",
                address: userLoginData.ethAddress,
                JWT: userLoginData.JWT,
                publicName: value
            },
            this.config
        )
        .then(function(response) {
            console.log(response.data);
        })
        .catch(function(error) {
            console.error(error);
        });
}
*/


"use strict";

const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;

// Web3modal instance
let web3Modal

// Chosen wallet provider given by the dialog window
let provider;

// Address of the selected account
let selectedAccount;

// Web3Loaded
let web3ModalProv;

function web3ModalInit() {
    // Tell Web3modal what providers we have available.
    // Built-in web browser provider (only one can exist as a time)
    // like MetaMask, Brave or Opera is added automatically by Web3modal
    const providerOptions = {
        walletconnect: {
            package: WalletConnectProvider,
            options: {
                // Mikko's test key - don't copy as your mileage may vary
                infuraId: "<?php echo (!empty($contract->infura_id)? $contract->infura_id : null);?>",
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

window.addEventListener('load', async() => {
    web3ModalInit();
});

</script>


<?php $this->end(); ?>