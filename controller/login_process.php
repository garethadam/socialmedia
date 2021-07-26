<?php
session_start(); // Starts session
require('../model/details.php'); // Require the database connection Info
require('../model/function_users.php'); //Require the php sql functions file

$email = $_POST['email']; // Stores $_POST['email'] in variable $email
$password = $_POST['password']; // Stores $_POST['password'] in variable $password

$result = check_login($email); // Calls check_login function and returns $result

if(md5($password) === $result[0]) // Checks if md5 encryption of $password matches the $result[0] value
{
  $_SESSION['userEmail'] = $email; // Sets $_SESSION['userEmail'] to $email
  $_SESSION['userID'] = $result[1]; // Sets $_SESSION['userID'] to $result[1]
  $_SESSION['userPhoto'] = $result[2]; // Sets $_SESSION['userPhoto'] to $result[2]
  $_SESSION['success'] = 'Welcome Back!'; // Sets $_SESSION['success'] to string "Welcome Back!"
  header('Location: ../view/html/home.php'); // Redirects the user to users home page

} else { // If the md5 encryption of $password doesn't match the $result[0] value
  $_SESSION['error'] = 'Your credentials are incorrect. Please try again.'; // Changes $_SESSION['error'] to string "Your credentials are incorrect. Please try again."
  header('location:../index.php'); // Redirects the user to the login page
}



?>
