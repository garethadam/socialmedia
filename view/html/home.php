<?php
session_start();
require('../../controller/session_message.php');
require('../../view/html/header.php');
require('../../model/details.php');
require('../../model/function.php');
require('../../model/functions_messages.php');

$userid = $_SESSION['userID'];
$date=date("Y-m-d h:i:s");
$album="Timeline";

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
require('sideNav.php');
require('friendsPopup.php');
 ?>

      <div id="container">

        <?php require('topNav.php'); ?>

        <div id="contentContainer">

              <script>
                            var id='<?php echo $userid; ?>';
                            var date='<?php echo $date; ?>';
                            var album='<?php echo $album; ?>';
              </script>

                        <div id="floatRight">
                        <!-- THIS IS THE POST FORM THAT NEEDS TO BE TURNED INTO A REACT ELEMENT -->
                        <div id="post">
                        <?php user_message(); ?>
                        </div>
                        <!-- POST FORM ENDS HERE -->
            			<?php
            			$result = get_posts($userid);
            			$item=0;
            			$comment=array();
            			$image=array();
                  $like=array();
            			foreach($result as $view)
            			{
            				 $list['post'][$item] =$view['postID'];
                             $list['uid'][$item] =$view['userID'];
            				 $list['name'][$item] =$view['firstName'];
                             $list['last'][$item] =$view['lastName'];
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

                      $likes=displayLike($userid, $view['postID']);
                      if(count($likes)>0)
                        {
                          foreach($likes as $id)
                          {
                            $check= array('post'=>$view['postID'], 'like'=>$id['likeID']);
                            array_push($like,$check);
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

            			<script type="text/babel" src="../components/post_react.js"></script>
            			<script type="text/babel" src="../components/posts.js"></script>


        </div>

    </div>

  </body>

  <script src="../js/script.js"></script>
  <script type="text/babel" src="../js/babelScript.js"></script>

</html>
