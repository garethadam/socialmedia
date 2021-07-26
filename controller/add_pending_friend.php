<?php
session_start();
require('../model/details.php');
require('../model/function_users.php');

$userOne = $_GET['userOne'];
$userTwo = $_GET['userTwo'];

$result = checkPendingFriends($userOne, $userTwo);

if ($userOne != $userTwo) {
  if ($result == 0) {
    $resultTwo = checkFriends($userOne, $userTwo);
    if ($resultTwo == 0) {
      $resultThree = addPendingFriend($userOne, $userTwo);
      if ($resultThree)
      {
        $_SESSION['success'] = 'Friend request sent.';
      }
      else {
        $_SESSION['error'] = 'Something went wrong - add pending friend';
      }
    }
    else {
      $_SESSION['error'] = 'Already friends.  Derp!';
    }

  }

  else {
    $_SESSION['error'] = 'Friend request already sent.';
  }
}

?>
