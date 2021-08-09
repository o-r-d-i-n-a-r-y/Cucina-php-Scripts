<?php
	include 'connection.php';

	$phone = $_POST['phone'];
	$change_data = '';
	$sec_data_changed = false;

	if($_GET['apicall'] == 'username') {
		$username = $_POST['username'];

		$change_in_orders = "UPDATE orders SET order_name = '".$username."' WHERE order_phone = '".$phone."'";
		if(mysqli_query($conn, $change_in_orders)) {
			$sec_data_changed = true;
		}

		$change_data = "UPDATE users SET username = '".$username."' WHERE phone = '".$phone."'";
	}
	else {
		$sec_data_changed = true;
		$password = md5($_POST['password']);

		$change_data = "UPDATE users SET password = '".$password."' WHERE phone = '".$phone."'";
	}

	if (mysqli_query($conn, $change_data) && $sec_data_changed) {
		echo "SUCCESS";
	}
	else {
		echo "Error updating data: " . $conn->error;
	}


	mysqli_close($conn);
?>	