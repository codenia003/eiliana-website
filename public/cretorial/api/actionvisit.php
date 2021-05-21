<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id = $request->userid;

	$date = date('Y-m-d H:i:s');
	$user = '';

    $sql = "INSERT INTO action_visit(user_id, action, action_name) VALUES (".$id.",'".$request->action."','".$request->action_name."')";

    if ($conn->query($sql) === TRUE) {
        $status = 'success';
        $message = 'Action submitted successful';
    } else {
        $status = 'error';
        $message = "Error: " . $sql . "<br>" . $conn->error; 
    }
    
	echo json_encode(['status' => $status, 'message' => $message]);
	
}