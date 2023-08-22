<?php
session_start();
require "Database.php";
$id = $_POST['id'];
$db = new Database();
$db->exec("DELETE FROM HOUSEHOLD WHERE HOUSEID=$id");
?>