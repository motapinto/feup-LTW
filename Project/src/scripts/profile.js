let startEmail = document.getElementById('email').value;

function profileOverview() {
    document.getElementById('profile-settings-tab').style.display = 'none';
    document.getElementById('profile-security-tab').style.display = 'none';
    document.getElementById('profile-comments-tab').style.display = 'none';
    document.getElementById('profile-overview-tab').style.display = 'display';
}

function profileSettings() {
    document.getElementById('profile-overview-tab').style.display = 'none';
    document.getElementById('profile-security-tab').style.display = 'none';
    document.getElementById('profile-comments-tab').style.display = 'none';
    document.getElementById('profile-settings-tab').style.display = 'block';
}

function profileComments() {
    document.getElementById('profile-overview-tab').style.display = 'none';
    document.getElementById('profile-settings-tab').style.display = 'none';
    document.getElementById('profile-security-tab').style.display = 'none';
    document.getElementById('profile-comments-tab').style.display = 'block';
}

function profileSecurity() {
    document.getElementById('profile-overview-tab').style.display = 'none';
    document.getElementById('profile-settings-tab').style.display = 'none';
    document.getElementById('profile-comments-tab').style.display = 'none';
    document.getElementById('profile-security-tab').style.display = 'block';
}

function checkName() {
    let name = document.getElementById('name').value;
    var nameTest = new RegExp("^[a-zA-Z]+(([' -][a-zA-Z ])?[a-zA-Z]*)*$");
    var isLegal = nameTest.test(name);
    if(isLegal) {
        document.getElementById('icon-name').style.color = 'black';
        document.getElementById('icon-name').className = 'fas fa-check';
        document.getElementById('profile-settings-msg-name').innerHTML = '';
        submitForm(0);
    }
    else {
        document.getElementById('icon-name').style.color = 'red';
        document.getElementById('icon-name').className = 'fas fa-times';
        document.getElementById('profile-settings-msg-name').innerHTML = 'Name can only contain letters, spaces and \'-\'';
        document.getElementById('profile-settings-msg-name').style.color = 'red';
        submitForm(-1);
    }
}

function checkEmail() {
    let email = document.getElementById('email').value;
    let emailTest = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
    let isLegal = emailTest.test(email);
    if(isLegal) {
        document.getElementById('profile-settings-msg-email').innerHTML = '';
        submitForm(1);
    }
    else {
        document.getElementById('profile-settings-msg-email').innerHTML = 'Failled to change email';;
        document.getElementById('profile-settings-msg-email').style.color = 'red';
        document.getElementById('email').value = startEmail;
        submitForm(-1);
    }
}

function checkAge() {
    if(document.getElementById('age').value >= 18) {
        document.getElementById('icon-age').style.color = 'black';
        document.getElementById('icon-age').className = 'fas fa-check';
        document.getElementById('profile-settings-msg-age').innerHTML = '';
        submitForm(2);
    }
    else {
        document.getElementById('icon-age').style.color = 'red';
        document.getElementById('icon-age').className = 'fas fa-times';
        document.getElementById('profile-settings-msg-age').innerHTML = 'Must be over than 18';
        document.getElementById('profile-settings-msg-age').style.color = 'red';
        submitForm(-1);
    }
}

function checkPass() {
    if (document.getElementById('password').value.length == 0 ||
        document.getElementById('password').value == document.getElementById('confirm_password').value) {

        document.getElementById('password').style.backgroundColor = 'white';
        document.getElementById('password').style.border = 'solid 1px rgb(176, 183, 187)'
        document.getElementById('confirm_password').style.backgroundColor = 'white';
        document.getElementById('confirm_password').style.border = 'solid 1px rgb(176, 183, 187)'
        document.getElementById('profile-settings-msg').innerHTML = '';
        document.getElementById('profile-settings-submit').disabled = false;
    } else {
        document.getElementById('confirm_password').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
        document.getElementById('profile-settings-msg').innerHTML = 'The password\'s don\'t match';
        document.getElementById('profile-settings-msg').style.color = 'red';
        document.getElementById('profile-settings-submit').disabled = true;
    }
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function getCurrentPassword() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let password = document.getElementById('current-password').value;

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        console.log(response);
        switch (response['response']) {
            case 0:
                document.getElementById('profile-security-msg-password').innerHTML = '';
                break;

            default:
                document.getElementById('profile-security-msg-password').innerHTML = 'Current password is not correct';
                break;
        }
        break;
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('POST', '../actions/action_profile_change.php?' + request, asynchronous);
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
        console.log(response);
        switch (option) {
            // user name
            case 0:
                document.getElementById('user-name').innerHTML = name;
                
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

            default:
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('POST', '../actions/action_profile_change.php?' + request, asynchronous);
    xhttp.send();
}