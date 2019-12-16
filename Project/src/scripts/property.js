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
    let property_id = document.getElementById('id').value;

    let request = encodeForAjax({ 
        title: title, 
        description: description,
        price_day:price_day, 
        guests:guests, 
        city:city, 
        street:street, 
        door_number:door_number, 
        apartment_number:apartment_number,
        property_type:property_type,
        id:property_id
    });

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        alert(response['response']);
        switch (response['response']) {
            case 0:
                alert('SUCCESS')
                break;

            default:
                alert('FAIL')
                break;
        }
    });

    xhttp.addEventListener('error', function (event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../actions/action_change_property.php?' + request, asynchronous);
    xhttp.send();
}

document.getElementById('price').onkeyup = function (event) { checkPrice(); }

document.getElementById('guests').onkeyup = function (event) { checkNumber('guests'); }

document.getElementById('city').onkeyup = function (event) { checkString('city'); }

document.getElementById('street').onkeyup = function (event) { checkString('street'); }

document.getElementById('door_number').onkeyup = function (event) { checkNumber('door_number'); }

document.getElementById('apart_number').onkeyup = function (event) { checkNumber('apartment_number'); }

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

    if(isLegal && document.getElementById('door_number').value > 0) {
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

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);

        switch (response['response']) {
            case 0:
                if(files != null) {
                    galleria.push({image: '../../assets/images/properties/o_'+response['name']+'.png'})
                }
                else {    
                    console.log(galleria.getData());
                    galleria.splice( galleria.getIndex(), 1);
                }
                break;

            default:
                //error
                break;
        }
    });

    xhttp.addEventListener('error', function (event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('POST', '../actions/action_property_image.php', asynchronous);
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
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let request = encodeForAjax({
        id: id,
        owner: document.getElementById('my-id')
    });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        if (response['response'] === 0) {
            let rents = document.getElementsByClassName('rent-id');
            for (let i = 0; i < rents.length; i++) {
                if (parseInt(rents.item(i).value) === id) {
                    let elements = document.getElementsByClassName('history-item');
                    elements[i].parentNode.removeChild(elements[i]);
                }
            }
            setCancelActions();
        }
    });


    xhttp.open('GET', '../actions/action_cancel_rent.php?' + request, asynchronous);
    xhttp.send();

}
