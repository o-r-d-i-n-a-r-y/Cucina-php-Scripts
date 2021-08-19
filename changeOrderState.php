<?php
	include 'connection.php';

	$new_state = $_POST['state'];
	$id = $_POST['id'];

	$sql = "UPDATE orders SET state = '".$new_state."' WHERE id = '".$id."'";

	if (mysqli_query($conn, $sql)) {
		echo "SUCCESS";
	}
	else {
		echo "Error updating data: " . $conn->error;
	}

	mysqli_close($conn);
?>