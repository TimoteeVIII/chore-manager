Name of database: chores.db
Name of schema: schema.sql

Application's Main Features:

    - User can register and log in to website

    - Registration - user enters their email, username, password and reenters their password
                   - if all fields are full, neither the username or email are used, the password
                     is 8 or more characters, and the password matches the reentered password, the
                     user is taken to the list of houses that they belong to (initially none)
                   - if any of the above fail, the user is alerted about what went wrong using 
                     JavaScript and JQuery, and then expected to try again
    - Login - the user enters their details and if the password matches the expected password (done
              using password_hash and password_verify), then the user is taken to their list of houses
            - If any of the fields are left empty, or the user enters incorrect details, using JavaScript,
              the user is notified with an alert


    - User can create households

    - Creating Households - user can create a household by entering a name of what they want to call
                            their house - added to table of houses on the same page as creating a house
                          - user can click on houses in the list of houses they're a part of to be
                            taken to the list of chores associated with that chore
                          - if they enter a house name that already exists they are alerted using 
                            JavaScript
                          - if the user leaves the field empty, they're alerted using a JavaScript
                            alert
    
    
    - User can join households

    - Join Households - user can join a household that exists
                      - if they try to join a house they're already a part of a JavaScript alert
                        pops up
                      - if an empty field is provided, a JavaScript alert pops up
    
    - Chores
      - If empty field is provided when adding a chore, JS alert pops up
      - If user enters something for each field, chore is added to database and the chore is added
        to a table of incomplete chores with all details e.g. chore name, description, frequency etc.
      - Chores are added to the table using AJAX
      - Can only add chore to a house the user's a part of
      - Chores can be marked complete by pressing a button - this button uses AJAX to update the table
        of incomplete chores to remove the completed chore, and add this chore to a table of complete chores
        (applies to unmarking chores as complete too, just the opposite way around)
      - Chores are allocated fairly by getting all inhabitants of that house, choosing a random one,
        then picking another person in that house who hasn't already been chosen (done simply by pressing
        a button)


    - For all user inputs, the user can click on the label as well as the box (for accessibility
      purposes)
    - Every section is clearly divided using CSS to outline boxes of separate content - makes usability
      of the application easier
    - For all user inputs, htmlspecialchars are used where appropriate to ensure that XSS attacks
      are prevented, as well as using prepared statements to ensure SQL Injection attacks are
      prevented
    - Users can't change the URL to check the chores of a house they're not a part of as it's checked
      to make sure that when a URL for showChores is changed, that the user is actually a part of that house

Additional Features:

    - A user can join and add multiple households - useful if someone frequently visits more than just
      their own house
    - Users can leave households they are no longer a part of - done using AJAX
    - Every user of a household, upon completion of a chore, is emailed that the chore is complete
    - If a chore deadline passes, the new deadline is automatically updated to a new date (calculated
      by adding the frequency of the chore to the current date (today)), and all user's are emailed
      saying that the chore's been updated
    - Users can delete chores that have been completed (can't delete incomplete chores) - done using AJAX