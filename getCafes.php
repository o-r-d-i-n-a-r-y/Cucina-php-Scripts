<?php

include('connection.php');

$user_city = $_POST['user_city'];

$stmt = $conn->prepare("SELECT id, latitude, longitude, state, address, img_urls FROM cafes WHERE city = ?");
$stmt->bind_param("s", $user_city);  
$stmt ->execute();
$stmt ->bind_result($id, $latitude, $longitude, $state, $address, $img_urls);

$cafes = array();

while($stmt ->fetch()) {
	$temp = array();

	$temp["id"] = $id;
	$temp["latitude"] = $latitude;
	$temp["longitude"] = $longitude;
	$temp["state"] = $state;
	$temp["address"] = $address;
	$temp["img_urls"] = $img_urls;

	array_push($cafes,$temp);
	}
	
echo json_encode($cafes);
?>