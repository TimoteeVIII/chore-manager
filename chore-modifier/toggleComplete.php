<?php
session_start();
require "Database.php";
$choreID = $_POST['id']; // get relevant info from POSTed values and session values
$housename = $_SESSION['housename'];
$housename = "\"". $housename . "\""; // make housename SQL usable
$db = new Database();
$row = $db->querySingle("SELECT * FROM CHORES WHERE CHOREID=$choreID"); // get chore data for desired chore to toggle complete
if(is_array($row)){ // ensure chore data is valid
    if($row['Completed'] == "Incomplete"){ // if the chore is incomplete, update it to be complete, and email all users in the house that it's been completed
        $db->exec("UPDATE CHORES SET COMPLETED=\"Complete\" WHERE CHOREID=$choreID");
        $msg = "Chore '".$row['ChoreName']."' completed by '".$row['PersonToComplete']."'";
        $msg = wordwrap($msg, 120);
       // echo $msg;
        $rows = $db->query("SELECT * FROM HOUSEHOLD WHERE HOUSENAME=".$housename);
        while($rowx = $rows->fetchArray()){
            $stmt = $db->querySingle("SELECT * FROM USER WHERE USERID=".$rowx['Inhabitant']);
            //echo $stmt['Email']. "  ";
            mail($stmt['Email'], "Chorinator", $msg);
        }
        echo "<tr class=\"completeChore\" id=\"complete".$row['ChoreID']."\"><td>".$row['ChoreName']."</td><td>".$row['ChoreDesc']."</td>
        <td>".$row['Frequency']."</td>
        <td>".$row['PersonToComplete']."</td>
        <td>".$row['DateSet']."</td>
        <td>".$row['DateDue']."</td>
        <td>Complete</td>
        <td>
        <form method=\"POST\" onsubmit=\"return false\">
        <input type=\"submit\" value=\"Toggle Completion\" class=\"incompleteButton\" id=comp".$row['ChoreID'].">
        </form>
        </td>
        </tr>"; // row to be added to complete table
    }
    else{ // otherwise set the chore to be incomplete
        $db->exec("UPDATE CHORES SET COMPLETED=\"Incomplete\" WHERE CHOREID=$choreID");
        echo "<tr id=\"incomplete".$row['ChoreID']."\"><td>".$row['ChoreName']."</td><td>".$row['ChoreDesc']."</td>
        <td>".$row['Frequency']."</td>
        <td>".$row['PersonToComplete']."</td>
        <td>".$row['DateSet']."</td>
        <td>".$row['DateDue']."</td>
        <td>Incomplete</td>
        <td>
        <form method=\"POST\" onsubmit=\"return false\">
        <input type=\"submit\" value=\"Toggle Completion\" class=\"completeButton\" id=".$row['ChoreID'].">
        </form>
        </td>
        </tr>"; // row to be added to incomplete table
    }
}
?>