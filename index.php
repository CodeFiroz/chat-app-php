

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel="stylesheet" href="style.css">

    <?php

include("user.php");

if(!isset($_COOKIE['user'])){
    ?>

    <script>
        var name = window.prompt("Please Your Name :  ");
        if(name === null){
            window.location.reload();
        }else{
            alert(name);
        $.ajax({
            url: "user.php",
            type: 'POST',
            data: {"name": name, "type": "register"},
            success: function(res){
                alert(res);
                // if(res == 200){
                //     alert("Done");
                //     window.location.reload();
                // }
            }
        })      
    }
    </script>

    <?php
}

?>

</head>
<body>

    <div class="wrapper">

    <div class="helloText">
    <i class="fi fi-ts-smile-beam"></i> Hello <span><?php echo $_COOKIE['user'];?></span>
    </div>

        <div class="display">
        
            
           

        </div>

        <div class="msg_type">
            <input type="text" placeholder="Your Text ..." id="input">
            <button type="button" onclick="submitMSG()"><i class="fi fi-tr-paper-plane-top"></i></button>
        </div>

    </div>


    <script>
   


   var userInput = document.getElementById('input');
var display = document.querySelector(".display");

function submitMSG() {
    var msgText = document.querySelector("#input").value;

    $.ajax({
        url: "user.php",
        type: 'POST',
        data: { "msg": msgText, "action": "msg" },
        success: function (res) {
            if (res == 200) {
                userInput.value = "";
            }
        }
    });
}

function fetchAndDisplayData() {
    $.ajax({
        url: 'msg.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            displayData(data);
        },
        error: function (xhr, status, error) {
            console.error("Ajax request failed. Status: " + status + ", Error: " + error);
        }
    });
}

function displayData(data) {
    var resultContainer = $('.display');
    var isScrolledToBottom = resultContainer[0].scrollHeight - resultContainer.scrollTop() === resultContainer.outerHeight();

    // Clear the existing content before appending new messages
    resultContainer.html('<h2>Messages</h2>');

    if (data.length === 0) {
        resultContainer.append('<p>No messages available.</p>');
    } else {
        data.forEach(function (item) {
            resultContainer.append(`<div class="msg"><span>${item.user}:</span> ${item.msg}</div>`);
        });

       
            resultContainer.scrollTop(resultContainer[0].scrollHeight);
       
    }
}



// Fetch and display data initially
fetchAndDisplayData();

// Periodically fetch and display data (every 5 seconds in this example)
setInterval(fetchAndDisplayData, 500);  // Adjust the interval as needed




userInput.addEventListener('input', function() {

isTyping = true;

console.log(isTyping);

var typingTimeout = setTimeout(function() {
// User has stopped typing
isTyping = false;
console.log("stop!");
}, 1000); // Adjust the timeout duration as needed


});

    </script>
    
</body>
</html>