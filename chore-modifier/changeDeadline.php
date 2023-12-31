<?php
require "Database.php";
include "security.php";
$db = new Database();
$houseName = "\"". h($_GET['housename']) . "\""; // make housename usable in SQL statements
$rows = $db->query("SELECT * FROM CHORES WHERE HOUSEHOLDNAME=$houseName"); // get all chores from that household
while($row =$rows->fetchArray()){
    $today = date_create('now'); // get current date and format it
    $today = $today->format('d-m-Y');
    if($row['Frequency'] != "One-Time"){ // can't change deadline of one time chore
    if(strtotime($today)>strtotime($row['DateDue'])){ // if current date is later than due date...
     
      // $today = date_create('now');
     // $today = "\"".$today->format('d-m-Y')."\"";
      
     $today = "\"".$today."\""; // make date SQL usable
      $dateDue = Date('d-m-Y', strtotime('+'.$row['Frequency'])); // make a new due date by adding that chore's frequency to today's date
      $dateDueToInsert = "\"". $dateDue . "\"";
      $status = "\""."Incomplete"."\""; // make status incomplete as chore cannot be completed before being set
      // no need to prepare statement to update chores table; all values generated by program
      $db->exec("UPDATE CHORES SET DATESET=$today, DATEDUE=$dateDueToInsert, COMPLETED=$status WHERE CHOREID=".$row['ChoreID']);

      // create message and email this message to all users in that house saying that the chore has been updated
      $msg = "Chore '".$row['ChoreName']."' deadline has passed, new deadline: ". $dateDueToInsert . " with choree ". $row['PersonToComplete'];
      $msg = wordwrap($msg, 120);
      $rows1 = $db->query("SELECT * FROM HOUSEHOLD WHERE HOUSENAME=".$houseName);
        while($rowx = $rows1->fetchArray()){
            $stmt = $db->querySingle("SELECT * FROM USER WHERE USERID=".$rowx['Inhabitant']);
            mail($stmt['Email'], "Chorinator", $msg);
        }
    }
  }
}
header('location:showChores.php?housename='.$_GET['housename']);
?>