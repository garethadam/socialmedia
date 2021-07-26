<?php
session_start();
require('../../controller/session_message.php');
require('../../view/html/header.php');
require('../../model/function.php');
require('../../model/functions_messages.php');
$date=date("Y-m-d h:i:s");
$album="Timeline";

if(!isset($_GET['user'])) {
    header('Location: profile.php?user=' . $_SESSION['userID']);
}

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UC Hub</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="../js/search.js" type="text/javascript"></script>
  </head>

  <body>
<?php
    require('friendsPopup.php');
    require('sideNav.php');
    require('albumPopup.php');
?>

      <div id="container">

        <?php
          require('topNav.php');
          require('../../controller/find_profile.php');
        ?>


        <div id="contentContainer">
            <div id="oneColumn">
                <div id="profileHeader">
                  <div class="picContainer">
                    <img id="profileImage" src="../images/<?php echo $userPhoto ?>"></br>

                    <?php
                    if ($_GET['user'] == $_SESSION['userID']) { ?>
                    <button class="changeProfilePicture">Change Profile Picture</button>
                  </br><form method="post" action="../../controller/changeProfilePicture_process.php" enctype="multipart/form-data"><input id="profileData"type="file" name="profileData"><input type="submit" id="changePic"></form>
                    <?php } ?>
                  </div>
                    <div id="profileTitleDetails">
                        <p class='profileName'><?php echo $fullName ?></p>
                        <p class='profileEmail'><?php echo $userEmail ?></p>
                        <p class='profileCampus'>Bruce Campus</p>
                    </div>
                </div>
                <div id="profileLinkBar">
                    <div class="profileButton">
                        <div class="profileButtonContainer">
                            <img src="../images/posts.png">
                            <p class="buttonText"> Posts </p>
                        </div>
                    </div>
                    <div class="profileButton" onclick="populateAlbums(<?php echo $_GET['user'] ?>)">
                        <div class="profileButtonContainer">
                            <img src="../images/camera.png">
                            <p class="buttonText"> Albums </p>
                        </div>
                    </div>
                    <div class="profileButton">
                      <div class="profileButtonContainer" onClick="addPendingFriend(<?php echo $_SESSION['userID'] ?>, <?php echo $userId ?>)">
                            <img src="../images/addFriend.png">
                            <p class="buttonText"> Add Friend </p>
                        </div>
                    </div>
                </div>
                <div id="profilePageContent">
                    <div id="friendsRight">
                        <p class="titleText"> Friends </p>
                        <div id="friendsList">
                            <script type="text/babel">
                                $( document ).ready(function() {
                                    displayProfileFriends(<?php echo $_GET['user'] ?>, <?php echo $_SESSION['userID']?>);
                                });
                            </script>
                        </div>
                        <button class="showAllFriends" onclick="displayAllFriends(<?php echo $_GET['user'] ?>)">Show All Friends</button>
                    </div>

              <div id="postsCont">
                    <div id="postsLeft">
                        <p class="titleText"> Posts by <?php echo $fullName ?> </p>
                        <div id="test" class="test">
                        <?php $profileUser=$_GET['user'] ;

                          	  $result=get_posts_user($profileUser);
                              $item=0;
                              $comment=array();
                              $image=array();
                              $like=array();
                              foreach($result as $view)
                              {
                                 $list['post'][$item] =$view['postID'];
                                 $list['name'][$item] =$view['firstName'];
                                 $list['uid'][$item] =$view['userID'];
                                 $list['lastname'][$item] =$view['lastName'];
                                 $list['text'][$item] =$view['postText'];
                                 $list['postdate'][$item] =$view['postDate'];
                                 $list['profilePic'][$item] =$view['userPhoto'];
                                 $images=findImages( $view['postID'] );
                                  if(count($images)>0)
                                    {
                                      foreach($images as $img)
                                      {
                                        $save = array('post'=>$view['postID'], 'image'=>$img['imageName']);
                                        array_push($image,$save);
                                      }

                                    }

                                  $comments=get_comments( $view['postID'] );
                                    if(count($comments)>0)
                                    {
                                      foreach($comments as $comt)
                                      {
                                        $store = array('post'=>$view['postID'], 'comment'=>$comt['commentText'], 'uid'=>$comt['userID'], 'user'=>$comt['firstName'], 'last'=>$comt['lastName'], 'Date'=>$comt['commentDate'], 'profilePic'=>$comt['userPhoto']);
                                        array_push($comment,$store);
                                      }
                                    }

                                    $likes=displayLike($_GET['user'], $view['postID']);
                                    if(count($likes)>0)
                                      {
                                        foreach($likes as $id)
                                        {
                                          $check= array('post'=>$view['postID'], 'like'=>$id['likeID']);
                                          array_push($like,$check);
                                        }

                                      }

                                $item++;

                                }

                                ?>
                                    <!-- THIS IS THE TEMPLATE FOR THE POSTS -->
                                    <script>
                                        var posts=<?php echo json_encode( $list); ?>;
                                        var comments=<?php echo json_encode( $comment); ?>;
                                        var images=<?php echo json_encode( $image); ?>;
                                        var likes=<?php echo json_encode( $like); ?>;
                        				        console.log(images);
                        				        console.log(comments);
                        				        console.log(posts);
                        				        console.log(likes);
                                    </script>
                                    <div id="posts">
                                    </div>
                                    <!-- END OF POST TEMPLATE -->
                                  </div>

                        <script type="text/babel" src="../components/profileposts.js"></script>
                        </div>
                    </div>
              </div>
              </div>
              </div>
        </div>

        <?php
          if($userIden == null) {
            header("Location: ../../view/html/profile.php");
          }
        ?>

            </div>

  </body>

  <script src="../js/script.js"></script>
  <script type="text/babel" src="../js/babelScript.js"></script>

</html>
