<?php
	require_once 'connection.php';   

	$name = $_POST['order_name'];
	$phone = $_POST['order_phone'];
	$list = $_POST['order_list'];
	$clar = $_POST['order_clar'];
	$cafe_id = $_POST['order_cafe_id'];

	$sql = "INSERT INTO orders (order_name, order_phone, order_list, order_clar, order_cafe_id) VALUES ('".$name."', '".$phone."', '".$list."', '".$clar."', '".$cafe_id."')";

	if(mysqli_query($conn, $sql)){
		echo "1";
	}
	else{
		echo "0";
	}
?>