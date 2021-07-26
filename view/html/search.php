<?php
session_start();
require('../../model/details.php');
require('../../controller/session_message.php');
require('../../view/html/header.php');
require('../../model/function.php');
require('../../model/functions_messages.php');
$search=$_GET['search'];
$userid = $_SESSION['userID'];
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

<?php require('sideNav.php'); ?>

      <div id="container">

        <?php require('topNav.php'); ?>

        <div id="contentContainer">
            <div id="oneColumn">
                <div id="profilePageContent">
                    <div id="searchResults">
                        <p class="titleText"> Search Results: "<?php echo $search ?>"</p>
                        <br>
                        <div class="searchContent">
                            <div class="searchUserResults">
                            <?php
                            $result=searchUser($search);
                            foreach($result as $view)
                            {
                            ?>
                            <a href="profile.php?user=<?php echo $view['userID']; ?>" >
                                <div class="userThumbnail">
                                    <img class="userThumbnailPhoto" src="../images/<?php echo $view['userPhoto'] ?>">
                                    <div class="userThumbnailInfo">
                                          <p class="thumbnailName"><?php echo $view['firstName'] . " " . $view['lastName'] ?></p>
                                          <p class="thumbnailEmail"> <?php echo $view['userEmail']; ?> </p>
                                    </div>
                                </div>
                                 </a>
                            <?php  }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

  </body>

  <script src="../js/script.js"></script>

</html>
