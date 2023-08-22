<?php
// destroy session and return to index page
session_start();
session_unset();
session_destroy();
header('Location: index.php');
?>