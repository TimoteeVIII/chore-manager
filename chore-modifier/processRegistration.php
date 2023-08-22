<?php
    session_start();
    require "Database.php"; // need the database
    include "security.php";
    $email = h($_POST['email']); // get email
    $uname = h($_POST['uname']); // get username
    $password = password_hash(h($_POST['password']), PASSWORD_DEFAULT); // get password
   // $salt = date("H:i:s"); // create salt - the current time
    //$hashPassword = sha1($salt . $password); // hash password with sha1
    $db = new Database(); 
    $db->__construct(); // construct db
    $stmt = $db->prepare("SELECT * FROM user WHERE Email = :email"); // check if email in use
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $data = $stmt->execute()->fetchArray();
    $stmt = $db->prepare("SELECT * FROM user WHERE Username = :uname"); // check if email in use
    $stmt->bindValue(':uname', $uname, SQLITE3_TEXT);
    $data2 = $stmt->execute()->fetchArray();
    if(!is_array($data2) && !is_array($data)){ // if username not used, insert it and fields aren't empty
        $stmt = $db->prepare("INSERT INTO user VALUES(NULL, :uname, :email, :hashPass)");
        $stmt->bindValue('uname', $uname, SQLITE3_TEXT);
        $stmt->bindValue('email', $email, SQLITE3_TEXT);
        $stmt->bindValue('hashPass', $password, SQLITE3_TEXT);
       // $stmt->bindValue('salt', $salt, SQLITE3_TEXT);
        $stmt->execute();
        $stmt = $db->prepare("SELECT * FROM user WHERE Username = :uname"); // get user's id
        $stmt->bindValue(':uname', $uname, SQLITE3_TEXT);
        $data2 = $stmt->execute()->fetchArray();
        $_SESSION['id'] = $data2['UserID'];
        $db->__destruct();
        header('location:showHouses.php');
    }
    else{
        $_SESSION['message'] = "Username/email already exists"; // if email and password already in use, alert user
        header('location:register.php');
        $db->__destruct(); // destruct db
    }
    
    
    
?>