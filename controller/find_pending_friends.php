<?php
require('../model/details.php');
require('../model/function_users.php');

$userId = $_GET['user'];

$result = retrievePendingFriends($userId);

if($result)
{
  echo json_encode($result);
} else {
  echo 'Something went wrong - pending friends';
}

?>
