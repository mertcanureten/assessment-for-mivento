<?php 
header('Content-type: application/json');
require("../include/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	
	switch ($_GET['request']) {
		case 'getPeriods':
			$response = select("SELECT * FROM `periods` WHERE `period_status` = 1");
			break;
		case 'getEmployee':
			$response = select("SELECT * FROM `employee` WHERE `status` = 'success'");
			break;
	}
} else {
	http_response_code(405);
	die();
}
echo(json_encode($response));

?>