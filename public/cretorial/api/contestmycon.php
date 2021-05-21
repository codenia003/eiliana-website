<?php
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $userid = $request->userid;
    $category = $request->category;
    $showtype = $request->showtype;

    $data = [];

    if($showtype == '1'){
        $result = $conn->query("SELECT * FROM contest WHERE category = '".$category."' AND user_id = '".$userid."'");

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            $status = 'success';
            $message = 'Contest loaded successfully';

        } else {
            $status = 'error';
            $message = 'No Contest found';
        }
    } else {
        $result = $conn->query("SELECT * FROM contest WHERE category = '".$category."'");

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            $status = 'success';
            $message = 'Contest loaded successfully';

        } else {
            $status = 'error';
            $message = 'No Contest found';
        }
    }
    
	echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
	
}