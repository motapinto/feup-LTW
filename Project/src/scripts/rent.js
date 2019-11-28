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
            return maxGuests > 0;
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
                document.getElementById('adults').value++;
                document.getElementById('msg-guests').textContent = '';
            }
            else {
                document.getElementById('msg-guests').textContent = 'Maximum number of guests reached';
            }
            break;
    
        case SUB:
            if (checkGuests(SUB)) {
                document.getElementById('adults').value--;
                document.getElementById('msg-guests').textContent = '';
            }
            else {
                document.getElementById('msg-guests').textContent = 'Number of guests must be higher then 0';
            }
            break;

        default:
            break;
    }
}

