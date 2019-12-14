
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

    let request = encodeForAjax({ 
        title: title, 
        description: description,
        price_day:price_day, 
        guests:guests, 
        city:city, 
        street:street, 
        door_number:door_number, 
        apartment_number:apartment_number,
        property_type:property_type 
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