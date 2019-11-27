function encodeForAjax(data) {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function submitLogin() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let email = document.getElementById('login-email').value;
    email = email.replace('@', '%40');
    email = 'email=' + email;

    let password = document.getElementById('login-password').value;
    password = 'password=' + password;

    let request = email + '&' + password;
    alert(request);

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        alert(response);
        
        switch (response['response']) {
            case -1:
                alert('-1');
                document.getElementById('login-msg').innerHTML = 'User does not exist';
                document.getElementById('login-msg').style.color = 'red';
                break;

            case -2:
                    alert('-2');
                document.getElementById('login-msg').innerHTML = 'User does not exist';
                document.getElementById('login-msg').style.color = 'Password incorrect';
                break;

            default:
                document.getElementById('login-msg').innerHTML = '';
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