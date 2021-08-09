<?php

	include('connection.php'); 

	$stmt = $conn->prepare("SELECT name, category, dish_group, description, img_url, price FROM dishes");

	$stmt ->execute();
	$stmt ->bind_result($name, $category, $dish_group, $description, $img_url, $price);

	$dishes = array();

	while($stmt ->fetch()) {
		$temp = array();

		$temp["name"] = $name;
		$temp["category"] = $category;
		$temp["dish_group"] = $dish_group;
		$temp["description"] = $description;
		$temp["img_url"] = $img_url;
		$temp["price"] = $price;

		array_push($dishes,$temp);
	}

	echo json_encode($dishes);
?>