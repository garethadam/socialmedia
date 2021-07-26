
<?php

//database details
$uri = "mysql:dbname=socialmedia;host=127.0.0.1";
$user = "root";
$pass = "";
$error_message = "";


// connection variables
	try {
		$conn = new PDO($uri, $user, $pass);
	}
	catch (PDOException $e)
	{
		$error_message = "<h1> Database Connection Error </h1>
							<p> ERROR MESSAGE: </p>" . $e->getMessage();
	}
?>
