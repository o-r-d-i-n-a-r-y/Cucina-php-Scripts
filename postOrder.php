<?php
	include('connection.php');

	$phone = $_POST['order_phone'];

	$get_orders_amount = $conn->prepare("SELECT id FROM orders WHERE order_phone = '".$phone."' AND state < 3");
	$orders_amount = 0;
	$limit_reached = false;

	$get_orders_amount ->execute();
	$get_orders_amount ->bind_result($id);

	while($get_orders_amount ->fetch()) {
		$orders_amount += 1;

		if($orders_amount == 5) {
			$limit_reached = true;
			break;
		}
	}

	if($limit_reached === false) {
		$name = $_POST['order_name'];
		$list = $_POST['order_list'];
		$clar = $_POST['order_clar'];
		$cafe_id = $_POST['order_cafe_id'];

		$sql = "INSERT INTO orders (order_name, order_phone, order_list, order_clar, order_cafe_id) VALUES ('".$name."', '".$phone."', '".$list."', '".$clar."', '".$cafe_id."')";

		if(mysqli_query($conn, $sql)){
			echo "1";	// successfully posted
		}
		else{
			echo "0";	// failed to post
		}
	}
	else {
		echo "2";	// user already has 5 active orders
	}

	mysqli_close($conn);
?>