<?php
if(!isset($_SESSION['userEmail'])) { // Checks if $_SESSION['userEmail'] is not set
    header("Location: ../../index.php"); // Redirects the user to the login page
}
?>
