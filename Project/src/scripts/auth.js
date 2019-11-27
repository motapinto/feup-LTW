function encodeForAjax(data) {
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function submitLogin() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    alert('sad');

    let email = document.getElementById('login-email').value;
    email = email.replace('@', '%40');
    email = 'email=' + email;

    let password = document.getElementById('login-password').value;
    password = 'password=' + password;

    let request = email + ' ' + password;
    alert(request);

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        alert(response);
        
        switch (response['response']) {
            case -1:
                document.getElementById('email').value = startEmail;
                document.getElementById('profile-settings-msg-email').innerHTML = 'Failled to change email';
                document.getElementById('profile-settings-msg-email').style.color = 'red';
                document.getElementById('icon-name').className = 'fas fa-times';
                break;

            case -2:
                document.getElementById('email').value = startEmail;
                document.getElementById('profile-settings-msg-email').innerHTML = 'Email already exists';
                document.getElementById('profile-settings-msg-email').style.color = 'red';
                document.getElementById('icon-name').className = 'fas fa-times';
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