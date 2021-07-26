<?php
session_start();
require('../model/details.php');
require('../model/function_users.php');

$userOne = $_GET['userOne'];
$userTwo = $_GET['userTwo'];

$pendingResult = getPendingID($userOne, $userTwo);

$pendingID = json_encode($pendingResult[0]);
echo ($pendingID);
$result = checkPendingFriends($userOne, $userTwo, $pendingID);

if ($userOne != $userTwo) {
  if ($result != 0) {
    $resultTwo = actionFriend($userOne, $userTwo, $pendingID);
    if ($resultTwo)
    {
      $_SESSION['success'] = 'Friend request declined.';
    }
    else {
      $_SESSION['error'] = 'Something went wrong - decline friend';
    }
  }
  else {
    $_SESSION['error'] = 'No friend request found.';
  }
}

?>
