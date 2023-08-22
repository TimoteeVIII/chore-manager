<?php
session_start();
require "Database.php";
include "security.php";
if(!isset($_SESSION['id'])){ // make sure user's logged in
    header('location:index.php');
}
/*if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('$message');</script>";
    $_SESSION['message'] = null;
  } */
$db = new Database();
$isInHouse = false;
$stmt = $db->query("SELECT * FROM HOUSEHOLD WHERE INHABITANT=".$_SESSION['id']);
while($row=$stmt->fetchArray()){ // make sure user is seeing chores that belong to them
    if($row['HouseName'] == h($_GET['housename'])){ // if user enters house they aren't in into urlm they're redirected to their house list
        $isInHouse = true;
    }
}
if($isInHouse == false){
    header('location:showHouses.php');
}
$_SESSION['housename'] = h($_GET['housename']);
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Chores</title>
            <link rel="stylesheet" href="css/style.css" type="text/css">
            <script src='js/jquery-3.5.1.min.js'></script>
            <script src='js/markComplete.js'></script>
            <script src='js/addChore.js'></script>
            <script src='js/deleteItem.js'></script>
        </head>

        <body>
            <div id="contentWrapper">
            <div id="logo">
            <img src="logo.png" alt="Logo">
            </div>
            <br>
            <div class="content">
            <h1>Return to List of Houses</h1>
            <form action="showHouses.php">
            <input type="submit" value="Return to Houses"/>
            </form>
            </div>
            <br>
            <div class="content">
            <h1>Add Chore</h1>
            <!-- if it doesn't work, use action=addChore.php and uncomment last line in addChore.php -->
            <form method="POST" id="formAddChore">
                <input type="hidden" name="houseName" value="<?php echo h($_GET['housename'])?>" id="houseName">
                <label for="choreName">Chore Name</label>
                <input type="text" name="choreName" placeholder="Enter Chore Name" id="choreName">
                <br>
                <br>
                <label for="choreDesc">Chore Description</label>
                <textarea cols="25" rows="2" name="choreDesc" id="choreDesc"></textarea>         
                <br>
                <br>
                <label for="choreFreq">Chore Frequency</label>
                <!-- <input type="text" name="choreFreq" placeholder="Enter Chore Frequency" id="choreFreq"> -->
                <select name="choreFreq" id="choreFreq">
                    <option value="1 day">1 Day</option>
                    <option value="2 day">2 Days</option>
                    <option value="1 week">1 Week</option>
                    <option value="2 week">2 Weeks</option>
                    <option value="1 month">1 Month</option>
                    <option value="One-Time">One-Time</option>
                </select>
                <br>
                <br>
                <input type="submit" value="Submit"/>
            </form>
            </div>
            <br>
            <div class="content">
            <h1>Allocate Chores</h1>
            <form method="POST" action="allocateChores.php">
            <input type="hidden" name="houseName" value="<?php echo $_GET['housename']?>" id="houseName">
            <input type="submit" value="Allocate Chores"/>
            </form>  
            </div>
            <br>
            




            <div class="content">
            <h1>Incomplete Chores</h1>
            <?php
            // require "Database.php";
           // $db = new Database();
            $incomplete = "\""."Incomplete"."\""; // to use in query to find incomplete chores
            $stmt = $db->prepare("SELECT * FROM CHORES WHERE HOUSEHOLDNAME= :housename AND COMPLETED=$incomplete");
            $stmt->bindValue(":housename", h($_GET['housename']), SQLITE3_TEXT);
            $data = $stmt->execute();
            // make table with all chore details for incomplete chores
            $html = "<table id=\"incompleteTable\"><tbody><tr><th>Chore Name</th><th>Chore Description</th><th>Frequency</th><th>Choree</th><th>Date Set</th><th>Date Due</th><th>Status</th></tr>";
            while(($row = $data->fetchArray())){
      //  $html.= "<tr><td>".$row['HouseName']."</td></tr>";
                $html .= "<tr id=\"incomplete".$row['ChoreID']."\"><td>".$row['ChoreName']."</td><td>".$row['ChoreDesc']."</td>
                <td>".$row['Frequency']."</td>
                <td>".$row['PersonToComplete']."</td>
                <td>".$row['DateSet']."</td>
                <td>".$row['DateDue']."</td>
                <td>".$row['Completed']."</td>
                <td>
                <form method=\"POST\" onsubmit=\"return false\">
                <input type=\"submit\" value=\"Toggle Completion\" class=\"completeButton\" id=".$row['ChoreID'].">
                </form>
                </td>
                </tr>";
            }    
            $html .= "</tbody></table>";
            echo $html;

            // <td><a href='markCompletion.php?id=". 1 ."&&choreID=".$row['ChoreID']."&&houseName=".h($_GET['housename'])."'>Mark Complete</a></td>
            ?>
            </div>
            <br>





            <div class="content">
            <h1>Complete Chores</h1>
            <?php
            // require "Database.php";
           // $db = new Database();
            $stmt = $db->prepare("SELECT * FROM CHORES WHERE HOUSEHOLDNAME= :housename AND COMPLETED=\"Complete\""); // get all chores for this house
            $stmt->bindValue(":housename", h($_GET['housename']), SQLITE3_TEXT);
            $data = $stmt->execute();
            // create table of all chores
            $html = "<table id=\"completeTable\"><tbody><tr><th>Chore Name</th><th>Chore Description</th><th>Frequency</th><th>Choree</th><th>Date Set</th><th>Date Due</th><th>Status</th></tr>";
            while(($row = $data->fetchArray())){
      //  $html.= "<tr><td>".$row['HouseName']."</td></tr>";
                $html .= "<tr class=\"completeChore\" id=complete".$row['ChoreID']."><td>".$row['ChoreName']."</td><td>".$row['ChoreDesc']."</td>
                <td>".$row['Frequency']."</td>
                <td>".$row['PersonToComplete']."</td>
                <td>".$row['DateSet']."</td>
                <td>".$row['DateDue']."</td>
                <td>".$row['Completed']."</td>
                <td>
                <form method=\"POST\" onsubmit=\"return false\">
                <input type=\"submit\" value=\"Toggle Completion\" class=\"incompleteButton\" id=comp".$row['ChoreID'].">
                </form>
                </td>
                </tr>";
            }    
            $html .= "</tbody></table>";
            echo $html;
            
         //   <td><a href='markCompletion.php?id=". 1 ."&&choreID=".$row['ChoreID']."&&houseName=".h($_GET['housename'])."'>Mark Complete</a></td>
         //   <td><a href='markCompletion.php?id=". 0 ."&&choreID=".$row['ChoreID']."&&houseName=".h($_GET['housename'])."'>Mark Incomplete</a></td></tr>
            ?>
            </div>
            <br>




            <div class="content">
                <h1>Delete All Completed Chores</h1>
                <form method="POST" id="deleteChoreForm" onsubmit="return false">
                    <input type="button" value="Delete All Chores" id="deleteChores">
                </form>
            </div>
            </div>
        </body>
    </html>