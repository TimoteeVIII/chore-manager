<?php
session_start();
require "Database.php";
$db = new Database();
$rows = $db->query("DELETE FROM CHORES WHERE COMPLETED=\"Complete\" AND HOUSEHOLDNAME=\"".$_SESSION['housename']."\"");
?>