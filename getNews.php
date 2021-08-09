<?php

include('connection.php');

$current_date = date("d.m.Y");

$stmt = $conn->prepare("SELECT type, header, content, img_url, city, end_date FROM events");

$stmt ->execute();
$stmt ->bind_result($type, $header, $content, $img_url, $city, $end_date);

$events = array();

while($stmt ->fetch()) {
	if(strtotime($current_date) < strtotime($end_date)) {
		$temp = array();

		$temp["type"] = $type;
		$temp["header"] = $header;
		$temp["content"] = $content;
		$temp["img_url"] = $img_url;
		$temp["city"] = $city;
		$temp["end_date"] = $end_date;

		array_push($events,$temp);
	}
}

echo json_encode($events);
?>