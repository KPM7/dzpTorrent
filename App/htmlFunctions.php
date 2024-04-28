<?php
class Html
{
    static function header()
    {
        echo
        "<div class='header'>
            <img class='p_logo' src='imgs/headerlogo.png'>
            <div class='header-buttons'>
                <a href='index.php'>Home</a>
                <a href='torrents.php'>Torrents</a>
                <a href='upload.php'>Upload</a>
                <a href='helpdesk.php'>Helpdesk</a>";

                if ($_SESSION['class_id'] == 3) {
                    echo "<a href='adminInterface.php'>Admin Interface</a>";
                }

                echo "<div class='header-button-right'>";

                    if ((isset($_SESSION['username']) && $_SESSION['username'] == true)) {
                        echo '<a href="profile.php" id="session_user">' . "User: " . $_SESSION['username'] . '</a>';
                        echo '<a href="logout.php">' . 'Logout' . '</a>';
                    } else {
                        echo '<a href="terminal.php">' . 'Login' . '</a>';
                    }

        echo "</div>
        </div>
        <div class='header-marqueet'>
            <div class='marqueet-text'>
                <p>STATUS: <span class='header-span'>ONLINE</span></p>
                <img class='sep' src='imgs/seperator.png'>
                <p>WELCOME to the SITE.</p>
                <img class='sep' src='imgs/seperator.png'>
                <p> Click on <span class='header-span'>Transmit Message</span> to open the chat.</p>
                <img class='sep' src='imgs/seperator.png'>
                <p><p>If you need any assistance head to the <span class='header-span'>HELPDESK</span></p></p>
                <img class='sep' src='imgs/seperator.png'>
                <p>24/7 customer service!</p>
                <img class='sep' src='imgs/seperator.png'>
                <p><span class='header-span'>Find out more at the FAQ</span></p>
                <img class='sep' src='imgs/seperator.png'>
                <p>Click on your <span class='header-span'>username</span> to view your profile!</p>
            </div>
            <div class='chatbutton'>
                <img class='messageimage' onclick='chatButton()' src='imgs/transmitmessage.png'>
            </div>
        </div>
    </div>
    <div class='chatwindow' id='chatwindow'>
        <h2>Chat</h2>
        <div id='buttons'>
            <input type='button' id='white' value='White' onclick=\"chatBackColor('white')\">
            <input type='button' id='gray' value='Gray' onclick=\"chatBackColor('gray')\">
            <input type='button' id='black' value='Black' onclick=\"chatBackColor('black')\">
        </div>
        <br clear='all'>
        <div id='chat'>
            <div id='messages' class='black'></div>
            <div id='chatInputDiv'>";
        if (isset($_SESSION['username'])) {
            echo "<input type='hidden' id='sessionUsername' value='" . $_SESSION['username'] . "'>";
        }
        echo "<input type='text' placeholder='Enter Message' id='chatInput'>
                <input type='button' value='Send' id='chatSubmit' onclick='sendMessage()'>
            </div>
        </div>
    </div>
    <script src='js/chat.js'></script>";
    }

    static function registerForm()
    {
        echo "<div class='error'>
        </div>
        <form method='post'>
            <div id='RusernameDiv' class='registerlogin'>
                <label>Username: </label>
                <input autocapitalize='off' spellcheck='false' type='text' name='username' id='username' minlength='3'
                    maxlength='20'>
            </div>
            <div id='RemailDiv' class='registerlogin'>
                <label>Email: </label>
                <input autocapitalize='off' spellcheck='false' type='email' name='email' id='email' maxlength='50'>
            </div>
            <div id='RpwdDiv' class='registerlogin'>
                <label>Password: </label>
                <input autocapitalize='off' spellcheck='false' type='password' name='pwd' id='pwd' maxlength='30'>
            </div>
            <div id='already' class='registerlogin'>
                <p class='already'>Already have an account? <a href='terminal.php'>Log in</a></p>
            </div>
            <div id='Rsubmit' class='registerlogin'>
                <button class='submitbutton' type='submit'>ENTER</button>
            </div>
        </form>";
    }

    static function loginForm()
    {
        echo "<form method='post'>
            <div id='LemailDiv' class='registerlogin'>
                <label>Email: </label>
                <input autocapitalize='off' spellcheck='false' type='email' name='email' id='email'>
            </div>
            <div id='LpwdDiv' class='registerlogin'>
                <label>Password: </label>
                <input autocapitalize='off' spellcheck='false' type='password' name='pwd' id='pwd'>
            </div>
            <div id='yet' class='registerlogin'>
                <p>You don't have an account yet? <a href='terminal.php?mode=reg'>Register</a></p>
            </div>
            <div id='Lsubmit' class='registerlogin'>
                <button type='submit' id='home_gomb' class='submitbutton'>ENTER</button>
            </div>
        </form>";
    }

    static function welcomeContent()
    {
        echo "<h1>open the gates</h1>
        <div class='content'>
            <p>Welcome to dzpTorrent</p><br>
            <p>
                dzpTorrent is a private torrent site which means it requires a registration before usage. This site does not host any torrent, only the .torrent file containing the metadata pointing towards the actual data. 
                Users who registered are able to upload and download files.
            </p><br>
            <p>Creators: Nagy Zoltan, Kaliczka Patrik, Karaba David</p>
        </div>
        <a href='terminal.php'>
            <h2>to the wired.</h2>
        </a>";
    }

    static function footer()
    {
        echo "
        <div class='footer'>
            <div class='footer-content'>
                <img class='rat' src='imgs/rat.gif'>
                <img class='modve' src='imgs/modve.gif'>
                <p>Fun Fact: This is the bottom of this site</p>
            </div>
        </div>";
    }
}
