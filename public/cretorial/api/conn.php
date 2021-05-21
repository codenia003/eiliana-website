<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

	date_default_timezone_set('UTC');
	
	$conn = new mysqli('localhost', 'root', '_Nr-VxBKn4-t+j9>', 'eiliana_creation');
	// $conn = new mysqli('localhost', 'billfair_admin', 'vQH=}@kXBheo%67', 'billfair_billfairy_dev');

	// define('FILE_UPLOAD_PATH', '/home/billfairy/public_html/uploads/');

?>	
