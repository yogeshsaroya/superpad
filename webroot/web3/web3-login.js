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