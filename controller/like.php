<?php
	include('../model/details.php');
	require('../model/function.php');
	require('../model/functions_messages.php');
	session_start();

	//retrieve the data that was entered into the form fields using the $_POST array
	$date=date("Y-m-d h:i:s");
	$id=$_SESSION['userID'];
	$currentPost = $_GET['post'];


	echo $currentPost;

    $result = checkLike($id, $currentPost);

    if($result == 0) {
        $_SESSION['success'] = 'Like check successful';

        $resultTwo = like($id, $currentPost);

		if($resultTwo)
		{
			$_SESSION['success'] = 'Post Successfully Liked.';
		}
		else
		{
			$_SESSION['error'] = 'An error has occurred while liking. Please try again.';
		}

    }
    else
    {
		$resultThree = unlike($id, $currentPost);

		if($resultThree) {
			$_SESSION['success'] = 'Post unliked';
		} else {
			$_SESSION['error'] = 'Unable to unlike post';
		}
    }


?>
