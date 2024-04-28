helpdeskFilter();

function sendDatabase(content, topic, email){
    fetch("helpdeskSend.php", {
      "method": "POST",
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      "body": "content="+content+"&topic="+topic+"&email="+email
    });
}

async function switchHelpdesk(id){
    await fetch("helpdeskUpdate.php", {
      "method": "POST",
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      "body": "id="+id
    });
    helpdeskFilter();
}

function getDate(){
    var d = new Date();
    var s = "";
    s += d.getFullYear() + "-";
    if(d.getMonth()+1 < 10) s += "0";
    s += (d.getMonth()+1) + "-";
    if(d.getDate() < 10) s += "0";
    s += d.getDate() + " ";
    if(d.getHours() < 10) s += "0";
    s += d.getHours() + ":";
    if(d.getMinutes() < 10) s += "0";
    s += d.getMinutes() + ":";
    if(d.getSeconds() < 10) s += "0";
    s += d.getSeconds();
    return s;
}

function sendContent(){
    var content = document.getElementById("problem").value;
    var topic = document.getElementById("topic").value;
    var email = document.getElementById("helpdeskEmail").value;
    document.getElementById("problem").value = "";
    document.getElementById("topic").value = "";
    document.getElementById("helpdeskEmail").value = "";
    sendDatabase(content, topic, email);
}

var c = document.getElementById("binary");
var ctx = c.getContext("2d");
c.height=window.innerHeight;
c.width=window.innerWidth;
var binary="01";
binary = binary.split("");
var font_size = 40;
var columns = c.width/font_size;
var drops = [];
for(var x = 0; x < columns; x++){
    drops[x]=100;
}

function draw(){
    ctx.fillStyle = "rgba(0,0,0,0.05)";
    ctx.fillRect(0,0, c.width, c.height);
    ctx.fillStyle = "red";
    ctx.font = font_size + "px arial";
    for(var i=0; i < drops.length; i++){
        var text=binary[Math.floor(Math.random()*binary.length)];
        ctx.fillText(text,i*font_size, drops[i]*font_size);
        if(drops[i]*font_size > c.height && Math.random() > 0.975)
        drops[i]=0;
        drops[i]++;
    }
}
setInterval(draw,120);

async function helpdeskFilter(){
    var filter = document.getElementById("h_select").value;

    var res = await fetch("helpdeskFilter.php", {
        "method": "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        "body": "filter="+filter
    });
    var data = await res.json();
    var obj = document.getElementById("helpdeskTableContainer");
    obj.innerHTML = "";
    var sv = "";
    for (let i = 0; i < data.length; i++) {
        var id = data[i]["id"];
        var user = data[i]["username"];
        var topic = data[i]["topic"];
        var email = data[i]["email"];
        var content = data[i]["content"];
        var resolved = data[i]["resolved"] == 1 ? "Yes": "No";
        var date = data[i]["date"];
        sv = "<tr><td id='h_id'>" + id + "</td><td id='h_user'>" + user + "</td><td id='h_topic'>"
        + topic + "</td><td id='h_email'>" + email + "</td><td id='h_content'>" + content + 
        "</td><td id='h_resolved'>" + resolved + "</td><td id='h_date'>" + date + 
        "</td><td id='h_switchResolve'><button id=sr" + id + 
        " class='emoji' onclick='switchResolve(this.id)'>✅</button></td></tr>" + sv;
    }
    obj.innerHTML = "<table id='helpdeskTable'><tr><th>ID</th><th>USERNAME</th><th>TOPIC</th>" + 
    "<th>EMAIL</th><th>CONTENT</th><th>RESOLVED</th><th>DATE</th><th>SOLVE</th></tr>" + sv + "</table>";
}

function switchResolve(sr_id){
    id = sr_id.substring(2);
    switchHelpdesk(id);
}