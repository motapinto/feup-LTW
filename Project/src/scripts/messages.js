"use strict";

if (document.getElementById("sendMessage"))
    document.getElementById("sendMessage").onclick = function (event) { 
        if (document.getElementById('message').value == '') return;
        let xhttp = new XMLHttpRequest();
        let asynchronous = true;
        let message = escapeHtml(document.getElementById('message').value);
        let receiver = escapeHtml(document.getElementById('receiver').value);
        let request = encodeForAjax({
            csrf: document.getElementById('csrf').value,
            sendMessage: message,
            receiver: receiver
        });

        // Define what happens on successful data submission
        xhttp.addEventListener('load', function (event) {
            let response = JSON.parse(this.responseText);
            switch (response['response']) {
                case 0:
                    document.getElementById('message').value = '';
                    // Create new message
                    let newMessage = document.createElement('div');
                    newMessage.className = 'message-row sent';

                    let newMessageContent = document.createElement('div');
                    newMessageContent.className = 'message-content';

                    let newMessageContentText = document.createElement('div');
                    newMessageContentText.className = 'message-text';
                    let newMessageContentTextText = document.createTextNode(message);

                    let newMessageContentTime = document.createElement('div');
                    newMessageContentTime.className = 'message-time';
                    let today = new Date();
                    let date = today.getDate() + '-' + (today.getMonth()+1) + '-' + today.getFullYear();
                    let newMessageContentTimeText = document.createTextNode(date);

                    // Construct message
                    newMessageContentText.appendChild(newMessageContentTextText);
                    newMessageContent.appendChild(newMessageContentText);

                    newMessageContentTime.appendChild(newMessageContentTimeText);
                    newMessageContent.appendChild(newMessageContentTime);

                    newMessage.appendChild(newMessageContent);

                    // Insert message into html
                    document.getElementById('messages-chatSelected').appendChild(newMessage);
                    document.getElementById('messages-chatSelected').lastChild.scrollIntoView();
                    break;

                default:
                    alert('Failled to send message');
                    break;
            }
        });

        xhttp.addEventListener('error', function (event) {
            alert('Oops! Something goes wrong.');
        });

        xhttp.open('GET', '../apis/api_message_add.php?' + request, asynchronous);
        xhttp.send();
    }
