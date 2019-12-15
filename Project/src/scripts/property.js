
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

document.getElementById('price').onkeyup = function (event) { checkText('title'); }

document.getElementById('price').onkeyup = function (event) { checkText('description'); }

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
    let numbers = new RegExp("^[a-zA-Z]*$");
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

function checkText(id) {
    let text = new RegExp("^(?=.*[a-zA-Z\d].*)[a-zA-Z\d!@#$%&*]*$");
    let isLegal = text.test(document.getElementById(id).value);

    if(isLegal) {
        document.getElementById("add-button").disabled = false;
        document.getElementById(id).style.color = 'black';
        document.getElementById(id).style.backgroundColor = 'white';
        document.getElementById(id).style.border = 'solid 1px rgb(176, 183, 187)';
    }
    else {
        alert('Only text is accepted')
        document.getElementById("add-button").disabled = true;
        document.getElementById(id).style.color = 'red';
        document.getElementById(id).style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById(id).style.border = 'solid 1px rgb(233, 76, 76)';
    }
}

document.getElementById('add-pic').onclick = function (event) { 
    document.getElementById('add-pic-upload').click(); 
}

document.getElementById('add-pic-upload').onchange = function () { addPic(this.files); };

document.getElementById('remove-pic').onclick = function () { removePic(); };

function addPic(files) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;

    let request = encodeForAjax({ image: files});

    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);

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

    xhttp.open('FILES', '../actions/action_property_image.php?' + request, asynchronous);
    xhttp.send();
}

//  Removes last/selected property image
function removePic() {
    // deleteImage(?, 'PROPERTY')
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
