<?php
require('../../model/details.php');                 //Require the database connection Info
require('../../model/function_users.php');          //Require the php sql functions file

$userId = $_GET['user'];                            //Store the user get parameter value
$userIden = null;

$result = retrieveProfile($userId);                 //Call the retrieveProfile function

if($result)                                         //If $result returned true then,
{
  $fullName = $result[0] . " " . $result[1];        //Store the $result index value 0 and 2 in $fullName variable
  $userEmail = $result[2];                          //Store the $result index value 2 in $userEmail variable
  $userPhoto = $result[3];                          //Store the $result index value 3 in the $userPhoto variable
  $userIden = $result[4];                           //Store the $result index value 4 in the $userIden variable
} else {                                            //Else if $result returns false,
  echo 'Something went wrong - profile';            //Print that something went wrong
}
?>
