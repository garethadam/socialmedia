<?php

	//redirect
	function redirect($path)
	{
	header('location:'. $path);
	} 
	//find admin
	function find_admin()
	{
	if(!isset($_SESSION['admin']))
	{
	  //if the admin session is not set (i.e. the user is not logged in) redirect to the login page
	  redirect('..\login.php');
	}
	else{
	  $mainuser=$_SESSION['admin'];
	  return $mainuser;
	  }
	}


	//create a function for user messages
	function user_message()
	{
		//display a user message if there is an error
		if(isset($_SESSION['error']))
		{ 
			echo '<div class="error">';
			echo '<p>"' . $_SESSION['error'] . '"</p>'; 
			echo '</div>';
			//unset the session named 'error' else it will show each time you visit the page
			unset($_SESSION['error']);
		}
		//display a user message if action is successful
		elseif(isset($_SESSION['success'])) 
		{ 
			echo '<div class="success">';
			echo '<p>' . $_SESSION['success'] . '</p>'; 
			echo '</div>';
			//unset the session named 'success' else it will show each time you visit the page
			unset($_SESSION['success']);
		}
	}
	function user_welcome()
	{
		//display a user message if there is an error
		if(isset($_SESSION['welcome']))
		{ 
			echo '<div class="welcome">';
			echo '<p>' . $_SESSION['welcome'] . '</p>'; 
			echo '</div>';
			//unset the session named 'error' else it will show each time you visit the page
			unset($_SESSION['welcome']);
		}
		
	}
?>
