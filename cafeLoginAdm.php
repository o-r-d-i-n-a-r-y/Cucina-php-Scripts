<?php
	require_once 'connection.php';
	$response = array();

	$id = $_POST['id'];  
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT id, state, address, img_urls FROM cafes WHERE id = ? AND password = ?");  
    $stmt->bind_param("ss", $id, $password);
    $stmt->execute();  
    $stmt->store_result();

    if($stmt->num_rows > 0) { 
		$stmt->bind_result($id, $state, $address, $img_urls);  
		$stmt->fetch();

		$cafe = array(
			'id'=>$id,
			'state'=>$state,
			'address'=>$address,
			'img_urls'=>$img_urls
		);
		
		$response['error'] = false;   
		$response['message'] = 'Login Successful';   
		$response['cafe'] = $cafe;   
 	}  
	else {  
		$response['error'] = true;   
		$response['message'] = 'Invalid data, login failed';  
	}

	echo json_encode($response);

    // test commit
?>
