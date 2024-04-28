newsPull();

function newsSendDatabase(title, content, date){
    fetch("newsSend.php", {
        "method": "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        "body": "title="+title+"&content="+content+"&date="+date
      });
}

function updateDatabase(title, content, id){
    fetch("newsUpdate.php", {
        "method": "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        "body": "title="+title+"&content="+content+"&id="+id
      });
}

async function newsPull(){
    console.log(getDate());
    var res = await fetch("newsPull.php", {
        "method": "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        "body": "actual="+1
        });
    var data = await res.json();
    var obj = document.getElementById("news");
    obj.innerHTML = "";
    if(data.length === 0){
        obj += "Nincs új hír";
    }else{
        var sv = "<h2>news:</h2>";
        for (let i = 0; i < data.length; i++) {
            var date = data[i]["date"];
            var title = data[i]["title"];
            var content = data[i]["content"];
            sv += "<div class='newsBoxes'><p class='newsDate'>" + date + "</p><p class='newsTitle'>" + title + "</p><p class='newsContent'>" + content + "</p></div>";
        }
    }
    obj.innerHTML = sv;
}

function sendNews(){
    var title = document.getElementById("titleInput").value;
    var content = document.getElementById("contentInput").value;
    var date = getDate();
    newsSendDatabase(title, content, date);
    document.getElementById("titleInput").value = "";
    document.getElementById("contentInput").value = "";
}

function updateNews(row){
    var title = document.getElementById("newsTitleChange").value;
    var content = document.getElementById("newsContentChange").value;
    var id = row;
    updateDatabase(title, content, id);
    window.location.href = 'adminInterface.php?mod=news&edit=';
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