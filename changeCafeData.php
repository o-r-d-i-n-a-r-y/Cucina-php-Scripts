<?php
	include 'connection.php';

	$id = $_POST['cafe_id'];
	$change_data = '';

	if($_GET['apicall'] == 'urls') {
		$urls = $_POST['urls'];
		$change_data = "UPDATE cafes SET img_urls = '".$urls."' WHERE id = '".$id."'";
	}
	else {
		$state = $_POST['state'];
		$change_data = "UPDATE cafes SET state = '".$state."' WHERE id = '".$id."'";
	}

	if (mysqli_query($conn, $change_data)) {
		echo "SUCCESS";
	}
	else {
		echo "Error updating data: " . $conn->error;
	}

	mysqli_close($conn);
?>