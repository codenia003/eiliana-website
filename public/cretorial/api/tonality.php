<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
   
	// echo "SELECT * FROM favorite WHERE user_id = '".$request->user_id."'";
    $sql = $conn->query("SELECT * FROM tonality WHERE language = '".$request->language."' ORDER BY name ASC");
    $row = array();
    // if (mysqli_num_rows($sql) == 1) {
        while ($data = $sql->fetch_assoc()) {
            $row[] = $data;
        }
    // }
    $status = 'success';
    $message = 'Data fetched successful';
    $data = $row;
	
	echo json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
	
}