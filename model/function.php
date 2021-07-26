<?php

//create a function to retrieve
	function get_posts($id)
	{
		global $conn;
		$sql = 'SELECT * FROM poststable JOIN usertable ON usertable.userID=poststable.userID WHERE poststable.userID=:id OR poststable.userID IN (SELECT userID FROM ( SELECT friend FROM friendstable WHERE userid = :id AND isHidden = 1 UNION ALL SELECT userid FROM friendstable WHERE friend = :id AND isHidden = 1 ) AS Subdata JOIN usertable ON usertable.userID = Subdata.friend)  ORDER BY poststable.postDate DESC ';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result;
	}

	//create a function to retrieve
		function get_posts_user($id)
		{
			global $conn;
			$sql = 'SELECT * FROM poststable JOIN usertable ON usertable.userID=poststable.userID WHERE poststable.userID=:id';
			$statement = $conn->prepare($sql);
			$statement->bindValue(':id', $id);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor();
			return $result;
		}

//create a function to insert
	function post($id, $date, $post)
	{
		global $conn;
		$sql = 'INSERT INTO poststable (userID, postDate, postText) VALUES (:id,  :date, :post)';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':date', $date);
		$statement->bindValue(':post', $post);
		$result=$statement->execute();
		$statement->closeCursor();
		return $result;
	}
//create a function to insert
	function findPost($userid, $date)
	{
		global $conn;
		$sql = 'SELECT * FROM poststable  WHERE userID=:id AND postDate=:date';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $userid);
		$statement->bindValue(':date', $date);
		$result=$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}
//create a function to insert
	function findImages($postid)
	{
		global $conn;
		$sql = 'SELECT * FROM images where postid=:id';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $postid);
		$result=$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result;
	}

//create a function to insert
	function post_image($userid, $postid, $albumid, $image, $date )
	{
		global $conn;
		$sql = 'INSERT INTO images(userid, postid, albumid, imageName, imageDate) VALUES (:id,  :postid, :albumid, :image, :date)';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $userid);
		$statement->bindValue(':postid', $postid);
		$statement->bindValue(':albumid', $albumid);
		$statement->bindValue(':image', $image);
		$statement->bindValue(':date', $date);
		$result=$statement->execute();
		$statement->closeCursor();
		return $result;
	}
//create a function to insert
	function findAlbum($userid, $albumname)
	{
		global $conn;
		$sql = 'SELECT * FROM albumtable WHERE userID=:id AND albumName=:name';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $userid);
		$statement->bindValue(':name', $albumname);
		$result=$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result;
	}

//create a function to insert
	function finduser($userid)
	{
		global $conn;
		$sql = 'SELECT * FROM usertable WHERE userID=:id';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $userid);
		$result=$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result;
	}
//create a function to retireve comments
	function get_comments($id)
	{
		global $conn;
		$sql = 'SELECT * FROM commentstable JOIN usertable ON commentstable.userID=usertable.userID WHERE commentstable.postID= :id  ORDER BY commentstable.commentDate DESC';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$result=$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result;
	}
//create a function to insert
	function comment($id, $post, $date, $comment)
	{
		global $conn;
		$sql = 'INSERT INTO commentstable (userID, postID, commentDate, commentText) VALUES (:id, :post,  :date, :comment)';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':post', $post);
		$statement->bindValue(':date', $date);
		$statement->bindValue(':comment', $comment);
		$result=$statement->execute();
		$statement->closeCursor();
		return $result;
	}

//create a function to insert
	function searchUser($search)
	{
		global $conn;
		$likeVar = "%" . $search . "%";
		$sql = "SELECT * FROM usertable WHERE firstName LIKE :search or lastName LIKE :search or userEmail LIKE :search";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':search', $likeVar);
		$result1=$statement->execute();
		$result1 = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result1;
	}

//create a function to insert
	function searchCountUser($search)
	{
		global $conn;
		$likeVar = "%" . $search . "%";
		$sql = "SELECT * FROM usertable WHERE firstName LIKE :search or lastName LIKE :search or userEmail LIKE :search";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':search', $likeVar);
		$result=$statement->execute();
		$count1 = $statement->rowCount();
		$statement->closeCursor();
		return $count1;
	}
//create a function to insert
	function searchPost($search)
	{
		global $conn;
		$likeVar = "%" . $search . "%";
		$sql = "SELECT * FROM poststable AS A JOIN usertable AS B ON A.userID = B.userID WHERE postText LIKE :search";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':search', $likeVar);
		$result2=$statement->execute();
		$result2 = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result2;
	}
//create a function to insert
	function searchCountPost($search)
	{
		global $conn;
		$likeVar = "%" . $search . "%";
		$sql = "SELECT * FROM poststable WHERE postText LIKE :search";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':search', $likeVar);
		$result=$statement->execute();
		$count2 = $statement->rowCount();
		$statement->closeCursor();
		return $count2;
	}

	//like a Post
	function like($id, $currentPost)
	{
		global $conn;
		$sql = 'INSERT INTO liketable (userID, postID) VALUES (:id, :currentPost)';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':currentPost', $currentPost);
		$result=$statement->execute();
		$statement->closeCursor();
		return $result;
	}

	//unlike a Post
	function unlike($id, $currentPost)
	{
		global $conn;
		$sql = 'DELETE FROM liketable WHERE userID = :id AND postID = :currentPost';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':currentPost', $currentPost);
		$result=$statement->execute();
		$statement->closeCursor();
		return $result;
	}

	//Check if user already liked a post
	function checkLike($id, $currentPost)
	{
		global $conn;
		$sql = "SELECT * FROM liketable WHERE userID = :id AND postID = :currentPost";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':currentPost', $currentPost);
		$result=$statement->execute();
		$result = $statement->rowCount();
		$statement->closeCursor();
		return $result;
	}

	//Check if user already liked a post
	function displayLike($id, $currentPost)
	{
		global $conn;
		$sql = "SELECT * FROM liketable WHERE userID = :id AND postID = :currentPost";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':currentPost', $currentPost);
		$result=$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $result;
	}


?>
