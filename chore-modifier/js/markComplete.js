$(document).ready(function() {
  // listen for when user wants to mark chore complete
   $(document).on('click','.completeButton',function(){
    var x = this.id;
      $.post("toggleComplete.php", {"id":this.id}, function(data){
          console.log(data);
          $("#completeTable > tbody:last-child").append(data); // add row to table of complete chores
          $("#incomplete"+x).remove(); // remove chore from incomplete chore
   })
   return false;
   });

   // listen for when user wants to unmark chore being complete
   $(document).on('click','.incompleteButton',function(){
    var x = this.id.substring(4);
     $.post("toggleComplete.php", {"id":x}, function(data){
         //console.log(data);
         $("#incompleteTable > tbody:last-child").append(data); // add row to table of incomplete chores
         $("#complete"+x).remove(); // remove chore from complete chores table
     });
   return false;
   });
  });