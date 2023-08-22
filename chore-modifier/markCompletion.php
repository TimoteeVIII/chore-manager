<?php
/*//echo $_GET['id'];
//echo $_GET['choreID'];

require "Database.php";
include "security.php";
$db = new Database();
$isComplete = "\""."Complete"."\"";
$isNotComplete = "\""."Incomplete"."\"";
$choreID = $_GET['choreID'];
if($_GET['id'] == 1){
    $db->exec("UPDATE CHORES SET COMPLETED=$isComplete WHERE CHOREID=$choreID");
}
else{
    $db->exec("UPDATE CHORES SET COMPLETED=$isNotComplete WHERE CHOREID=$choreID");
}
// echo $_GET['houseName'];
 header('location:showChores.php?housename='.$_GET['houseName']); */
?>