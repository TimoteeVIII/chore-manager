<?php
session_start();
if(array_key_exists('id', $_SESSION) == false) // if page is accessed without logging in, returns to index
{ 
    header('location:index.php');
}
// if house is already joined, or already exists (when trying to create), alert user
// echo "<script type='text/javascript'>alert('Hello');</script>";
if(isset($_SESSION['message'])){
 // echo "<script type='text/javascript'>alert('".$_SESSION['message']."');</script>";
  $message = $_SESSION['message'];
 // $scr = "<script type='text/javascript'>alert('$message');</script>";
 // echo $scr;
  echo "<script type=\"text/javascript\">alert(\"$message\");</script>";
  $_SESSION['message'] = null;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>My Houses</title>
      <link rel="stylesheet" href="css/style.css" type="text/css">
      <script src='js/jquery-3.5.1.min.js'></script>
      <script src='js/validHouse.js'></script>
      <script src='js/leaveHouse.js'></script>
      <script src='js/addHouse.js'></script>
  </head>

  <body>
      <div id="contentWrapper">
        <div id="logo">
          <img src="logo.png" alt="Logo">
        </div>
        <br>
        <div class="content">
          <h1>Log Out</h1>
          <form action="logout.php">
            <input type="Submit" value="Log out"/>
          </form>
        </div>
        <br>
        <div class="content">
          <h1>Add a Household</h1>
          <form method="POST" action="addHouse.php" id="form">
            <label for="houseName">Housename:</label>
            <input type="text" name="houseName" placeholder="Enter Housename" id="houseName">
          </form>
        </div>
        <br>
        <div class="content">
          <h1>Join a Household</h1>
          <form method="POST" action="joinHouse.php" id="formJoinHouse">
            <label for="houseNameJoin">Housename:</label>
            <input type="text" name="houseNameJoin" placeholder="Enter Housename" id="houseNameJoin">
          </form>
        </div>
        <br>
        <div class="content">
          <h1>My Households:</h1> 
          <?php
          require "Database.php";
          $db = new Database();
          $db->__construct();
          // get all houses that user is a part of
          $rows = $db->query("SELECT * FROM HOUSEHOLD WHERE INHABITANT=".$_SESSION['id']);   
          // create table of links which lead to that house and chores in those houses 
          $html = "<table id=\"houseTable\"><tbody>";
          while(($row = $rows->fetchArray())){
              $html .= "<tr id=\"house".$row['HouseID']."\"><td><a href='changeDeadline.php?housename=". $row['HouseName'] ."'>".
                        $row['HouseName'] .
                        "</a></td>
                        <td>
                        <form method=\"POST\" onsubmit=\"return false\">
                        <input type=\"submit\" value=\"Leave House\" class=\"leaveHouse\" id=".$row['HouseID'].">
                        </form>
                        </td>
                        </tr>";
          }    
          $html .= "</tbody></table>";
          echo $html;
          ?>
        </div>
    </div>
  </body>

</html>