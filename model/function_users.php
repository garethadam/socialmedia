<?php


// **** User Functions - Add User **** //

function add_user($email, $firstName, $lastName, $dob)
{
  global $conn;
  $sql = "INSERT INTO usertable (userEmail, firstName, lastName, dob) VALUES (:email, :firstName, :lastName, :dob)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':firstName', $firstName);
  $statement->bindValue(':lastName', $lastName);
  $statement->bindValue(':dob', $dob);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

function add_user_credentials($password)
{
  global $conn;
  $sql = "INSERT INTO usercredentialstable (userID, userPassword) VALUES (:userID, md5(:password));
  INSERT INTO albumtable (userID, albumName) VALUES (:userID, :albumName);";
  $statement = $conn->prepare($sql);
  $userID = $conn->lastInsertId();
  $statement->bindValue(':userID', $userID);
  $statement->bindValue(':password', $password);
  $statement->bindValue(':albumName', 'Timeline');
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

// **** Photo fuctions **** //

function updateProfilePicture($userId, $image)
{
  global $conn;
  $sql = "UPDATE usertable SET userPhoto = :image WHERE userID = :userID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userID', $userId);
  $statement->bindValue(':image', $image);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

// **** Friends fuctions **** //

function checkPendingFriends($userOne, $userTwo) {
  global $conn;
  $sql = "SELECT * FROM pendingfriendstable WHERE userOne = :userOne AND userTwo = :userTwo
    OR userOne = :userTwo AND userTwo = :userOne";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userOne', $userOne);
  $statement->bindValue(':userTwo', $userTwo);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  $count = $statement->rowCount();
  return $count;
}

function checkFriends($userOne, $userTwo) {
  global $conn;
  $sql = "SELECT * FROM friendstable WHERE (userid = :userOne AND friend = :userTwo AND isHidden = 1)
    OR (userid = :userTwo AND friend = :userOne AND isHidden = 1)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userOne', $userOne);
  $statement->bindValue(':userTwo', $userTwo);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  $count = $statement->rowCount();
  return $count;
}

function checkFriendsButNotFriends($userOne, $userTwo) {
  global $conn;
  $sql = "SELECT * FROM friendstable WHERE (userid = :userOne AND friend = :userTwo AND isHidden = 0)
    OR (userid = :userTwo AND friend = :userOne AND isHidden = 0)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userOne', $userOne);
  $statement->bindValue(':userTwo', $userTwo);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  $count = $statement->rowCount();
  return $count;
}

function addPendingFriend($userOne, $userTwo)
{
  global $conn;
  $sql = "INSERT INTO pendingfriendstable (userOne, userTwo) VALUES (:userOne, :userTwo)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userOne', $userOne);
  $statement->bindValue(':userTwo', $userTwo);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

function addFriend($userOne, $userTwo)
{
  global $conn;
  $sql = "INSERT INTO friendstable (userid, friend, isHidden) VALUES (:userid, :friend, :isHidden)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userid', $userOne);
  $statement->bindValue(':friend', $userTwo);
  $statement->bindValue(':isHidden', 1);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

function actionFriend($pendingID)
{
  global $conn;
  $sql = "DELETE FROM pendingfriendstable WHERE pendingFriendID = :pendingFriendID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':pendingFriendID', $pendingID);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

function updateFriend($userOne, $userTwo)
{
  global $conn;
  $sql = "UPDATE friendstable SET isHidden = 1 WHERE (userid = :userid AND friend = :friend) OR (userid = :friend AND friend = :userid)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userid', $userOne);
  $statement->bindValue(':friend', $userTwo);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

function unFriend($unFriendID, $zero)
{
  global $conn;
  $sql = "UPDATE friendstable SET isHidden = :zero WHERE friendID = :friendID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':friendID', $unFriendID);
  $statement->bindValue(':zero', $zero);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}


// **** User Functions - Check User & login **** //

function check_user_exists($email)
{
  global $conn;
  $sql = "SELECT * FROM usertable WHERE userEmail = :email";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':email', $email);
  $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  $count = $statement->rowCount();
  return $count;
}

function check_login($email)
{
  global $conn;
  $sql = "SELECT A.userPassword, B.userID, B.userPhoto FROM usercredentialstable AS A JOIN usertable AS B on A.userID=B.userID WHERE userEmail = :email";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':email', $email);
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_NUM);
  $statement->closeCursor();
  return $result;
}

// **** Retrieve Functions **** //

function getPendingID($userOne, $userTwo) {
  global $conn;
  $sql = "SELECT pendingFriendID from pendingfriendstable WHERE userOne = :userOne AND userTwo = :userTwo";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userOne', $userOne);
  $statement->bindValue(':userTwo', $userTwo);
  $result = $statement->execute();
  $result = $statement->fetch(PDO::FETCH_NUM);
  $statement->closeCursor();
  return $result;
}

function getFriendID($userID, $friend) {
  global $conn;
  $sql = "SELECT friendID from friendstable WHERE (userID = :userID AND friend = :friend) OR (userID = :friend AND friend = :userID)";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userID', $userID);
  $statement->bindValue(':friend', $friend);
  $result = $statement->execute();
  $result = $statement->fetch(PDO::FETCH_NUM);
  $statement->closeCursor();
  return $result;
}

function retrievePendingFriends($userId)
{
  global $conn;
  $sql = "SELECT userID, firstName, lastName, userPhoto FROM usertable AS A
    JOIN pendingfriendstable AS B on A.userID = B.userOne
    WHERE userTwo = :userID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userID', $userId);
  $result = $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  return $result;
}

function retrieveProfile($userId)
{
  global $conn;
  $sql = "SELECT firstName, lastName, userEmail, userPhoto, userID FROM usertable WHERE userID = :userID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userID', $userId);
  $result = $statement->execute();
  $result = $statement->fetch();
  $statement->closeCursor();
  return $result;
}

function retrieveFriends($userId)
{
global $conn;
  $sql = "SELECT userID, firstName, lastName, userEmail, userPhoto FROM (
            SELECT friend FROM friendstable WHERE userid = :userID AND isHidden = 1
            UNION ALL
            SELECT userid FROM friendstable WHERE friend = :userID AND isHidden = 1
            ) AS Subdata
            JOIN usertable ON usertable.userID = Subdata.friend ";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userID', $userId);
  $result = $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_NUM);
  $statement->closeCursor();
  return $result;
}

function retrieveAlbums($userId){
  global $conn;
  $sql = "SELECT * FROM images WHERE userid = :userID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':userID', $userId);
  $result = $statement->execute();
  $result = $statement->fetchAll();
  $statement->closeCursor();
  return $result;
}

?>
