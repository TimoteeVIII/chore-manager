<?php
session_start();
require "Database.php";
include "security.php";
$db = new Database();
$status = "\""."Incomplete"."\""; // As the chore's being added, it's assumed to be incomplete
$freq = $_POST['choreFreq'];
$freqToInsert = "\"". $freq . "\""; // make frequency insertable
$today = date_create('now'); // get today's date and format it
$today1 = $today->format('d-m-Y');
$today = "\"".$today->format('d-m-Y')."\"";
if($freq != "One-Time"){ // if the frequency is one time, we want the date due to not exist
    
    $dateDue = Date('d-m-Y', strtotime('+'.$freq)); // add the frequency to the current date if the frequency isn't one time
    $dateDueToInsert = "\"". $dateDue . "\"";
}
else{
    $dateDueToInsert = "\""."-"."\"";
}
$name = "\""."-"."\""; // since the chores haven't been allocated, the name of the choree isn't known
// prepare the statement, then execute the insert statement to create a new chore
$stmt = $db->prepare("INSERT INTO chores VALUES(NULL, :houseName, :choreName, :choreDesc, $freqToInsert, $name, $today, $dateDueToInsert, $status)");
$stmt->bindValue(':houseName', h($_POST['houseName']), SQLITE3_TEXT);
$stmt->bindValue(':choreName', h($_POST['choreName']), SQLITE3_TEXT);
$stmt->bindValue(':choreDesc', h($_POST['choreDesc']), SQLITE3_TEXT);
$stmt->execute();
$id = $db->querySingle("SELECT * FROM chores ORDER BY ChoreID DESC LIMIT 1");
$id = $id['ChoreID'];
echo "<tr id=\"incomplete".$id."\"><td>".h($_POST['choreName'])."</td><td>".h($_POST['choreDesc'])."</td>
<td>".$freq."</td>
<td>-</td>
<td>$today1</td>
<td>$dateDue</td>
<td>Incomplete</td>
<td>
<form method=\"POST\" onsubmit=\"return false\">
<input type=\"submit\" value=\"Toggle Completion\" class=\"completeButton\" id=".$id.">
</form>
</td>
</tr>"; // return row that is going to be added to incomplete house list
// header('location:showChores.php?housename='.$_POST['houseName']); // redirect to chore list
?>