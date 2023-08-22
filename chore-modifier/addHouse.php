<?php
session_start();
require "Database.php";
include "security.php";
$houseName = $_POST['houseName']; 
$houseName = h($houseName); // get housename and replace any special characters using htmlspecialchars function


$db = new Database();
$db->__construct();
// prepare statement to see whether the house already exists
$stmt = $db->prepare("SELECT * FROM household WHERE HouseName = :housename");
$stmt->bindValue(':housename', $houseName, SQLITE3_TEXT);
$rows = $stmt->execute();

while(($row = $rows->fetchArray())){ // check if house exists
    $db->__destruct();
    $_SESSION['message'] = "House already exists"; // set alert message to be shown
    header('location:showHouses.php'); // return to house list
} 
// prepare statement to insert new house into house table
$stmt = $db->prepare("INSERT INTO household VALUES(NULL, :seshID, :housename)");
$stmt->bindValue(':seshID', $_SESSION['id'], SQLITE3_TEXT);
$stmt->bindValue(':housename', $houseName, SQLITE3_TEXT);
$stmt->execute();

$db->__destruct();
header('location:showHouses.php'); // return to houses
?>