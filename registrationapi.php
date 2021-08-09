<?php   
  require_once 'connection.php';  
  $response = array();  
  if(isset($_GET['apicall'])){  
  switch($_GET['apicall']){  
  case 'signup':  
    if(isTheseParametersAvailable(array('username','phone','city','password'))){  
    $username = $_POST['username'];   
    $phone = $_POST['phone'];   
    $city = $_POST['city'];
    $password = md5($_POST['password']);   
   
    $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");  
    $stmt->bind_param("s", $phone);  
    $stmt->execute();  
    $stmt->store_result();  
   
    if($stmt->num_rows > 0){  
        $response['error'] = true;  
        $response['message'] = '000';  
        $stmt->close();  
    }  
    else{  
        $stmt = $conn->prepare("INSERT INTO users (username, phone, city, password) VALUES (?, ?, ?, ?)");  
        $stmt->bind_param("ssss", $username, $phone, $city, $password);  
   
        if($stmt->execute()){  
            $stmt = $conn->prepare("SELECT id, id, username, phone, city FROM users WHERE username = ?");   
            $stmt->bind_param("s",$username);  
            $stmt->execute();  
            $stmt->bind_result($userid, $id, $username, $phone, $city);  
            $stmt->fetch();  
   
            $user = array(  
            'id'=>$id,   
            'username'=>$username,   
            'phone'=>$phone,  
            'city'=>$city  
            );  
   
            $stmt->close();  
   
            $response['error'] = false;   
            $response['message'] = '001';   
            $response['user'] = $user;   
        }  
    }  
}  
else{  
    $response['error'] = true;   
    $response['message'] = '010';   
}  
break;   
case 'login':  
  if(isTheseParametersAvailable(array('phone', 'password'))){  
    $phone = $_POST['phone'];  
    $password = md5($_POST['password']);   
   
    $stmt = $conn->prepare("SELECT id, username, phone, city FROM users WHERE phone = ? AND password = ?");  
    $stmt->bind_param("ss",$phone, $password);  
    $stmt->execute();  
    $stmt->store_result();  
    if($stmt->num_rows > 0){  
    $stmt->bind_result($id, $username, $phone, $city);  
    $stmt->fetch();  
    $user = array(  
    'id'=>$id,   
    'username'=>$username,   
    'phone'=>$phone,  
    'city'=>$city  
    );  
   
    $response['error'] = false;   
    $response['message'] = '10';   
    $response['user'] = $user;   
 }  
 else{  
    $response['error'] = true;   
    $response['message'] = '11';  
 }  
}  
break;   
default:   
 $response['error'] = true;   
 $response['message'] = 'Invalid Operation Called';  
}  
}  
else{  
 $response['error'] = true;   
 $response['message'] = 'Invalid API Call';  
}  
echo json_encode($response);  
function isTheseParametersAvailable($params){  
foreach($params as $param){  
 if(!isset($_POST[$param])){  
     return false;   
  }  
}  
return true;   
}  
?> 