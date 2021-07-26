<?php
require('../model/details.php');            //Require the database connection Info
require('../model/function_users.php');     //Require the php sql functions file

$userId = $_GET['user'];                    //Store the user get parameter value

$result = retrieveFriends($userId);         //Call the retrieveFriends function

if($result)                                 //If $result returns true, then
{
  echo json_encode($result);                //Print the $result array
} else {                                    //Else if $result returned false
  echo 'Something went wrong - friends';    //Print that something went wrong
}
?>
