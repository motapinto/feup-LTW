"use strict";

let entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
};


function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}

function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }

if (document.getElementById('dropdown-btn') && document.getElementById('dropdown'))
    document.getElementById('dropdown-btn').onclick = dropdown;

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function dropdown() {
    document.getElementById('dropdown').style.display = (document.getElementById('dropdown').style.display == 'none') ? 'block' : 'none';
}

function checkName(inProfile = false) {
    let name = escapeHtml(document.getElementById('name').value);
    let nameTest = new RegExp("^[a-zA-Z\u00C0-\u00FF]+(([' -][a-zA-Z\u00C0-\u00FF])?[a-zA-Z\u00C0-\u00FF]*)*$");
    let isLegal = nameTest.test(name);

    if(isLegal) {
        document.getElementById('name').style.backgroundColor = 'white';
        document.getElementById('msg-name').innerHTML = '';
        if(inProfile) {
            document.getElementById('name').style.border = 'solid 1px rgb(176, 183, 187)';
            document.getElementById('icon-name').style.color = 'black';
            document.getElementById('icon-name').className = 'fas fa-check';
            document.getElementById('user-name').textContent = name;
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
        }
        return false;
    }
}

function checkAge(inProfile=false) {
    let age = escapeHtml(document.getElementById('age').value);

    if (age >= 18) {
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
        }
        return false;
    }
}

function checkEmail(inProfile=false) {
    let email = escapeHtml(document.getElementById('email').value);
    let emailTest = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)*$/;
    let isLegal = emailTest.test(email);

    if(isLegal) {
        document.getElementById('email').style.backgroundColor = 'white';
        document.getElementById('msg-email').innerHTML = '';
        if(inProfile) {
            document.getElementById('email').style.border = 'solid 1px rgb(176, 183, 187)';
        }
        return true;
    }
    else {
        document.getElementById('email').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('msg-email').style.color = 'red';
        document.getElementById('msg-email').innerHTML = 'Enter a valid email';
        if(inProfile) {
            document.getElementById('email').style.border = 'solid 1px rgb(233, 76, 76)';
        }
        return false;
    }
}

function checkPass() {
    let password = escapeHtml(document.getElementById('password').value);
    let isLegal = /(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./.test(password);

    if (isLegal) {
        document.getElementById('password').style.backgroundColor = 'white';
        document.getElementById('msg-password1').innerHTML = '';
        if (document.getElementById('confirm_password').value != password) {
            if (document.getElementById('password-change'))
                document.getElementById('password-change').disabled = true;
            
            document.getElementById('confirm_password').style.backgroundColor = 'rgb(246, 220, 220)';
            document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
            document.getElementById('msg-password2').innerHTML = 'The password\'s don\'t match';
            document.getElementById('msg-password2').style.color = 'red';
        }
        else {
            if (document.getElementById('password-change'))
            document.getElementById('password-change').disabled = false;

            document.getElementById('confirm_password').style.backgroundColor = 'white';
            document.getElementById('confirm_password').style.border = 'solid 1px rgb(176, 183, 187)'
            document.getElementById('msg-password2').innerHTML = '';
            return true;
        }
    }
    else {
        document.getElementById('password').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('msg-password1').style.color = 'red';
        document.getElementById('msg-password1').innerHTML = 'Enter a valid password';
    }
    return false; 
}