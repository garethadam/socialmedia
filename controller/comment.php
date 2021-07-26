<?php
	include('../model/details.php');
	require('../model/function.php');
	require('../model/functions_messages.php');
	session_start();

	//retrieve the data that was entered into the form fields using the $_POST array
	$date=date("Y-m-d h:i:s");
	$id = $_SESSION['userID'];
	$post = strip_tags($_POST['post']);
	$comment = strip_tags($_POST['comment']);

	$result = comment($id, $post, $date, $comment);

		if($result)
		{
			$_SESSION['success'] = 'Comment is entered.';
			header('location:../view/html/home.php');
		}
		else
		{
			$_SESSION['error'] = 'An error has occurred while commenting. Please try again.'.$post;
			header('location:../view/home.php');
		}

?>
