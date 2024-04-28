userSearch("");

async function switchUserRank(){
    await fetch("userUpdateRank.php", {
        "method": "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        "body": "id="+id
      });
      userSearch();
}

async function switchUserSilent(){
    await fetch("userUpdateSilence.php", {
        "method": "POST",
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        "body": "id="+id
      });
      userSearch();
}

async function userSearch(){
    var search = document.getElementById("usersSearchInput").value;

    var res = await fetch("usersFilter.php", {
        "method": "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        "body": "search="+search
    });
    var data = await res.json();
    var obj = document.getElementById("usersTableContainer");
    obj.innerHTML = "";
    var sv = "";
    for (let i = 0; i < data.length; i++) {
        var id = data[i]["id"];
        var user = data[i]["username"];
        var email = data[i]["email"];
        var rank = data[i]["name"];
        var reg = data[i]["reg_time"];
        var silenced = data[i]["silenced"] == 1 ? "Yes": "No";
        sv = "<tr><td id='u_id'>" + id + "</td><td id='u_user'>" + user + "</td><td id='u_email'>"
         + email + "</td><td id='u_rank'>" + rank + "</td><td id='u_regtime'>"
         + reg + "</td><td id='u_silented'>" + silenced + "</td><td id='u_switchRank'><button id=sr"
         + id + " class='emoji' onclick='switchRank(this.id)'>🔼</button></td><td id='u_switchSilent'><button id=ss"
         + id + " class='emoji' onclick='switchSilent(this.id)'>😶</button></td></tr>" + sv;
    }
    obj.innerHTML = "<table id='usersTable'><tr><th>ID</th><th>USERNAME</th><th>EMAIL</th><th>CLASS</th><th>REG. TIME</th>"+
    "<th>SILENCED</th><th>RANK</th><th>SILENT</th></tr>" + sv + "</table>";
}

function switchRank(sr_id){
    id = sr_id.substring(2);
    switchUserRank(id);
}

function switchSilent(ss_id){
    id = ss_id.substring(2);
    switchUserSilent(id);
}