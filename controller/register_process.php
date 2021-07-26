<?php
	session_start(); 							//start session management.
	require('../model/details.php');			//Require the database connection Info.
	require('../model/function_users.php');		//Require the php sql functions file.


	//Retrieve the data that was entered into the form fields using the $_POST array.
	$email = $_POST['email'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$dob = $_POST['dob'];
	$password = $_POST['password'];

		$count = check_user_exists($email); //Call the check user function.

		if($count == 0) //If $count returns 0, then
		{
			$resultOne = add_user($email, $firstName, $lastName, $dob);	//Execute the add_user function.

				if($resultOne) //If $resultOne returns true then,
				{
				$_SESSION['success'] = 'User Account successfully added.'; //Set the session success message.
				$resultTwo = add_user_credentials($password); //Execute the add_user_credentials function.

					if($resultTwo) { //If $resultTwo returns true then,
						$_SESSION['success'] = 'User Account & Credentials Succesfully Created'; //Set the session success variable,
						header('location:../index.php'); //Redirect too login page.

					}
					else //Else if $resultTwo returns false,
					{
						$_SESSION['error'] = 'User Credentials Unable to be added'; //Set the session error variable,
						header('location:../index.php'); //Redirect to login page.
					}
				}
				else //Else If $resultOne returns false,
				{
				$_SESSION['error'] = 'Unable to Create Account'; //Set the session error variable.
				header('location:../index.php'); //Redirect to login page.
				}
		}
		else //Else if the $count returns anything apart from 0,
		{
			$_SESSION['error'] = 'Error starting add user process'; //Set the session error variable.
			header('location:../index.php'); //Redirect to login page.
		}

?>
