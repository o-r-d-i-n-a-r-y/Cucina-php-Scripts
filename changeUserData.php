<?php
	include 'connection.php';

	$phone = $_POST['phone'];
	$change_data = '';
	$sec_data = 0;

	if($_GET['apicall'] == 'username') {
		$user_name = $_POST['username'];

		$change_in_orders = "UPDATE orders SET order_name = '".$user_name."' WHERE order_phone = '".$phone."'";
		if(mysqli_query($conn, $change_in_orders)) {
			$sec_data = 1;
		}

		$change_data = "UPDATE users SET username = '".$user_name."' WHERE phone = '".$phone."'";
	}
	elseif($_GET['apicall'] == 'city') {
		$city = $_POST['city'];

		$check_orders = $conn->prepare("SELECT id FROM orders WHERE order_phone = ? AND state < 3");
		$check_orders->bind_param("s", $phone);
		$check_orders ->execute();
		$check_orders ->bind_result($id);

		if($check_orders ->fetch()) {
			$sec_data = 2;
		}
		else {
			$sec_data = 1;
		}

		$change_data = "UPDATE users SET city = '".$city."' WHERE phone = '".$phone."'";
	}
	elseif($_GET['apicall'] == 'phone') {
		$new_phone = $_POST['new_phone'];

		$check_orders = $conn->prepare("SELECT id FROM orders WHERE order_phone = ? AND state < 3");
		$check_orders ->bind_param("s", $phone);
		$check_orders ->execute();
		$check_orders ->bind_result($id);

		if($check_orders ->fetch()) {
			$sec_data = 2;
		}
		else {
			$check_users = $conn->prepare("SELECT id FROM users WHERE phone = ?");
			$check_users ->bind_param("s", $phone);
			$check_users ->execute();
			$check_users ->bind_result($id);
			
			if($check_users ->fetch()) {
				$sec_data = 3;
			}
			else {
				$change_in_orders = "UPDATE orders SET order_name = '".$username."' WHERE order_phone = '".$phone."'";
				if(mysqli_query($conn, $change_in_orders)) {
					$sec_data = 1;
				}
			}
		}

		$change_data = "UPDATE users SET phone = '".$new_phone."' WHERE phone = '".$phone."'";
	}
	else {
		$sec_data = 1;
		$password = md5($_POST['password']);

		$change_data = "UPDATE users SET password = '".$password."' WHERE phone = '".$phone."'";
	}

	if ($sec_data == 2) {
		echo "ACTIVE_ORDERS";
	}
	elseif ($sec_data == 3) {
		echo "PHONE_TAKEN";
	}
	elseif (mysqli_query($conn, $change_data) && $sec_data == 1) {
		echo "SUCCESS";
	}
	else {
		echo "Error updating data: " . $conn->error;
	}

	mysqli_close($conn);
?>	
