<?php

session_start();                    //Start the sessions so we can modify session information

session_destroy();                  //Destroy all session data so the user is no longer logged in

header('Location: ../index.php');   //Return the user to the login page.

?>
