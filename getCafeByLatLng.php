<?php
	include('connection.php');

	$latitude = $_POST['lat'];
	$longitude = $_POST['lng'];

	$stmt = $conn->prepare("SELECT id, state, address, img_urls FROM cafes WHERE latitude = ? AND longitude = ?");
	$stmt->bind_param("ss", $latitude, $longitude);  
	$stmt ->execute();
	$stmt ->bind_result($id, $state, $address, $img_urls);

	$response = array();

	if($stmt ->fetch()) {
		$response["id"] = $id;
		$response["state"] = $state;
		$response["address"] = $address;
		$response["img_urls"] = $img_urls;

		echo json_encode($response);
	}
	else {
		echo "fail";
	}

	mysqli_close($conn);
?>