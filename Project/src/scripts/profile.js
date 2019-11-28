let startEmail = document.getElementById('email').value;

function profileSubMenu(option) {
    switch(option) {
        case 0:
            document.getElementById('profile-settings-tab').style.display = 'none';
            document.getElementById('profile-security-tab').style.display = 'none';
            document.getElementById('profile-comments-tab').style.display = 'none';
            document.getElementById('profile-overview-tab').style.display = 'display';
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
            
        default:
            break;
    }
}

function checkName11() {
    let name = document.getElementById('name').value;
    let isLegal = /^[a-zA-Z\u00C0-\u00FF]+(([' -][a-zA-Z\u00C0-\u00FF])?[a-zA-Z\u00C0-\u00FF]*)*$/.test(name);
    if(isLegal) {
        document.getElementById('icon-name').style.color = 'black';
        document.getElementById('icon-name').className = 'fas fa-check';
        document.getElementById('name').style.backgroundColor = 'white';
        document.getElementById('name').style.border = 'solid 1px rgb(176, 183, 187)';
        document.getElementById('profile-settings-msg-name').innerHTML = '';
        submitForm(0);
    }
    else {
        document.getElementById('icon-name').style.color = 'red';
        document.getElementById('icon-name').className = 'fas fa-times';
        document.getElementById('name').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('name').style.border = 'solid 1px rgb(233, 76, 76)';
        document.getElementById('profile-settings-msg-name').innerHTML = 'Name can only contain letters, spaces and \'-\'';
        document.getElementById('profile-settings-msg-name').style.color = 'red';
        submitForm(-1);
    }
}

function checkEmail11() {
    let email = document.getElementById('email').value;
    let isLegal = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email);

    if(isLegal) {
        document.getElementById('profile-settings-msg-email').innerHTML = '';
        document.getElementById('email').style.backgroundColor = 'white';
        document.getElementById('email').style.border = 'solid 1px rgb(176, 183, 187)';
        submitForm(1);
    }
    else {
        document.getElementById('profile-settings-msg-email').innerHTML = 'Failled to change email';
        document.getElementById('email').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('email').style.border = 'solid 1px rgb(233, 76, 76)';
        document.getElementById('profile-settings-msg-email').style.color = 'red';
        document.getElementById('email').value = startEmail;
        submitForm(-1);
    }
}

function checkAge11() {
    if(document.getElementById('age').value >= 18) {
        document.getElementById('icon-age').style.color = 'black';
        document.getElementById('icon-age').className = 'fas fa-check';
        document.getElementById('age').style.backgroundColor = 'white';
        document.getElementById('age').style.border = 'solid 1px rgb(176, 183, 187)';
        document.getElementById('profile-settings-msg-age').innerHTML = '';
        submitForm(2);
    }
    else {
        document.getElementById('icon-age').style.color = 'red';
        document.getElementById('profile-settings-msg-age').style.color = 'red';
        document.getElementById('icon-age').className = 'fas fa-times';
        document.getElementById('age').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('age').style.border = 'solid 1px rgb(233, 76, 76)';
        document.getElementById('profile-settings-msg-age').innerHTML = 'Must be over than 18';
        submitForm(-1);
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
                document.getElementById('profile-security-msg-password').innerHTML = 'Current password is not correct';
                document.getElementById('profile-security-msg-password').style.color = 'red';
                document.getElementById('current-password').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('current-password').style.border = 'solid 1px rgb(233, 76, 76)';
                document.getElementById('password').disabled = true;
                document.getElementById('confirm_password').disabled = true;
                document.getElementById('password-change').style.display = 'none';
                break;

            default:
                document.getElementById('profile-security-msg-password').innerHTML = '';
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

function submitForm(option) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let request, name, email, age, password;

    switch (option) {
        // user name
        case 0:
            name = document.getElementById('name').value;
            let requestName = name.split(' ');
            requestName = requestName.join('+');
            request = 'name=' + requestName;
            break;
        // user email
        case 1:
            email = document.getElementById('email').value;
            let requestEmail = email.replace('@', '%40');
            request = 'email=' + requestEmail;
            break;
        // user age
        case 2:
            age = document.getElementById('age').value;
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
            // user email
            case 1:
                switch (response['response']) {
                    case 0:
                        document.getElementById('profile-settings-msg-email').innerHTML = '';
                        break;

                    case 1:
                        document.getElementById('email').value = startEmail;
                        document.getElementById('profile-settings-msg-email').innerHTML = 'Failled to change email';
                        document.getElementById('profile-settings-msg-email').style.color = 'red';
                        document.getElementById('icon-name').className = 'fas fa-times';
                        break;

                    case 2:
                        document.getElementById('email').value = startEmail;
                        document.getElementById('profile-settings-msg-email').innerHTML = 'Email already exists';
                        document.getElementById('profile-settings-msg-email').style.color = 'red';
                        document.getElementById('icon-name').className = 'fas fa-times';
                        break;

                    default:
                        break;
                }
                break;
            case 3:
                alert(response['response']);
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