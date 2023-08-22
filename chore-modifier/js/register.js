$(document).ready(function() {
    // listen to register form
    $(document).on("submit","#form",function(){
       username = $("#uname").val(); // store variables containing data passed via form
       password = $("#password").val();
       passwordAgain = $("#passwordAgain").val();
       email = $("#email").val();
        if(username.trim()==""){ // ensure username field doesn't contain whitespace, otherwise alert user
            alert("Username field empty");
            return false;
        }
        if(password.trim()==""){ // ensure password field doesn't contain whitespace, otherwise alert user
            alert("Password field empty");
            return false;
        }
        if(email.trim()==""){ // ensure email field doesn't contain whitespace, otherwise alert user
            alert("Email field empty");
            return false;
        }
        if(password.trim() != passwordAgain.trim()){ // ensure password entered, and re-entered password match
            alert("Password entered doesn't match re-entered password");
            return false;
        }
        if(username.length > 30){ // make sure username isn't too large
            alert("Username must be under 30 characters long");
            return false;
        }
        if(email.length > 100){ // make sure email isn't too large
        alert("Email must be under 100 characters long");
        return false;
        }
        if(password.length < 8){ // make sure password is large enough
        alert("Password must be 8 or more characters long");
        return false;
        }
    });
});