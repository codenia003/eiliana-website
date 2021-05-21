<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
	$email = $request->email;
    $id = $request->id;
    // $device_id = $request->device_id;
	//echo $id;die;

	$date = date('Y-m-d H:i:s');
	$user = '';

	$sql = $conn->query("SELECT * FROM customers WHERE user_id = $id AND email = '".$email."' ");

	if (mysqli_num_rows($sql) == 1) {
		$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		$id = $row['id'];

		$conn->query("UPDATE customers SET updated_at = '$date' WHERE id = '$id'");
		$user = $row;
		$status = 'success';
		$message = 'Login successful';
			
		
	} else {
		//echo "INSERT INTO customers(user_id, `name`, email, photo, `type`)VALUES('".$id."', '".$request->displayName."', '".$request->email."', '".$request->photoUrl."', '".$request->type."')";die;
		$conn->query("INSERT INTO customers(user_id, `name`, email, photo, `type`)VALUES('".$id."', '".$request->displayName."', '".$request->email."', '".$request->photoUrl."', '".$request->type."')");
		$sql = $conn->query("SELECT * FROM customers WHERE user_id = $id AND email = '".$email."' ");
		$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		$user = $row;

		$status = 'success';
		$message = 'Login successful';
	}

	echo json_encode([
	'status' => $status,
	'message' => $message,
	'user' => $user
	]);
	
}