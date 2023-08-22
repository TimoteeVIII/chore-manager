$(document).ready(function() {
    // listen to add house form
    $('#form').on("submit",function(){
       houseName = $("#houseName").val(); // store housename in variable
        if(houseName.trim()==""){ // ensure that the house name isn't comprised of white space, otherwise alert the user
            alert("Housename field empty");
            return false;
        }
        if(houseName.length>50){ // ensure housename entered isn't too large
            alert("House name should be under 50 characters");
            return false;
        }   
        return true;
    });

    // listen to join house form
    $('#formJoinHouse').on("submit",function(){
        houseNameJoin = $("#houseNameJoin").val(); // store housename in variable
         if(houseNameJoin.trim()==""){ // ensure that the house name isn't comprised of white space, otherwise alert the user
             alert("Housename field empty");
             return false;
         }        
         return true;
     });
});