$(document).ready(function() {
    // listen to when a button with the class completeButton is clicked
    $("#deleteChores").on("click", function(){
      // when such button is complete, pass control to toggleComplete.php, passing the id of the button as a parameter
      $.post("deleteChore.php", function(data){
        $(".completeChore").remove();  // remove all chores with a class being that of a complete chore
        //return false;
       // console.log(data);
     });
     return false;
   });
 });