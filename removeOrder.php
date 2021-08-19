<?php
	include('connection.php');

	$id = $_POST['id'];
	$phone = $_POST['phone'];

	$sql = "";

	if($id != -1) {
		$sql = "DELETE FROM orders WHERE id = '".$id."'";
	}
	else {
		$sql = "DELETE FROM orders WHERE state > 2 AND order_phone = '".$phone."'";
	}

	if(mysqli_query($conn, $sql)) {
		echo "1";	// successfully removed
	}
	else{
		echo "0";	// failed to removed
	}

	mysqli_close($conn);
?>