let maxGuests = document.getElementById('guests').value;


function checkGuests() {
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let babies = document.getElementById('babies').value;

    return (adults + children + babies) < maxGuests;
}


function addAdult() {
    let adults = document.getElementById('adults').value;

    if (checkGuests()) {
        
    }
}