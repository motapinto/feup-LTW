function checkName(inProfile=false) {
    let name = document.getElementById('name').value;
    let nameTest = new RegExp("^[a-zA-Z\u00C0-\u00FF]+(([' -][a-zA-Z\u00C0-\u00FF])?[a-zA-Z\u00C0-\u00FF]*)*$");
    let isLegal = nameTest.test(name);

    if(isLegal) {
        document.getElementById('name').style.backgroundColor = 'white';
        document.getElementById('msg-name').innerHTML = '';
        if(inProfile) {
            document.getElementById('name').style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-name').style.color = 'black';
            document.getElementById('icon-name').className = 'fas fa-check';
            document.getElementById('user-name').textContent = document.getElementById('name').value;
            submitForm(0);
        }
        return true;
    }
    else {
        document.getElementById('name').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('msg-name').style.color = 'red';
        document.getElementById('msg-name').innerHTML = 'Name can only contain letters, spaces and \'-\'';
        if(inProfile) {
            document.getElementById('name').style.border = 'solid 1px rgb(233, 76, 76)';
            document.getElementById('icon-name').style.color = 'red';
            document.getElementById('icon-name').className = 'fas fa-times';
            submitForm(-1);
        }
        return false;
    }
}

function checkAge(inProfile=false) {
    let age = document.getElementById('age').value;
    let isLegal = age>=18 ? true : false;

    if(isLegal) {
        document.getElementById('age').style.backgroundColor = 'white';
        document.getElementById('msg-age').innerHTML = '';
        if(inProfile) {
            document.getElementById('age').style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-age').style.color = 'black';
            document.getElementById('icon-age').className = 'fas fa-check';
            submitForm(2);
        }
        return true;
    }
    else {
        document.getElementById('age').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('msg-age').style.color = 'red';
        document.getElementById('msg-age').innerHTML = 'Must be over than 18';
        if(inProfile) {
            document.getElementById('age').style.border = 'solid 1px rgb(233, 76, 76)';
            document.getElementById('icon-age').style.color = 'red';
            document.getElementById('icon-age').className = 'fas fa-times';
            submitForm(-1);
        }
        return false;
    }
}

function checkEmail(inProfile=false) {
    let email = document.getElementById('email').value;
    let emailTest = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
    let isLegal = emailTest.test(email);

    if(isLegal) {
        document.getElementById('email').style.backgroundColor = 'white';
        document.getElementById('msg-email').innerHTML = '';
        if(inProfile) {
            document.getElementById('email').style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-email').style.color = 'black';
            document.getElementById('icon-email').className = 'fas fa-check';
            submitForm(1);
        }
        return true;
    }
    else {
        document.getElementById('email').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('msg-email').style.color = 'red';
        document.getElementById('msg-email').innerHTML = 'Enter a valid email';
        if(inProfile) {
            document.getElementById('email').style.border = 'solid 1px rgb(233, 76, 76)';
            document.getElementById('icon-email').style.color = 'red';
            document.getElementById('icon-email').className = 'fas fa-times';
            submitForm(-1);
        }
        return false;
    }
}

function checkPass() {
    let password = document.getElementById('password').value;
    let isLegal = /(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./.test(password);

    if (isLegal) {
        document.getElementById('password').style.backgroundColor = 'white';
        document.getElementById('msg-password1').innerHTML = '';
        return true;
    }
    else {
        document.getElementById('password').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('msg-password1').style.color = 'red';
        document.getElementById('msg-password1').innerHTML = 'Enter a valid password';
        return false; 
    }
}