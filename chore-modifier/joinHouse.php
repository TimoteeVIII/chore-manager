<?php
session_start();
include "security.php";
$housename = $_POST['houseNameJoin'];
$housename = h($housename);
require "Database.php";
$db = new Database();
$db->__construct();
// get houses current user is part of
$rows = $db->query("SELECT * FROM HOUSEHOLD WHERE INHABITANT =".$_SESSION['id']);
while(($row = $rows->fetchArray())){
    if($row['HouseName'] == $housename){
        $db->__destruct();
        $_SESSION['message'] = "Already in house";
        header('location:showHouses.php');
    }
} 
// $housename = "\"".$housename."\"";
// $rows = $db->querySingle("SELECT * FROM HOUSEHOLD WHERE HouseName = $housename");

$stmt = $db->prepare("SELECT * FROM HOUSEHOLD WHERE HouseName = :housename");
$stmt->bindValue(':housename', $housename, SQLITE3_TEXT);
$rows = array();
$rows = $stmt->execute()->fetchArray();
if(!is_array($rows)){
    $_SESSION['message'] = "House doesn't exist";   
    header('location:showHouses.php');
}

if(array_key_exists('HouseName', $rows)){
    // $db->exec("INSERT INTO HOUSEHOLD VALUES(NULL,".$_SESSION['id'].", $housename)");
    $stmt = $db->prepare("INSERT INTO HOUSEHOLD VALUES(NULL, :seshID, :housename)");
    $stmt->bindValue(':seshID', $_SESSION['id'], SQLITE3_TEXT);
    $stmt->bindValue(':housename', $housename, SQLITE3_TEXT);
    $stmt->execute();
    $db->__destruct();
    header('location:showHouses.php');
}
else{
    $db->__destruct();
    $_SESSION['message'] = "House doesn't exist";
    header('location:showHouses.php');
}
?>