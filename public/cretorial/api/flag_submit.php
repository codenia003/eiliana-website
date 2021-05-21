<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    

	$date = date('Y-m-d H:i:s');
	$user = '';

	$sql = $conn->query("SELECT * FROM flagHelp WHERE user_id = $id ");

	if (mysqli_num_rows($sql) == 1) {
		$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		
		$conn->query("UPDATE flagHelp SET updated_at = '$date', help_type = ".$request->helpType.", message = '".$request->helpMessage."' WHERE user_id = ".$request->user_id." ");
		$user = $row;
		$status = 'success';
		$message = 'Data submitted successful';
			
		
	} else {
		//echo "INSERT INTO flagHelp(`user_id`, `card_id`, `help_type`, `message`)VALUES('".$request->user_id."', '".$request->card_id."', ".$request->helpType.", '".$request->helpMessage."') ";die;
		$conn->query("INSERT INTO flagHelp(`user_id`, `card_id`, `help_type`, `message`)VALUES('".$request->user_id."', '".$request->card_id."', ".$request->helpType.", '".$request->helpMessage."') ");
		$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		$user = $row;

		$status = 'success';
		$message = 'Data submitted successful';
	}

	echo json_encode(['status' => $status, 'message' => $message]);
	
}