<?php
 session_start();
 if(isset($_SESSION['message'])){ // alert user that details already in use
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('$message');</script>";
    $_SESSION['message'] = null;
 }
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script src='js/jquery-3.5.1.min.js'></script>
        <script src='js/register.js'></script>
    </head>
    
    
    <body>
        <div id="contentWrapper">       
            <div id="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <br>
            <div class="content">
                <h1>Register</h1>
                <form method="POST" action="processRegistration.php" id="form">
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="Enter Email" id="email">
                    <br>
                    <br>
                    <label for="uname">Username:</label>
                    <input type="text" name="uname" placeholder="Enter Username" id="uname">
                    <br>
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Enter Password" id="password">
                    <br>
                    <br>
                    <label for="passwordAgain">Enter Password Again:</label>
                    <input type="password" name="passwordAgain" placeholder="Enter Password" id="passwordAgain">
                    <br>
                    <br>
                <input type="submit" value="Submit"/>
                </form>
            </div>
        </div>
    </body>
</html>