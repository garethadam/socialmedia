<?php
	include('../model/details.php');
	require('../model/function.php');
	require('../model/functions_messages.php');
	session_start();

	$search = $_POST['search'];
	$output="";

	$result1= searchUser($search);
	$result2= searchPost($search);

	$count1= searchCountUser($search);
	$count2= searchCountPost($search);

	if ($count1 > 0 || $count2> 0 )

		{
			foreach($result1 as $view)
			{
				$output.='<a href="profile.php?user=' . $view['userID'] . '"><div class="searchDropResult"><img class="searchImg" src="../images/' . $view['userPhoto'] . '">' . $view['firstName'] . " " . $view['lastName'] . '</div></a>';

			}
			foreach($result2 as $field)
			{
				$output.='<a href="profile.php?user=' . $field['userID'] . '"><div class="searchDropResult"><img class="searchImg" src="../images/' . $field['userPhoto'] . '">' . $field['firstName'] . " " . $field['lastName'] . " Posted <br>" . $field['postText'] . '</div></a>';
			}
			echo $output;

		}
	else
		{
			echo "No result";
		}



?>
