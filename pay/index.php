<?php
include_once 'database.php';
require_once 'class/Login.php';

$password = 'password';
$username = 'username';


if (login::isLoggedIn()) {
    header('Location: main.php');
}
if(isset($_POST[$username], $_POST[$password])) {
    if(login::verify($_POST[$username], $_POST[$password])) {
        login::setLoggedIn($_POST[$username]);
    } else {
        $message = 'Error. Incorrect username or password.';
    }
}
//<li><a href='pages/videos.php' accesskey='0'>Videos</a></li>
echo "<section>
        <div class='Sendtext'>
            <form method='post' action='".$_SERVER['PHP_SELF']."'>
                <b class='username-label'>Username:</b><br />
                <input type='text' name='username' maxlength='75' class='username-login' autocorrect placeholder='Enter your username'/>
                <br/><br/><b class='pass-label'>Password:</b><br />
                <input type='password' name='password' class='password-login' maxlength='75' autocorrect placeholder='Enter your password' />
                <br /><br /><input type='submit' name='submit' value='login' class='button-login'/>";
                if(isset($message)) { 
                    echo '<p style="color:red;">' . $message . '</p>';  
                } 
             echo "</form>
        </div>
    </section>";
?>