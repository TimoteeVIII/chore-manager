<?php
session_start();
include "security.php";
require "Database.php";
$db = new Database();

$email = $_POST["email"];
$email = h($email); // convert special characters using html special chars

$password = $_POST["password"];
$password = h($password); // convert special characters using html special chars
$db->__construct();
// prepare statement to get user details
$stmt = $db->prepare("SELECT * FROM user WHERE Email = :email");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$data = $stmt->execute()->fetchArray();
// if the email entered isn't registered, return to login page
if(!is_array($data)){
    $_SESSION['message'] = "Incorrect details entered";
    header('location:login.php');
}
//if(array_key_exists('Salt', $data) == false)
//{
//   header('location:login.php');
//}
// $salt = $data['Salt']; // get salt and hashed password from database
$pass = $data['Passcode'];

// $hash = sha1($salt.$password); // hash the entered password with the salt of that user

// if the above calculated hash matches the hash stored in the database, set the sessionID to the user id and
// go the list of houses that user belongs to, otherwise alert the user and return to the login page
// sha1($salt . $password) == $pass
if(password_verify($password,$pass)) 
{
    $_SESSION['id'] = $data['UserID'];
    header('location:showHouses.php');
}
else
{
    $_SESSION['message'] = "Incorrect details entered";
    header('location:login.php');
}
?>