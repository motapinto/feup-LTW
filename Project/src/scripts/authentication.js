"use strict";

if (document.getElementById('log_in')) {
    document.getElementById('login-btn').onclick = submitLogin;
    document.getElementById('signup-btn').onclick = function (event) {
        window.location = 'signup.php';
    };
    document.getElementById('email').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('password').focus();
        }
    }
    document.getElementById('password').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            submitLogin(event);
        }
    }

}
else {
    document.getElementById('login-btn').onclick = function (event) {
        window.location = 'login.php';
    };
    document.getElementById('signup-btn').onclick = submitSignup;
    document.getElementById('name').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('age').focus();
        }
        else checkName()
    }
    document.getElementById('age').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('email').focus();
        }
        else checkAge()
    }
    document.getElementById('email').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('password').focus();
        }
        else checkEmail()
    }
    document.getElementById('password').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('confirm_password').focus();
        }
        else checkPass()
    }
    document.getElementById('confirm_password').onkeyup = function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            submitSignup(event);
        }
        else checkPass()
    }
}

document.getElementById('continue-btn').onclick = function (event) {
    window.location = '../listings/listings_all.php';
}

function submitLogin(event) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    
    let email = escapeHtml(document.getElementById('email').value);
    let password = escapeHtml(document.getElementById('password').value);

    let request = encodeForAjax({ 
        email: email, 
        password: password
    });
    
    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        
        switch (response.response) {
            case -1:
                document.getElementById('login-msg').innerHTML = 'User does not exist';
                document.getElementById('login-msg').style.color = 'red';
                document.getElementById('password').style.backgroundColor = 'white';
                document.getElementById('password').style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementById('email').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('email').style.border = 'solid 1px rgb(233, 76, 76)';
                break;

            case -2:
                document.getElementById('login-msg').innerHTML = 'Password incorrect';
                document.getElementById('login-msg').style.color = 'red';
                document.getElementById('email').style.backgroundColor = 'white';
                document.getElementById('email').style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementById('password').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('password').style.border = 'solid 1px rgb(233, 76, 76)';
                break;

            default:
                document.getElementById('login-msg').innerHTML = '';       
                window.location = "../listings/listings_all.php";
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../actions/action_login.php?' + request, asynchronous);
    xhttp.send();
}

function submitSignup(event) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    if(!(checkName() && checkAge() && checkEmail() && checkPass()))
        return; 

    let email = escapeHtml(document.getElementById('email').value);
    let password = escapeHtml(document.getElementById('password').value);
    let name = escapeHtml(document.getElementById('name').value);
    let age = escapeHtml(document.getElementById('age').value);

    let request = encodeForAjax({ 
        email: email, 
        password: password,
        name: name,
        age: age
    });

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        
        switch (response['response']) {
            //  success
            case 0:
                window.location = '../authentication/login.php';
                document.getElementById('msg-email').innerHTML = '';
                break;

            //  fail -> user exists
            default:
                document.getElementById('msg-email').innerHTML = 'Email already exists';
                break;
        }
    });

    // Define what happens in case of error
    xhttp.addEventListener('error', function(event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../actions/action_signup.php?' + request, asynchronous);
    xhttp.send();
}
