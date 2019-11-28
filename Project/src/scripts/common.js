function checkName() {
    let name = document.getElementsByClassName('name')[0].value;
    let nameTest = new RegExp("^[a-zA-Z\u00C0-\u00FF]+(([' -][a-zA-Z\u00C0-\u00FF])?[a-zA-Z\u00C0-\u00FF]*)*$");
    let isLegal = nameTest.test(name);

    if(isLegal || name.length === 0) {
        document.getElementsByClassName('name')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-name')[0].innerHTML = '';
        return true;
    }
    else {
        document.getElementsByClassName('name')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-name')[0].style.color = 'red';
        document.getElementsByClassName('msg-name')[0].innerHTML = 'Enter a valid name';
        return false;
    }
}

function checkAge() {
    let age = document.getElementsByClassName('age')[0].value;
    let isLegal = document.getElementsByClassName('age')[0].value>=18 ? true : false;

    if(isLegal || age.length === 0) {
        document.getElementsByClassName('age')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-age')[0].innerHTML = '';
        return true;
    }
    else {
        document.getElementsByClassName('age')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-age')[0].style.color = 'red';
        document.getElementsByClassName('msg-age')[0].innerHTML = 'Must be over than 18';
        return false;
    }
}

function checkEmail() {
    let email = document.getElementsByClassName('email')[0].value;
    let emailTest = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
    let isLegal = emailTest.test(email);

    if(isLegal || email.length === 0) {
        document.getElementsByClassName('email')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-email')[0].innerHTML = '';
        return true;
    }
    else {
        document.getElementsByClassName('email')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-email')[0].style.color = 'red';
        document.getElementsByClassName('msg-email')[0].innerHTML = 'Enter a valid email';
        return false;
    }
}

function checkPass() {
    let password = document.getElementsByClassName('name')[0].value;
    //let passwordTest = new RegExp("([A-Z])\w+");
    //let isLegal = passwordTest.test(password);
    let isLegal = true;

    if(isLegal || password.length === 0) {
        document.getElementsByClassName('password')[0].style.backgroundColor = 'white';
        document.getElementsByClassName('msg-password')[0].innerHTML = '';
        return true;
    }
    else {
        document.getElementsByClassName('password')[0].style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementsByClassName('msg-password1')[0].style.color = 'red';
        document.getElementsByClassName('msg-password1')[0].innerHTML = 'Enter a valid password';
        return false; 
    }
}