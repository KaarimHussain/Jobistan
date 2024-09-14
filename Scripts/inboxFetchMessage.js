$(document).ready(function () {
    var sendMessageBtn = $('#sendMessageBtn');
    var messageInput = $('#messageInput');
    // Calling the function every 0.5s to implement the chatting functionality and fetching all the messages
    setInterval(fetchMessages, 500);
    function fetchMessages() {
        console.log("Called");

        $.ajax({
            type: "POST",
            url: "./fetchInboxMessage.php",
            data: {
                'receiver_id': $('#emp_id').data('recruiter-id'),
            },
            dataType: "html",
            success: function (response) {
                $('#messageBoxResponse').html(response);
            },
            error: function (xhr, status, error) {
                clearInterval(fetchMessages);
                console.log(xhr.responseText);
                console.log(status);
            }
        });
    }
    // Handle the Enter Event for Calling the Function and Emptying the Input Value
    $(sendMessageBtn).on('click', function () {
        if (messageInput.val() === '') return alert('Input Cannot be Null');;
        sendMessage(messageInput.val());
        messageInput.val('');
    })
    messageInput.on('keyup', function (e) {
        if (e.keyCode === 13) { // Prevent form submission
            if (messageInput.val() === '') return alert('Input Cannot be Null');
            sendMessage(messageInput.val());
            messageInput.val('');
        }
    });
    // This method Sends the Message to the DataBase
    function sendMessage(message) {
        console.log("Called");

        $.ajax({
            type: "POST",
            url: "./inboxSendMessage.php",
            data: {
                "message": message,
                "receiver_id": $('#emp_id').data('recruiter-id')
            },
            dataType: "json",
            success: function (response) {
                console.log(response.status, response.message);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
            }
        });
    }
});