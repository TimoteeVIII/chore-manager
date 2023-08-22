$(document).ready(function() {
    // listen to login form
    $('#form').on("submit",function(){
       password = $("#password").val(); // store variables using corresponding IDs gathered from form
       email = $("#email").val();
       if(email.trim()==""){ // ensure email field isn't empty, otherwise alert user
        alert("Email field empty");
        return false;
        }
        if(password.trim()==""){ // ensure password field isn't empty, otherwise alert user
            alert("Password field empty");
            return false;
        }        
        return true;
    });
});