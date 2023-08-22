<?php
session_start();
if(isset($_SESSION['message'])){ // output alert if user has entered incorrect details
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('$message');</script>";
    $_SESSION['message'] = null;
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Login</title>
            <link rel="stylesheet" href="css/style.css" type="text/css">
            <script src='js/jquery-3.5.1.min.js'></script>
            <script src='js/login.js'></script>
        </head>

        <body>
            <div id="contentWrapper">
                <div id="logo">
                    <img src="logo.png" alt="Logo">
                </div>
                <br>
                <div class="content">
                    <h1>Login</h1>
                    <form method="POST" action="authenticate.php" id="form">
                        <label for="email">Email:</label>
                        <input type="text" name="email" placeholder="Enter Email" id="email">
                        <br>
                        <br>
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Enter password" id="password">
                        <br>
                        <br>
                        <input type="submit" value="Submit"/>
                    </form>
                </div>
            </div>
        </body>
    </html>