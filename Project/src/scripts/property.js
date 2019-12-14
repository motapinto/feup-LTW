document.getElementById("sendMessage").onclick = function (event) {
    let xhttp = new XMLHttpRequest();
    let asynchronous = true;
    let message = document.getElementById('message').value;
    let receiver = document.getElementById('receiver').value;
    let request = encodeForAjax({ sendMessage: message, receiver: receiver });


    // Define what happens on successful data submission
    xhttp.addEventListener('load', function (event) {
        let response = JSON.parse(this.responseText);
        switch (response['response']) {
            case 0:
                document.getElementById('sendMessage-msg').textContent = 'Message sent successfuly.';
                break;

            default:
                document.getElementById('sendMessage-msg').textContent = 'Failled to send message.';
                break;
        }
    });

    xhttp.addEventListener('error', function (event) {
        alert('Oops! Something goes wrong.');
    });

    xhttp.open('GET', '../actions/action_message_add.php?' + request, asynchronous);
    xhttp.send();
}