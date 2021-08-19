<?php
	include('connection.php');

	$cafe_id = $_POST['id'];
	$name = $_POST['name'];
	$complaint = $_POST['complaint'];

	$sql = "INSERT INTO complaints (user_name, cafe_id, complaint) VALUES ('".$name."', '".$cafe_id."', '".$complaint."')";

	if(mysqli_query($conn, $sql)) {
		echo "1";	// successfully posted
	}
	else{
		echo "0";	// failed to post
	}

	mysqli_close($conn);
?>