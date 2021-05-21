<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    

	$conn->query("INSERT INTO wizards(`user_id`, `tags`, `feel_tags`,`concept_tags`,`image`)VALUES('".$request->user_id."', '".$request->tags."', '".$request->feelTags."', '".$request->conceptTags."', '".$request->image."') ");

	$status = 'success';
	$message = 'Wizard submitted successful';
	

	echo json_encode(['status' => $status, 'message' => $message]);
	
}