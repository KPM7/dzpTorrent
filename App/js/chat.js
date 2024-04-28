chatPull();

var copy = [];
var chatInterval;

function chatButton() {
    var chatwindow = document.getElementById('chatwindow');
    if (chatwindow.style.left != '0px'){
        chatwindow.style.left = '0px';
        chatInterval = window.setInterval(chatPull, 1000);
    }
    else{
        chatwindow.style.left = '-100%';
        window.clearInterval(chatInterval);
    }
}

function chatBackColor(color) {
    var chatColor = document.getElementById('messages');
    switch (color) {
        case 'white':
            chatColor.classList.remove('gray');
            chatColor.classList.remove('black');
            chatColor.classList.add('white');
            break;
        case 'gray':
            chatColor.classList.remove('white');
            chatColor.classList.remove('black');
            chatColor.classList.add('gray');
            break;
        default:
            chatColor.classList.remove('white');
            chatColor.classList.remove('gray');
            chatColor.classList.add('black');
            break;
    }
}
function chatSendDatabase(message, date){
    fetch("chatSend.php", {
        "method": "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        "body": "date=" + date + "&message=" + message
    });
}

document.getElementById("chatInput").addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        sendMessage();
    }
});

async function chatPull() {
    var res = await fetch("chatPull.php", {
        "method": "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        "body": "start=" + 0 + "&count=" + 20
    });
    var data = await res.json();
    if(JSON.stringify(data) === JSON.stringify(copy)){
        console.log(copy, 1);
    }else{
        copy = data;
        console.log(copy, data);
        var obj = document.getElementById("messages");
        obj.innerHTML = "";
        var sv = "";
        for (let i = 0; i < data.length; i++) {
            var user = data[i]["username"];
            var date = data[i]["date"];
            var message = data[i]["content"];
            sv = "<div class='messageBoxes'><p class='messageData'><b><span id='user'>&lt;" + user + "&gt;</span> <span id='message'>" + message + "</span></b> <span id='date'>" + date + "</span></p></div>" + sv;
        }
        obj.innerHTML = sv;
    }
}

function sendMessage() {
    var message = document.getElementById("chatInput");
    var user = document.getElementById("sessionUsername").value;
    var date = getDate();
    if (message.value.trim() !== "") {
        var obj = document.getElementById("messages");
        obj.innerHTML += "<div class='messageBoxes'><p class='messageData'><span id='user'>&lt;" + user + "&gt;</span> <span id='message'>" + message.value + "</span> <span id='date'>" + date + "</span></p></div>";
        chatSendDatabase(message.value, date);
        message.value = "";
    }
}

    function getDate() {
        var d = new Date();
        var s = "";
        s += d.getFullYear() + "-";
        if (d.getMonth() + 1 < 10) s += "0";
        s += (d.getMonth() + 1) + "-";
        if (d.getDate() < 10) s += "0";
        s += d.getDate() + " ";
        if (d.getHours() < 10) s += "0";
        s += d.getHours() + ":";
        if (d.getMinutes() < 10) s += "0";
        s += d.getMinutes() + ":";
        if (d.getSeconds() < 10) s += "0";
        s += d.getSeconds();
        return s;
    }
