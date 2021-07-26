<?php
session_start();
require('../model/details.php');
require('../model/function_users.php');

$userOne = $_GET['userOne'];
$userTwo = $_GET['userTwo'];
$flag = 0;

$pendingResult = getPendingID($userOne, $userTwo);

$pendingID = $pendingResult[0];
$result = checkFriends($userOne, $userTwo);
echo "before check";
if (($userOne != $userTwo) && ($result !=1) ) {


  echo "not F1";
    $resultTwo = checkFriendsButNotFriends($userOne, $userTwo);

    if($resultTwo > 0){

      $flag = 1;
      echo "got here2";
      $resultThree = updateFriend($userOne, $userTwo);

        if($resultThree){
          $flag=1;
          $resultFour = actionFriend($pendingID);
          $_SESSION['success'] = 'Friendship Rekindled.';
      }
        } else {
            $resultFive = addFriend($userOne, $userTwo);
            if ($resultFive) {
              $flag=1;
              $resultSix = actionFriend($pendingID);
              $_SESSION['success'] = 'Friendship Accepted.';
          }
      }
}

// if ($userOne != $userTwo) {
//
//   if ($result == 0) {
//   echo "not F1";
//     $resultTwo = checkFriendsButNotFriends($userOne, $userTwo);
//
//     if($resultTwo > 0){
//
//       $flag = True;
//       echo "got here2";
//       $resultThree = updateFriend($userOne, $userTwo);
//         if($resultThree){
//           $resultFour = actionFriend($pendingID);
//           $_SESSION['success'] = 'Friendship Rekindled.';
//             if($resultFour) {
//                 $_SESSION['success'] = 'Pending Friendship Deleted.';
//             } else {
//               $_SESSION['error'] = 'Pending Friend Error';
//             }
//           } else {
//             $_SESSION['error'] = 'Error updating friend';
//           }
//         } else {
//             $resultFive = addFriend($userOne, $userTwo);
//             if ($resultFive) {
//               $resultSix = actionFriend($pendingID);
//               $_SESSION['success'] = 'Friendship Accepted.';
//               if($resultSix) {
//                 $_SESSION['success'] = 'pending friendship deleted.';
//               } else {
//                 $_SESSION['error'] = 'Pending Friend Error';
//               }
//             }
//             else {
//               $_SESSION['error'] = 'Error Adding Friend';
//             }
//           }
//       }
// }

?>
