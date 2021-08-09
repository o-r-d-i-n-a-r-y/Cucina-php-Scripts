<?php
	include('connection.php');

	$user_phone = $_POST['user_phone'];

	$stmt = $conn->prepare("SELECT id, order_list, order_clar, order_cafe_id, state FROM orders WHERE order_phone = ? AND state != 4");
	$stmt->bind_param("s", $user_phone);
	$stmt ->execute();
	$stmt ->bind_result($id, $order_list, $order_clar, $order_cafe_id, $state);

	$orders = array();

	while($stmt ->fetch()) {
		$temp = array();

		$temp["id"] = $id;
		$temp["order_list"] = $order_list;
		$temp["order_clar"] = $order_clar;
		$temp["order_cafe_id"] = $order_cafe_id;
		$temp["state"] = $state;

		array_push($orders, $temp);
	}

	echo json_encode($orders);
?>