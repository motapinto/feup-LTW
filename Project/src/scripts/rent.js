"use strict";


let maxGuests = document.getElementById('guests')?document.getElementById('guests').value:0;
let ADULTS = 0;
let CHILDREN = 1;
let BABIES = 2;
let ADD = 0;
let SUB = 1;
let xhttp = new XMLHttpRequest();
let asynchronous = true;

$(function () {
    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
});

$(document).ready(function () {
    Galleria.loadTheme('../../assets/galleria/src/themes/classic/galleria.classic.js');
    Galleria.run('#galleria');
});


if(document.getElementById('rent-header')){
    document.getElementById('adults-add').onclick = function (event) { guestsChange(ADULTS, ADD) }
    document.getElementById('adults-sub').onclick = function (event) { guestsChange(ADULTS, SUB) }
    document.getElementById('children-add').onclick = function (event) { guestsChange(CHILDREN, ADD) }
    document.getElementById('children-sub').onclick = function (event) { guestsChange(CHILDREN, SUB) }
    document.getElementById('babies-add').onclick = function (event) { guestsChange(BABIES, ADD) }
    document.getElementById('babies-sub').onclick = function (event) { guestsChange(BABIES, SUB) }
    
    document.getElementById('rent-button').onclick = submitRent;
}

//  Submit form to change/delete profile
function submitRent(event) {
    document.getElementById('rent-button').onclick = null;
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    
    let request = encodeForAjax({
        csrf: document.getElementById('csrf').value, 
        id: document.getElementById('id').value,
        daterange: document.getElementById('calendar').value,
        adults: document.getElementById('adults').value,
        children: document.getElementById('children').value,
        babies: document.getElementById('babies').value
    });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        switch (response['response']) {
            case 0:
                if (document.getElementById('check') === null) {
                    let check = document.createElement('i');
                    check.id = 'check';
                    document.getElementById('rent-button').appendChild(check);                    
                }
                document.getElementById('check').className = 'fas fa-check';
                document.getElementById('rent-button').style.backgroundColor = 'green';
                break;
            
            //Error in db
            default:
                if (document.getElementById('check') === null) {
                    let check = document.createElement('i');
                    check.id = 'check';
                    document.getElementById('rent-button').appendChild(check);
                }
                document.getElementById('check').className = 'fas fa-times';
                document.getElementById('rent-button').style.backgroundColor = 'red';
                document.getElementById('rent-button').onclick = submitRent;
        }
    });

    xhttp.addEventListener('error', function (event) {
        if (document.getElementById('check') === null) {
            let check = document.createElement('div');
            check.id = 'check';
            document.getElementById('rent-button').appendChild(check);
        }
        document.getElementById('check').className = 'fas fa-times';
        document.getElementById('rent-button').style.backgroundColor = 'red';
        document.getElementById('rent-button').onclick = submitRent;
    });


    xhttp.open('GET', '../apis/api_rent.php?' + request, asynchronous);
    xhttp.send();
}


function checkGuests(option) {
    switch (option) {
        case ADD:
            let adults = parseInt(escapeHtml(document.getElementById('adults').value), 10);
            let children = parseInt(escapeHtml(document.getElementById('children').value), 10);
            let babies = parseInt(escapeHtml(document.getElementById('babies').value), 10);
        
            return (adults + children + babies) < maxGuests;

        case SUB:
            let currentGuests = parseInt(document.getElementById('current-guests').textContent, 10);
            return currentGuests > 1;
        default:
            return -1;
    }
}


function guestsChange(type, option) {
    let id;
    switch (type) {
        case ADULTS:
            id = 'adults';
            break;

        case CHILDREN:
            id = 'children';
            break;

        case BABIES:
            id = 'babies';
            break;

        default:
            return -1;
    }

    switch (option) {
        case ADD:
            if (checkGuests(ADD)) {
                document.getElementById(id).value = parseInt(escapeHtml(document.getElementById(id).value), 10) + 1;
                document.getElementById('msg-guests').display = 'none';
            }
            else {
                document.getElementById('msg-guests').textContent = 'Maximum number of guests reached';
                document.getElementById('msg-guests').display = 'block';
            }
            break;
    
        case SUB:
            if (checkGuests(SUB)) {
                document.getElementById(id).value = parseInt(escapeHtml(document.getElementById(id).value), 10) - 1;
                document.getElementById('msg-guests').display = 'none';
            }
            else {
                document.getElementById('msg-guests').textContent = 'Number of guests must be higher then 0';
                document.getElementById('msg-guests').display = 'block';
            }
            break;

        default:
            break;
    }

    // Change current-guests number
    document.getElementById('current-guests').textContent = (parseInt(escapeHtml(document.getElementById('adults').value)) + parseInt(escapeHtml(document.getElementById('children').value)) + parseInt(escapeHtml(document.getElementById('babies').value))).toString();
}
