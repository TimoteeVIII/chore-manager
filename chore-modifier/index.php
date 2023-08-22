<?php
// ensure upon reaching the index page, any potential previous session is destroyed
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    
    <body>
        <div id="contentWrapper">      
            <div id="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <br>
            <div class="content">
                <h1>Register</h1>
                <form action="register.php">
                    <input type="Submit" value="Register"/>
                </form>
            </div>
            <br>
            <div class="content">
                <h1>Login</h1>
                <form action="login.php">
                    <input type="Submit" value="Login"/>
                </form>
            </div>
        </div>
    </body>
</html>