<?php
	include('connection.php');

	$req_cafe_id = $_POST['cafe_id'];

	$stmt = $conn->prepare("SELECT id, order_name, order_phone, order_list, order_clar, state FROM orders WHERE order_cafe_id = ? AND state < 3");
	$stmt->bind_param("s", $req_cafe_id);
	$stmt ->execute();
	$stmt ->bind_result($id, $order_name, $order_phone, $order_list, $order_clar, $state);

	$orders = array();

	while($stmt ->fetch()) {
		$temp = array();

		$temp["id"] = $id;
		$temp["order_name"] = $order_name;
		$temp["order_phone"] = $order_phone;
		$temp["order_list"] = $order_list;
		$temp["order_clar"] = $order_clar;
		$temp["state"] = $state;

		array_push($orders, $temp);
	}

	echo json_encode($orders);
?>