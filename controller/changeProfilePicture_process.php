<?php
session_start(); // Starts session
require('../model/details.php'); // Require the database connection Info
require('../model/function_users.php'); //Require the php sql functions file

$userId = $_SESSION['userID']; // Storing $_SESSION['userID'] in variable $userId
$image = $_FILES["profileData"]["name"]; // Storing FILES array in variable $image

        if (($_FILES["profileData"]["type"] == "image/jpg") ||($_FILES["profileData"]["type"] == "image/png") ||($_FILES["profileData"]["type"] == "image/jpeg")|| ($_FILES["profileData"]["type"] == "image/gif")) // Checks if $_FILES is an image
        {
          $randomDigit = rand(0000,9999); //generate a random numerical digit <= 4 characters
          $image = strtolower($userId . "_" . $randomDigit . "_" . $image); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security
          move_uploaded_file($_FILES["profileData"]["tmp_name"],"../view/images/" . $image); // Moves the uploaded files to the projects images folder
      }

$result = updateProfilePicture($userId, $image); // Calls updateProfilePicture function and returns $result
if($result){ // If $result is true
  $_SESSION['success'] = "Profile picture changed"; // Changes $_SESSION['success'] to string "Profile picture changed"
  $_SESSION['userPhoto'] = $image; // Changes $_SESSION['userPhoto'] value to $image
  header('location:../view/html/profile.php?user='.$userId); // redirect the user to the users profile page
}else{ // If $result is false
  $_SESSION['error'] = "Something went wrong"; // Changes $_SESSION['error'] to string "Something went wrong"
  header('location:../view/html/profile.php?user='.$userId); // redirect the user to the users profile page
}









?>
