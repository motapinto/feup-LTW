let maxGuests = document.getElementById('guests').value;
let ADULTS = 0;
let CHILDREN = 1;
let BABIES = 2;
let ADD = 0;
let SUB = 1;


function checkGuests(option) {
    switch (option) {
        case ADD:
            let adults = document.getElementById('adults').value;
            let children = document.getElementById('children').value;
            let babies = document.getElementById('babies').value;
        
            return (adults + children + babies) < maxGuests;

        case SUB:
            let currentGuests = parseInt(document.getElementById('current-guests').textContent);
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
                document.getElementById(id).value++;
                document.getElementById('msg-guests').display = 'none';
            }
            else {
                document.getElementById('msg-guests').textContent = 'Maximum number of guests reached';
                document.getElementById('msg-guests').display = 'block';
            }
            break;
    
        case SUB:
            if (checkGuests(SUB)) {
                document.getElementById(id).value--;
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
    document.getElementById('current-guests').textContent = ((document.getElementById('adults').value + document.getElementById('children').value + document.getElementById('babies').value)/100).toString();
}

function dropdown() {
    document.getElementById('dropdown').style.display = (document.getElementById('dropdown').style.display == 'none') ? 'block' : 'none';
}