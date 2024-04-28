<?php
class Admin
{
    static function base()
    {
        echo "<div id='baseDiv'><h1>Admin Interface</h1><p id='text'>Select from the navigation bar what you want to administer</p></div>";
    }

    static function torrents()
    {
        echo "torrents";
    }

    static function users()
    {
        echo "<div id='usersSearchContainer'>
            <input type='text' name='' id='usersSearchInput'>
            <input type='button' value='Search' id='userSearchButton' onclick='userSearch()'>
        </div>
        <div id='usersList'>
            <div id='usersTableContainer'>
            </div>
        </div>
        <script src='js/users.js'></script>";
    }

    static function helpdesk(){
        echo "<div id='helpdeskSelect'>
            <select name='h_select' id='h_select' onchange='helpdeskFilter()'>
                <option value='all'>All</option>
                <option value='not_resolved'>Not resolved</option>
            </select>
        </div>
        <div id='helpdeskList'>
            <div id='helpdeskTableContainer'>
            </div>
        </div>
        <script src='js/helpdesk.js'></script>";
    }

    static function chat()
    {
        echo "chat";
    }

    static function news()
    {
        echo "<div class='news'>
                <h1>Edit News</h1><div id='newsTableContainer'>";
                if(isset($_GET["edit"]) && $_GET["edit"] != ""){
                    
                    Admin::editNews();
                }else if(isset($_GET["update"]) && $_GET["update"] != ""){
                    $id = (int)$_GET["update"];
                    include "dbConnect.php";
                    
                    $result = $connect->query("SELECT actual FROM news WHERE id = $id");

                    if ($result) {
                        $row = $result->fetch_assoc();
                        
                        $actual_value = $row['actual'];
                        if ($actual_value == 1) {
                            $sql_switch_actual = "UPDATE news SET actual='0' WHERE id = $id";
                        } else {
                            $sql_switch_actual = "UPDATE news SET actual='1' WHERE id = $id";
                        }
                        
                        $connect->query($sql_switch_actual);
                    } else {
                        echo "Hiba a lekérdezésben: " . $connect->error . "<br><a href='adminInterface.php?mod=news&update='>vissza</a>";
                    }

                    Admin::listNews();
                }else{
                    Admin::listNews();
                }
        echo "</div></div>
            <div class='news'>
                <h1>Add News</h1>
                <label class='newsLabel'>Title:</label><br>
                <input type='text' maxlength='100' id='titleInput'><br>
                <label class='newsLabel'>Content:</label><br>
                <textarea cols='30' rows='10' placeholder='Write news here' id='contentInput'></textarea><br>
                <input type='button' value='Send news' id='newsSubmit' onclick='sendNews()'>
            </div>
            <script src='js/news.js'></script>";
    }

    static function listNews()
    {
        include "dbConnect.php";

        $sql = "SELECT n.id, n.date, n.title, n.content, n.actual, u.username FROM news AS n INNER JOIN users AS u ON u.id = n.user_id;";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            echo "<table id='newsList'>
                    <tr>
                        <th>DATE</th>
                        <th>TITLE</th>
                        <th>CONTENT</th>
                        <th>VISIBLE</th>
                        <th>UPLOADER</th>
                        <th>EDIT</th>
                        <th>VIS.</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["date"] . "</td>
                        <td id='n_title'>" . $row["title"] . "</td>
                        <td id='n_content'>" . $row["content"] . "</td>
                        <td>";
                        if($row["actual"] == 1){
                            echo "Yes";
                        } else{
                            echo "No";
                        }
                        echo "</td>
                        <td id='n_uploader'>" . $row["username"] . "</td>
                        <td><a href='adminInterface.php?mod=news&edit=" . $row["id"] ."'>🛠</a></td>
                        <td><a href='adminInterface.php?mod=news&update=" . $row["id"] ."'>👁</a></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }
        $connect->close();
    }

    static function editNews(){
        include "dbConnect.php";
        $id = (int)$_GET["edit"];
        $sql = "SELECT title, content FROM news WHERE id = ".$id.";";
        $result = $connect->query($sql);

        $row = $result->fetch_assoc();
        $title_value = $row['title'];
        $content_value = $row['content'];

        echo "<label class='newsLabel'>Title:</label><br>
            <input type='text' maxlength='100' id='newsTitleChange'><br>
            <label class='newsLabel'>Content:</label><br>
            <textarea cols='30' rows='10' id='newsContentChange'></textarea><br>
            <script>
            document.getElementById('newsTitleChange').value = '".$title_value."';
            document.getElementById('newsContentChange').value = '".$content_value."';
            </script>
            <input type='button' value='Update' id='newsUpdate' onclick='updateNews(".$id.")'>
            <a id='newsBack' href='adminInterface.php?mod=news&edit='>Back</a>
            <script src='js/news.js'></script>";
    }
}


?>