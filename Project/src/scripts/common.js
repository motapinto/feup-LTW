function checkName(inProfile=false) {
    let name = document.getElementsByClassName('name')[0].value;
    let nameTest = new RegExp("^[a-zA-Z\u00C0-\u00FF]+(([' -][a-zA-Z\u00C0-\u00FF])?[a-zA-Z\u00C0-\u00FF]*)*$");
    let isLegal = nameTest.test(name);

    if(isLegal) {
        document.getElementsByClassName('name')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-name')[0].innerHTML = '';
        if(inProfile) {
            document.getElementsByClassName('name')[0].style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-name').style.color = 'black';
            document.getElementById('icon-name').className = 'fas fa-check';
            document.getElementById('user-name').textContent = document.getElementsByClassName('name')[0].value;
            submitForm(0);
        }
        return true;
    }
    else {
        document.getElementsByClassName('name')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-name')[0].style.color = 'red';
        document.getElementsByClassName('msg-name')[0].innerHTML = 'Name can only contain letters, spaces and \'-\'';
        if(inProfile) {
            document.getElementsByClassName('name')[0].style.border = 'solid 1px rgb(233, 76, 76)';
            document.getElementById('icon-name').style.color = 'red';
            document.getElementById('icon-name').className = 'fas fa-times';
            submitForm(-1);
        }
        return false;
    }
}

function checkAge(inProfile=false) {
    let age = document.getElementsByClassName('age')[0].value;
    let isLegal = age>=18 ? true : false;

    if(isLegal) {
        document.getElementsByClassName('age')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-age')[0].innerHTML = '';
        if(inProfile) {
            document.getElementsByClassName('age')[0].style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-age').style.color = 'black';
            document.getElementById('icon-age').className = 'fas fa-check';
            submitForm(2);
        }
        return true;
    }
    else {
        document.getElementsByClassName('age')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-age')[0].style.color = 'red';
        document.getElementsByClassName('msg-age')[0].innerHTML = 'Must be over than 18';
        if(inProfile) {
            document.getElementsByClassName('age')[0].style.border = 'solid 1px rgb(233, 76, 76)';
            document.getElementById('icon-age').style.color = 'red';
            document.getElementById('icon-age').className = 'fas fa-times';
            submitForm(-1);
        }
        return false;
    }
}

function checkEmail(inProfile=false) {
    let email = document.getElementsByClassName('email')[0].value;
    let emailTest = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
    let isLegal = emailTest.test(email);

    if(isLegal) {
        document.getElementsByClassName('email')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-email')[0].innerHTML = '';
        if(inProfile) {
            document.getElementsByClassName('email')[0].style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-email').style.color = 'black';
            document.getElementById('icon-email').className = 'fas fa-check';
            submitForm(1);
        }
        return true;
    }
    else {
        document.getElementsByClassName('email')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-email')[0].style.color = 'red';
        document.getElementsByClassName('msg-email')[0].innerHTML = 'Enter a valid email';
        if(inProfile) {
            document.getElementsByClassName('email')[0].style.border = 'solid 1px rgb(233, 76, 76)';
            document.getElementById('icon-email').style.color = 'red';
            document.getElementById('icon-email').className = 'fas fa-times';
            submitForm(-1);
        }
        return false;
    }
}

function checkPass() {
    let password = document.getElementsByClassName('name')[0].value;
    let isLegal = /(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./.test(password);

    if(isLegal) {
        document.getElementsByClassName('password')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-password1')[0].innerHTML = '';
        return true;
    }
    else {
        document.getElementsByClassName('password')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-password1')[0].style.color = 'red';
        document.getElementsByClassName('msg-password1')[0].innerHTML = 'Enter a valid password';
        return false; 
    }
}