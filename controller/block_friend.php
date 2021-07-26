<?php
session_start();
require('../model/details.php');
require('../model/function_users.php');

$userID = $_GET['friend'];
$friend = $_GET['friendID'];
$zero = 0;

$friendResult = getFriendID($userID, $friend);

$unFriendID = $friendResult[0];


echo($unFriendID);
$result = unFriend($unFriendID, $zero);
if ($result)
{
  $_SESSION['success'] = 'Friend un-friended.';
}
else {
  $_SESSION['error'] = 'Something went wrong - block friend';
}

?>
