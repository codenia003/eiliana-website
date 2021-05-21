<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
   
	switch($request->type){
		case "get":
			// echo "SELECT * FROM favorite WHERE user_id = '".$request->user_id."'";
			$sql = $conn->query("SELECT * FROM favorite WHERE user_id = '".$request->user_id."' ");
			$row = array();
			// if (mysqli_num_rows($sql) == 1) {
				while ($data = $sql->fetch_assoc()) {
					$row[] = $data;
				}
			// }
			$status = 'success';
			$message = 'Data fetched successful';
			$data = $row;
		break;
		case "save":
			//echo "SELECT * FROM favorite WHERE user_id = '".$request->user_id."' AND card_id = '".$request->card_id."' ";die;
			$sql = $conn->query("SELECT * FROM favorite WHERE user_id = '".$request->user_id."' AND card_id = '".$request->card_id."' ");
			if (mysqli_num_rows($sql) > 0) {
				$conn->query("DELETE FROM favorite WHERE user_id = '".$request->user_id."' AND card_id = '".$request->card_id."' ");	
			} else {
				$conn->query("INSERT INTO favorite(`user_id`, `card_id`)VALUES('".$request->user_id."', '".$request->card_id."') ");
			}
			$status = 'success';
			$message = 'Favorite submitted successful';
			$data = array();
		break;
	}
	
	echo json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
	
}