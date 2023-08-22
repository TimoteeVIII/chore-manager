$(document).ready(function() {
    // listen for when user wants to mark chore complete
     $(document).on('click','.leaveHouse',function(){
      var x = this.id;
        $.post("leaveHouse.php", {"id":this.id}, function(data){
            //console.log(data);
            $("#house"+x).remove(); // remove chore from incomplete chore
     })
     return false;
     });
    });