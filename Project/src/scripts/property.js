'use strict';

let galleria;

$(document).ready(function () {
    Galleria.loadTheme('../../assets/galleria/src/themes/classic/galleria.classic.js');
    Galleria.run('#galleria');

    galleria = Galleria.get(0);
});

document.getElementById("add-button").onclick = function (event) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let title = document.getElementById('title').value;
    let description = document.getElementById('description').value;
    let price_day = document.getElementById('price').value;
    let guests = document.getElementById('guests').value;
    let city = document.getElementById('city').value;
    let street = document.getElementById('street').value;
    let door_number = document.getElementById('door_number').value;
    let apartment_number = document.getElementById('apart_number').value;
    let property_type = document.getElementById('property_type').value;
    let property_id;

    let request;
    if (document.getElementById('id')) {
        property_id = document.getElementById('id').value;

        request = encodeForAjax({ 
            csrf: document.getElementById('csrf').value, 
            title: title, 
            description: description,
            price_day: price_day, 
            guests: guests, 
            city: city, 
            street: street, 
            door_number: door_number, 
            apartment_number: apartment_number,
            property_type: property_type,
            id: property_id
        }); 
    }
    else {
        request = encodeForAjax({
            csrf: document.getElementById('csrf').value, 
            title: title,
            description: description,
            price_day: price_day,
            guests: guests,
            city: city,
            street: street,
            door_number: door_number,
            apartment_number: apartment_number,
            property_type: property_type
        }); 
    }

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);

        if (property_id != undefined) {
            switch (response['response']) {
                case 0:
                    alert('Changed property details with success')
                    break;
    
                default:
                    alert('Failed changing property details! Try again')
                    break;
            }
        }
        else {
            switch (response['response']) {
                case -1:
                    alert('Failed changing property details! Try again')
                    break;
                    
                default:
                    window.location += 'id=' + response.response;
                    break;
            }
        }
    });

    xhttp.addEventListener('error', function (event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../apis/api_change_property.php?' + request, asynchronous);
    xhttp.send();
}

document.getElementById('price').onkeyup = function (event) { checkPrice(); }

document.getElementById('guests').onkeyup = function (event) { checkNumber('guests'); }

document.getElementById('city').onkeyup = function (event) { checkString('city'); }

document.getElementById('street').onkeyup = function (event) { checkString('street'); }

document.getElementById('door_number').onkeyup = function (event) { checkNumber('door_number'); }

document.getElementById('apart_number').onkeyup = function (event) { checkNumber('apartment_number'); }

if(document.getElementById('delete-property'))
    document.getElementById('delete-property').onclick = deleteProperty;

function deleteProperty(event) {
    if (!confirm('Are you sure you want to delete this property?')) return;

    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let request = encodeForAjax({
        csrf: document.getElementById('csrf').value,
        id: document.getElementById('id').value
    });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        if (response['response'] === 0) {
            window.location = '../properties/properties.php';
        }
    });


    xhttp.open('GET', '../apis/api_property_delete.php?' + request, asynchronous);
    xhttp.send();
}

function checkPrice() {
    let numbers = new RegExp("^[0-9]*$");
    let isLegal = numbers.test(document.getElementById('price').value);

    if(!isLegal) {
        alert('only numbers')
        document.getElementById("add-button").disabled = true;
        document.getElementById('price').style.color = 'red';
        document.getElementById('price').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('price').style.border = 'solid 1px rgb(233, 76, 76)';
    }
    else if(document.getElementById('price').value <= 0) {
        alert('price must be higher than 0')
        document.getElementById("add-button").disabled = true;
        document.getElementById('price').style.color = 'red';
        document.getElementById('price').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('price').style.border = 'solid 1px rgb(233, 76, 76)';
    }
    else if(document.getElementById('price').value > 500) {
        alert('price to high')
        document.getElementById("add-button").disabled = true;
        document.getElementById('price').style.color = 'red';
        document.getElementById('price').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('price').style.border = 'solid 1px rgb(233, 76, 76)';
    }
    else {
        document.getElementById("add-button").disabled = false;
        document.getElementById('price').style.color = 'black';
        document.getElementById('price').style.backgroundColor = 'white';
        document.getElementById('price').style.border = 'solid 1px rgb(176, 183, 187)';
    }
}

function checkNumber(id) {
    let numbers = new RegExp("^[0-9]*$");
    let isLegal = numbers.test(document.getElementById(id).value);

    if(isLegal && document.getElementById(id).value > 0) {
        document.getElementById("add-button").disabled = false;
        document.getElementById(id).style.color = 'black';
        document.getElementById(id).style.backgroundColor = 'white';
        document.getElementById(id).style.border = 'solid 1px rgb(176, 183, 187)';
    }
    else {
        alert('Only numbers greater than 0 are accepted')
        document.getElementById("add-button").disabled = true;
        document.getElementById(id).style.color = 'red';
        document.getElementById(id).style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById(id).style.border = 'solid 1px rgb(233, 76, 76)';
    }
}

function checkString(id) {
    let numbers = new RegExp("^[a-zA-Z ]*$");
    let isLegal = numbers.test(document.getElementById(id).value);

    if(isLegal) {
        document.getElementById("add-button").disabled = false;
        document.getElementById(id).style.color = 'black';
        document.getElementById(id).style.backgroundColor = 'white';
        document.getElementById(id).style.border = 'solid 1px rgb(176, 183, 187)';
    }
    else {
        alert('Only letters are accepted')
        document.getElementById("add-button").disabled = true;
        document.getElementById(id).style.color = 'red';
        document.getElementById(id).style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById(id).style.border = 'solid 1px rgb(233, 76, 76)';
    }
}

//  Add/Remove pcitures of property's
document.getElementById('add-pic').onclick = function (event) { 
    document.getElementById('add-pic-upload').click(); 
}

document.getElementById('add-pic-upload').onchange = function () { changePic(this.files); };

document.getElementById('remove-pic').onclick = function () { changePic(null); };

function changePic(files) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let id = document.getElementById('id').value;
    let data = new FormData();
    

    if(files === null && galleria != undefined) {
        let photoName = galleria.getActiveImage().src.match(/_([\w]+).png/);
        if(photoName === null)
            return;
        
        else 
            photoName = photoName[1];

        data.append('name', photoName);
    }
    else {
        data.append('image', files[0]);
    }

    data.append('property_id', id);
    data.append('csrf', document.getElementById('csrf').value);

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);

        switch (response['response']) {
            case 0:
                window.location = window.location;
                break;

            default:
                //error
                break;
        }
    });

    xhttp.addEventListener('error', function (event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('POST', '../apis/api_property_image.php', asynchronous);
    xhttp.send(data);
}

setCancelActions();

function setCancelActions() {
    let rents = document.getElementsByClassName('cancel-button');
    for (let i = 0; i < rents.length; i++) {
        rents[i].onclick = function (event) {
            cancelRent(parseInt(document.getElementsByClassName('rent-id')[i].value));
        };
    }
}

// Cancels rent with id
function cancelRent(id) {
    if (!(id >= 0)) return;

    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let request = encodeForAjax({
        csrf: document.getElementById('csrf').value, 
        id: id,
        owner: document.getElementById('my-id')
    });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        if (response['response'] === 0) {
            let rents = document.getElementsByClassName('rent-id');
            for (let i = 0; i < rents.length; i++) {
                if (parseInt(rents.item(i).value, 10) === id) {
                    let elements = document.getElementsByClassName('history-item');
                    elements[i].parentNode.removeChild(elements[i]);
                }
            }
            setCancelActions();
        }
    });


    xhttp.open('GET', '../apis/api_cancel_rent.php?' + request, asynchronous);
    xhttp.send();

}
