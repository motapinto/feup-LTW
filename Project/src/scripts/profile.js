function profileOverview() {
    document.getElementById("profile-settings-tab").style.display = "none";
    document.getElementById("profile-security-tab").style.display = "none";
    document.getElementById("profile-comments-tab").style.display = "none";
    document.getElementById("profile-overview-tab").style.display = "display";
}

function profileSettings() {
    document.getElementById("profile-overview-tab").style.display = "none";
    document.getElementById("profile-security-tab").style.display = "none";
    document.getElementById("profile-comments-tab").style.display = "none";
    document.getElementById("profile-settings-tab").style.display = "block";
}

function profileComments() {
    document.getElementById("profile-overview-tab").style.display = "none";
    document.getElementById("profile-settings-tab").style.display = "none";
    document.getElementById("profile-security-tab").style.display = "none";
    document.getElementById("profile-comments-tab").style.display = "block";
}

function profileSecurity() {
    document.getElementById("profile-overview-tab").style.display = "none";
    document.getElementById("profile-settings-tab").style.display = "none";
    document.getElementById("profile-comments-tab").style.display = "none";
    document.getElementById("profile-security-tab").style.display = "block";
}

function checkEmail() {
    var xhttp = new XMLHttpRequest();
    var asynchronous = true;

    //if(!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['age']) || !isset($_POST['password']))
    
    xhttp.open('GET', 'getcustomer.php?q='+str, asynchronous);
    xhttp.send();

    /*if(se der erro dentro da funcao acrtion_profile_change) {
        document.getElementById('profile-settings-msg-email').innerHTML = 'Email already exists';
        document.getElementById('profile-settings-submit').disabled = false;
    }*/
}

function checkPass() {
    if(document.getElementById('password').value.length == 0 ||
        document.getElementById('password').value ==document.getElementById('confirm_password').value) {

        document.getElementById('password').style.backgroundColor = 'white';
        document.getElementById('password').style.border = 'solid 1px rgb(176, 183, 187)'
        document.getElementById('confirm_password').style.backgroundColor = 'white';
        document.getElementById('confirm_password').style.border = 'solid 1px rgb(176, 183, 187)'
        document.getElementById('profile-settings-msg').innerHTML = '';
        document.getElementById('profile-settings-submit').disabled = false;
    }
    else {
        document.getElementById('confirm_password').style.backgroundColor  = 'rgb(246, 220, 220)';
        document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
        document.getElementById('profile-settings-msg').innerHTML = 'The password\'s don\'t match';
        document.getElementById('profile-settings-msg').style.color = 'red';
        document.getElementById('profile-settings-submit').disabled = true;
    }
}

function submitForm(option){
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let request, name, email, age, password;

    switch(option) {
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
        switch(option) {
        // user email
        case 1:
            emailAfter = document.getElementById('email').value;
            if(email != emailAfter) {
                document.getElementById('profile-settings-msg-email').innerHTML = 'Email already exists';
                document.getElementById('profile-settings-msg-email').style.color = 'red';
                alert('error');
            }
            else {
                alert('no error');
                document.getElementById('profile-settings-msg-email').innerHTML = '';
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

    xhttp.open('POST', '../actions/action_profile_change.php?'+request, asynchronous);
    xhttp.send();
}