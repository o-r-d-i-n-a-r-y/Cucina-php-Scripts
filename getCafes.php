<?php
	include('connection.php');

	$user_city = $_POST['user_city'];

	$stmt = $conn->prepare("SELECT latitude, longitude, state FROM cafes WHERE city = ? AND state != 0");
	$stmt->bind_param("s", $user_city);  
	$stmt ->execute();
	$stmt ->bind_result($latitude, $longitude, $state);

	$cafes = array();

	while($stmt ->fetch()) {
		$temp = array();

		$temp["latitude"] = $latitude;
		$temp["longitude"] = $longitude;
		$temp["state"] = $state;

		array_push($cafes,$temp);
	}
	
	echo json_encode($cafes);

	mysqli_close($conn);
?>