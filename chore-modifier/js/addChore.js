$(document).ready(function() {
    // listen to when the form to add a chore is completed  
    $(document).on("submit","#formAddChore", function(){
        var choreName = $("#choreName").val(); // store chore name as variable by getting the value of the corresponding id
        var choreDesc = $("#choreDesc").val(); // store chore description as variable by getting the value of the corresponding id
        if(choreName.trim() == ""){ // ensure some value has been entered for the chore name (no white space), if not alert the user
            alert("No chore name was entered");
            return false;
        }
        if(choreDesc.trim() == ""){ // ensure some value has been entered for the chore description (no white space), if not alert the user
            alert("No chore description was entered");
            return false;   
        }
        if(choreName.length > 30){ // ensure chore name isn't too long
            alert("Can't enter chore name with over 30 characters");
        }
        if(choreDesc.length > 100){ // ensure chore description isn't too long
        alert("Can't enter chore description with over 100 characters");
        return false;
        }
        // use AJAX to pass control to addChore.php to add the chore to the database - POST the relevant data across
        $.post("addChore.php", {"choreFreq":$("#choreFreq").val(), "houseName":$("#houseName").val(), "choreName":choreName, "choreDesc":choreDesc}, function(data){
            $("#incompleteTable > tbody:last-child").append(data); // add row to incomplete table as new chore is incomplete
            console.log(data);
      });
      return false;
    });
  });