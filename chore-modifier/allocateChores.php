<?php
session_start();
require "Database.php";
include "security.php";
$db = new Database();
$housename = "\"" .  h($_POST['houseName']) . "\""; // make housename usable in query
$userID = array(); // create empty array - to be used to contain all user IDs belonging to a particular house
$counter=0; // array counter
$rows = $db->query("SELECT INHABITANT FROM HOUSEHOLD WHERE HOUSENAME=$housename"); // get all user ID's associated with the house
$numOfChores = $db->query("SELECT COUNT(*) as count FROM CHORES WHERE HOUSEHOLDNAME=$housename");
$row = $numOfChores->fetchArray();
$numOfChores = $row['count'];
$choreID = $db->query("SELECT CHOREID FROM CHORES WHERE HOUSEHOLDNAME=$housename");
while($row = $rows->fetchArray()){ // loop through all inhabitants of the house
    $userID[$counter] = $row['Inhabitant']; // get current inhabitant and put their id at position $counter in the userID array
    $counter++; // increment counter
}

$tempArr = array(); // create temp array
$randNum = 0; // initialise a random number
$UID = 0; // initialise a UserID (0 as it isn't a valid ID)
  while($rowx = $choreID->fetchArray()){ // loop through each chore associated with a household
    do{ // loop until a user id which isn't in the temporary array is found
      $randNum = rand(0, count($userID) - 1); 
      $UID = $userID[$randNum];
    }while(in_array($UID, $tempArr));
    array_push($tempArr, $UID); // add the current user id to the temp array
    if(count($tempArr) == count($userID)){ // if the temp array contains all elements of userID array, reset the temp array to the empty array
      $tempArr = array();
    }
    $row = $db->querySingle("SELECT USERNAME FROM USER WHERE USERID=$UID"); // get the username from the selected user ID
    $currChoreID = "\"".$rowx['ChoreID']."\"";
    $currUsername = "\"".$row['Username']."\"";
   $db->exec("UPDATE CHORES SET PERSONTOCOMPLETE=$currUsername WHERE CHOREID=$currChoreID"); // update the chore with the choree
  }
  header('location:showChores.php?housename='.$_POST['houseName']); // return to the chore list of that house
?>