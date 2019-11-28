let startEmail = document.getElementsByClassName('email')[0].value;

//  Selects user menu
function profileSubMenu(option) {
    switch(option) {
        case 0:
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';
            document.getElementById('profile-sendMessage-tab').style.display = 'none';
            document.getElementById('profile-overview-tab').style.display = 'block';
            break;

        case 1:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';
            document.getElementById('profile-sendMessage-tab').style.display = 'none';
            document.getElementById('profile-settings-tab').style.display = 'block';
            break;

        case 2:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';
            document.getElementById('profile-sendMessage-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'block';
            break;

        case 3:
            document.getElementById('profile-overview-tab').style.display = 'none';
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-sendMessage-tab').style.display = 'none';
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

function checkPass11() {

    let password = document.getElementById('password').value;
    let isLegal = /\w{8,}/.test(password);
    if(document.getElementById('password').value !== document.getElementById('confirm_password').value) {
        document.getElementById('confirm_password').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
        document.getElementById('profile-security-msg1-newPassword').innerHTML = 'The password\'s don\'t match';
        document.getElementById('profile-security-msg1-newPassword').style.color = 'red';
    }
    else {
        document.getElementById('confirm_password').style.backgroundColor = 'white';
        document.getElementById('confirm_password').style.border = 'solid 1px rgb(176, 183, 187)'
        document.getElementById('profile-security-msg1-newPassword').innerHTML = '';
        if(isLegal) 
            submitForm(3);
    }
    
    if (!isLegal) {
        document.getElementById('password').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('password').style.border = 'solid 1px rgb(233, 76, 76)';
        document.getElementById('profile-security-msg2-newPassword').innerHTML = 'The password must have at least eight characters, at least one uppercase letter, one lowercase letter and one number';
        document.getElementById('profile-security-msg2-newPassword').style.color = 'red';
    }
    else {
        document.getElementById('password').style.backgroundColor = 'white';
        document.getElementById('password').style.border = 'solid 1px rgb(176, 183, 187)';
        document.getElementById('profile-security-msg2-newPassword').innerHTML = '';
    } 
}

//  Confirms current password
function checkCurrentPassword() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let password = document.getElementById('current-password').value;
    let request = 'currentPassword=' + password;

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        switch (response['response']) {
            case -1:
                document.getElementsByClassName('msg-password')[0].innerHTML = 'Current password is not correct';
                document.getElementsByClassName('msg-password')[0].style.color = 'red';
                document.getElementById('current-password').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('current-password').style.border = 'solid 1px rgb(233, 76, 76)';
                document.getElementById('password').disabled = true;
                document.getElementById('confirm_password').disabled = true;
                document.getElementById('password-change').style.display = 'none';
                break;

            default:
                document.getElementsByClassName('msg-password')[0].innerHTML = '';
                document.getElementById('current-password').style.backgroundColor = 'white';
                document.getElementById('current-password').style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementById('password').disabled = false;
                document.getElementById('confirm_password').disabled = false;
                document.getElementById('password-change').style.display = 'block';
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../actions/action_profile_change.php?' + request, asynchronous);
    xhttp.send();
}

//  Submit form to change profile details
function submitForm(option) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let request, name, email, age, password;

    switch (option) {
        // user name
        case 0:
            name = document.getElementsByClassName('name')[0].value;
            name = name.split(' ');
            name = name.join('+');
            request = 'name=' + name;
            break;
        // user email
        case 1:
            email = document.getElementsByClassName('email')[0].value;
            email = email.replace('@', '%40');
            request = 'email=' + email;
            break;
        // user age
        case 2:
            age = document.getElementsByClassName('age')[0].value;
            request = 'age=' + age;
            break;

        // user password
        case 3:
            password = document.getElementById('password').value;
            request = 'password=' + password;
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
                        document.getElementsByClassName('msg-name')[0].innerHTML = 'Failled to change name';
                        document.getElementsByClassName('msg-name')[0].style.color = 'red';
                        document.getElementById('icon-name').className = 'fas fa-times';
                        break;
                }
                break;

            // User email
            case 1:
                switch (response['response']) {
                    //Error in db
                    case 1:
                        document.getElementsByClassName('email')[0].value = startEmail;
                        document.getElementsByClassName('msg-email')[0].innerHTML = 'Failled to change email';
                        document.getElementsByClassName('msg-email')[0].style.color = 'red';
                        document.getElementById('icon-name').className = 'fas fa-times';
                        break;
                    //Error in db
                    case 2:
                        document.getElementsByClassName('email')[0].value = startEmail;
                        document.getElementsByClassName('msg-email')[0].innerHTML = 'Email already exists';
                        document.getElementsByClassName('msg-email')[0].style.color = 'red';
                        document.getElementById('icon-name').className = 'fas fa-times';
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../actions/action_profile_change.php?' + request, asynchronous);
    xhttp.send();
}