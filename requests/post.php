<?php
header('Content-type: application/json');

require("../include/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	if(!empty($_FILES)) {
		if(validateCSV($_FILES["file"]) == false) {
			$response["error"] = true;
			$response["displayMsg"] = "Hatalı dosya.";
			die(json_encode($response));
		}
		$string = file($_FILES["file"]["tmp_name"]);
		$array = csvToArray($string); // csv dosyasını array olarak çıkartır
		$employees = removeDuplicatedRecord($array,array('employee_id','email','phone')); //verilen keylerde tekrar eden kayıtları çıkartır
		
		
		$campaign[0]["campaign_name"] = $_POST["campaign_name"];
		$campaign[0]["campaign_period_id"] = $_POST["campaign_period_id"];
		$campaign[0]["campaign_status"] =  1;
		
		
		$insert_campaign = insert("campaigns",$campaign);
		
		
		$insert_employee_sql = insert("employee",$employees);
		$response["inserted"] = $insert_employee_sql;
		
		$response["error"] = false;
		$response["displayMsg"] = "İşlem tamamlandı.";
	}
} else {
	http_response_code(405);
	die();
	//$response["method"] = $_SERVER['REQUEST_METHOD'];
}
echo(json_encode($response));
?>
