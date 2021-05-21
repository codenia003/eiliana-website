<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id = $request->id;
    // $device_id = $request->device_id;
	//echo $id;die;

	$date = date('Y-m-d H:i:s');
	$user = '';

	$sql = $conn->query("SELECT * FROM rates WHERE user_id = $id ");

	if (mysqli_num_rows($sql) == 1) {
		$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		$id = $row['id'];

		$conn->query("UPDATE rates SET updated_at = '$date', rate = ".$request->rate." WHERE id = '$id'");
		$user = $row;
		$status = 'success';
		$message = 'Rate submitted successful';
			
		
	} else {
		//echo "INSERT INTO rates(`user_id`, `rate`, `message`)VALUES(".$id.", ".$request->rate.", '".$request->message."') ";die;
		$conn->query("INSERT INTO rates(`user_id`, `rate`, `message`)VALUES(".$id.", ".$request->rate.", '".$request->message."') ");
		$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		$user = $row;

		$status = 'success';
		$message = 'Rate submitted successful';
	}

	echo json_encode(['status' => $status, 'message' => $message]);
	
}