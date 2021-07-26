<?php
require('../model/details.php');            //Require the database connection Info
require('../model/function_users.php');     //Require the php sql functions file

$userId = $_GET['user'];                    //Store the user get parameter value

$result = retrieveAlbums($userId);          //Call the retrieveAlbums function

if($result)                                 //If $Result returned true, then
{
  echo json_encode($result);                //Print the $result array to screen
} else {                                    //Else if $result returned false
  echo 'Something went wrong - albums';     //Print that something went wrong.
}
?>
