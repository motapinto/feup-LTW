function submitLogin() {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let email = document.getElementsByClassName('email')[0].value;
    email = email.replace('@', '%40');
    email = 'email=' + email;

    let password = document.getElementsByClassName('password')[0].value;
    password = 'password=' + password;

    let request = email + '&' + password;
    
    // Define what happens on successful data submission
    xhttp.addEventListener('load', function(event) {
        let response = JSON.parse(this.responseText);
        
        switch (response['response']) {
            case -1:
                document.getElementById('login-msg').innerHTML = 'User does not exist';
                document.getElementById('login-msg').style.color = 'red';
                document.getElementsByClassName('password')[0].style.backgroundColor = 'white';
                document.getElementsByClassName('password')[0].style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementsByClassName('email')[0].style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementsByClassName('email')[0].style.border = 'solid 1px rgb(233, 76, 76)';
                break;

            case -2:
                document.getElementById('login-msg').innerHTML = 'Password incorrect';
                document.getElementById('login-msg').style.color = 'red';
                document.getElementsByClassName('email')[0].style.backgroundColor = 'white';
                document.getElementsByClassName('email')[0].style.border = 'solid 1px rgb(176, 183, 187)';
                document.getElementsByClassName('password')[0].style.backgroundColor = 'rgb(246, 220, 220)';
                document.getElementsByClassName('password')[0].style.border = 'solid 1px rgb(233, 76, 76)';
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
