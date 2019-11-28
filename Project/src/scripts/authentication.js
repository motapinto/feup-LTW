function submitLogin() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let email = document.getElementById('login-email').value;
    email = email.replace('@', '%40');
    email = 'email=' + email;

    let password = document.getElementById('login-password').value;
    password = 'password=' + password;

    let request = email + '&' + password;
    
    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        
        switch (response['response']) {
            case -1:
                document.getElementById('login-msg').innerHTML = 'User does not exist';
                document.getElementById('login-msg').style.color = 'red';
                document.getElementById('login-password').style.backgroundColor = 'white';
                document.getElementById('login-password').style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementById('login-email').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('login-email').style.border = 'solid 1px rgb(233, 76, 76)';
                break;

            case -2:
                document.getElementById('login-msg').innerHTML = 'Password incorrect';
                document.getElementById('login-msg').style.color = 'red';
                document.getElementById('login-email').style.backgroundColor = 'white';
                document.getElementById('login-email').style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementById('login-password').style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementById('login-password').style.border = 'solid 1px rgb(233, 76, 76)';
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

function submitSignup() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let email = document.getElementById('signup-email').value;
    email = email.replace('@', '%40');
    email = 'email=' + email;

    let password = document.getElementById('signup-password').value;
    password = 'password=' + password;

    let name = document.getElementById('signup-name').value;
    name = 'age=' + name;

    let age = document.getElementById('signup-age').value;
    age = 'age=' + age;

    let request = email + '&' + password + '&' + name + '&' + age;
    
    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        
        switch (response['response']) {
            //  success
            case 0:
                    window.location = '../authentication/login.php';
                    document.getElementById('signup-msg-email').innerHTML = '';
                break;

            //  fail -> user exists
            default:
                window.location = '../authentication/signup.php';
                document.getElementById('signup-msg-email').innerHTML = 'Email already exists';
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