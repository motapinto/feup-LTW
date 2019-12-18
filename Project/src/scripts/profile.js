"use strict";

document.getElementById("sendMessage").onclick = function (event) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let message = document.getElementById('message').value;
    let receiver = document.getElementById('receiver').value;
    let request = encodeForAjax({ 
        csrf: document.getElementById('csrf').value,
        sendMessage: message,
        receiver: receiver 
    });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        switch (response['response']) {
            case 0:
                document.getElementById('sendMessage-msg').textContent = 'Message sent successfuly.';
                break;

            default:
                document.getElementById('sendMessage-msg').textContent = 'Failled to send message.';
                break;
        }
    });

    xhttp.addEventListener('error', function (event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../apis/api_message_add.php?' + request, asynchronous);
    xhttp.send();
}

document.getElementById('properties-button').onclick = function (event) {
    window.location = "../properties/properties.php";
}

if (document.getElementById('messages-button'))
    document.getElementById('messages-button').onclick = function (event) { window.location = "../messages/messages.php"; }

if (document.getElementById('send-message-button'))
    document.getElementById('send-message-button').onclick = function (event) { profileSubMenu(4); }

document.getElementById('overview-button').onclick = function (event) { profileSubMenu(0); }

document.getElementById('profile-button').onclick = function (event) { profileSubMenu(1); }

if (document.getElementById('security-button'))
    document.getElementById('security-button').onclick = function (event) { profileSubMenu(2); }

document.getElementById('comments-button').onclick = function (event) { profileSubMenu(3); }

if (document.getElementById('name'))
    document.getElementById('name').onkeyup = function (event) { checkName(true); }

if (document.getElementById('email'))
    document.getElementById('email').onkeyup = function (event) { checkEmail(true); }

if (document.getElementById('email-button'))
    document.getElementById('email-button').onclick = function (event) { submitForm(1); }

if (document.getElementById('age'))
    document.getElementById('age').onkeyup = function (event) { checkAge(true); }

if (document.getElementById('delete-button'))
    document.getElementById('delete-button').onclick = function (event) { deleteUser(); }

if (document.getElementById('current-password'))
    document.getElementById('current-password').onkeyup = function (event) { checkCurrentPassword(); }

if (document.getElementById('password'))
    document.getElementById('password').onkeyup = function (event) { checkPass(); }

if (document.getElementById('password-change'))
    document.getElementById('password-change').onclick = function (event) { submitForm(3); }

if (document.getElementById('confirm_password'))
    document.getElementById('confirm_password').onkeyup = function (event) { checkPass(); }

setCancelActions();

function setCancelActions() {
    let rents = document.getElementsByClassName('cancel-button');
    for (let i = 0; i < rents.length; i++) {
        rents[i].onclick = function (event) {
            cancelRent(parseInt(document.getElementsByClassName('rent-id')[i].value));
        };
    }
}

// Cancels rent with id
function cancelRent(id) {
    if (id === NaN) return;
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let request = encodeForAjax({
        id: id,
        csrf: document.getElementById('csrf').value
    });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        if (response['response'] === 0) {
            let rents = document.getElementsByClassName('rent-id');
            for (let i = 0; i < rents.length; i++){
                if (parseInt(rents.item(i).value) === id) {
                    let elements = document.getElementsByClassName('profile-overview-elem');
                    elements[i].parentNode.removeChild(elements[i]);
                } 
            }
            setCancelActions();
        }
    });


    xhttp.open('GET', '../apis/api_cancel_rent.php?' + request, asynchronous);
    xhttp.send();

}

//  Selects user menu
function profileSubMenu(option) {
    switch(option) {
        case 0:
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';       
            document.getElementById('profile-overview-tab').style.display = 'block';
            break;

        case 1:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';           
            document.getElementById('profile-settings-tab').style.display = 'block';
            break;

        case 2:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';           
            document.getElementById('profile-security-tab').style.display = 'block';
            break;

        case 3:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';           
            document.getElementById('profile-comments-tab').style.display = 'block';
            break;

        case 4:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';
            document.getElementById('profile-sendMessage-tab').style.display = 'block';
            break;

        default:
            break;
    }
}

//  Confirms current password
function checkCurrentPassword() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let request = encodeForAjax({
        csrf: document.getElementById('csrf').value,
        currentPassword: document.getElementById('current-password').value
    });

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        switch (response['response']) {
            case 0:
                document.getElementById('msg-password').innerHTML = '';
                document.getElementById('current-password').style.backgroundColor = 'white';
                document.getElementById('current-password').style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementById('password').disabled = false;
                document.getElementById('confirm_password').disabled = false;
                document.getElementById('password-change').style.display = 'block';
                break;
            
            default:
                document.getElementById('msg-password').textContent = 'Current password is not correct';
                document.getElementById('msg-password').style.color = 'red';
                document.getElementById('current-password').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('current-password').style.border = 'solid 1px rgb(233, 76, 76)';
                document.getElementById('password').disabled = true;
                document.getElementById('confirm_password').disabled = true;
                document.getElementById('password-change').style.display = 'none';
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../apis/api_profile_change.php?' + request, asynchronous);
    xhttp.send();
}

//  Submit form to change/delete profile
function submitForm(option) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let request;
    let csrf = document.getElementById('csrf').value;

    switch (option) {
        // user name
        case 0:
            request = encodeForAjax({ name: document.getElementById('name').value, csrf: csrf });
            break;
        // user email
        case 1: 
            request = encodeForAjax({ email: document.getElementById('email').value, csrf: csrf });
            break;
        // user age
        case 2:
            request = encodeForAjax({ age: document.getElementById('age').value, csrf: csrf });
            break;
        // user password
        case 3:
            if (!checkPass()) return;
            request = encodeForAjax({ password: document.getElementById('password').value, csrf: csrf });
            break;    
        case 4:
            request = encodeForAjax({ deleteUser: 0, csrf: csrf });
            break;

        default:
            break;
    }

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        switch (option) {
            //User name
            case 0:
                switch (response['response']) {
                    //Error in db
                    case 1:
                        document.getElementById('msg-name').innerHTML = 'Failled to change name';
                        document.getElementById('msg-name').style.color = 'red';
                        document.getElementById('icon-name').className = 'fas fa-times';
                        break;
                }
                break;

            // User email
            case 1:
                switch (response['response']) {
                    //Error in db
                    case 1:
                        document.getElementById('msg-email').innerHTML = 'Failled to change email';
                        document.getElementById('msg-email').style.color = 'red';
                        break;
                    //Error in db
                    case 2:
                        document.getElementById('msg-email').innerHTML = 'Email already exists';
                        document.getElementById('msg-email').style.color = 'red';
                        break;

                    default:
                        document.getElementById('msg-email').innerHTML = 'Email changed successfully!';
                        document.getElementById('msg-email').style.color = 'green';
                        break;
                }
                break;

            case 3: 
                document.getElementById('msg-password').innerHTML = 'Password changed successfully!';
                document.getElementById('msg-password').style.color = 'green';
                break;
            
            case 4:
                window.location = "../actions/action_logout.php";
                break;

            default:
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../apis/api_profile_change.php?' + request, asynchronous);
    xhttp.send();
}

// Deletes the current user
function deleteUser() {
    if (confirm("Are you sure?"))
        submitForm(4);
}
