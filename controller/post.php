<?php
	require("../model/details.php");
	require("../model/function.php");
	require("../model/functions_messages.php");
	session_start();

	//retrieve the data that was entered into the form fields using the $_POST array
	$date=date("Y-m-d h:i:s");
	$id= $_SESSION['userID'];
	$post = $_POST["post"];
	$album= "Timeline";


		$result = post($id, $date, $post);




			if($result)
			{
				$findPost=findPost($id, $date); foreach($findPost as $row){ $postid=$row["postID"]; }
				echo count($_FILES['file']['name']);
				if(count($_FILES["file"]["name"]) > 0)
				{
				  for($i=0; $i<count($_FILES["file"]["name"]); $i++)
				  {
					  $image = $_FILES["file"]["name"][$i];
					  if (($_FILES["file"]["type"][$i] == "image/jpg") ||($_FILES["file"]["type"][$i] == "image/png") ||($_FILES["file"]["type"][$i] == "image/jpeg")|| ($_FILES["file"]["type"][$i] == "image/gif"))
					  {
						$randomDigit = rand(0000,9999); //generate a random numerical digit <= 4 characters
						$image = strtolower($randomDigit . "_" . $image); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security
						move_uploaded_file($_FILES["file"]["tmp_name"][$i],"../view/images/" . $image);
					 	}
					  $find=findAlbum($id, $album); foreach($find as $row){ $albumid=$row["albumID"]; }
					  $result = post_image($id, $postid, $albumid, $image, $date);
				  	}
				  }

				$_SESSION["success"] = "Post is entered.".$date;

				redirect("../view/html/home.php");
			}
			else
			{
				$_SESSION["error"] = "An error has occurred. Please try again.";
				redirect("../view/html/home.php");
			}


?>
