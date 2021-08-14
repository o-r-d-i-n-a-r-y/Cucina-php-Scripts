<?php
	include('connection.php');

	$current_date = date("d.m.Y");
	$user_city = $_POST['city'];

	$stmt = $conn->prepare("SELECT type, header, content, img_url, end_date FROM events WHERE city = '".$user_city."' OR city = 'all'");

	$stmt ->execute();
	$stmt ->bind_result($type, $header, $content, $img_url, $end_date);

	$events = array();

	while($stmt ->fetch()) {
		if(strtotime($current_date) < strtotime($end_date)) {
			$temp = array();

			$temp["type"] = $type;
			$temp["header"] = $header;
			$temp["content"] = $content;
			$temp["img_url"] = $img_url;
			$temp["end_date"] = $end_date;

			array_push($events,$temp);
		}
	}

	echo json_encode($events);

	mysqli_close($conn);
?>