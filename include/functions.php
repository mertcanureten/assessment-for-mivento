<?php 
function csvToArray($string) {
	$csv = array_map('str_getcsv', $string);
	$header = explode(";",$csv[0][0]);
	unset($csv[0]);
	$data = [];

	foreach($csv as $row) {
		$item = explode(";",$row[0]);
		foreach($header as $key => $headeritem) {
			if($headeritem == "email") {
				$item[$key] = strtolower($item[$key]);
				if(isValidEmail($item[$key]) == false) {
					$data["failed_reason"] = "Invalid E-mail";
				}
			}
			if($headeritem == "phone") {
				$item[$key] = filterPhone($item[$key]);
			}
			$data[$headeritem] = $item[$key];
			if(isset($data["failed_reason"])) {
				$data["status"] = "failed";
			} else {
				$data["status"] = "success";
			}
		}
		$return[] = $data;
	}
	return($return);
}
function validateCSV($file) {
    if( !empty($file) ){
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if( empty($extension) || $extension != 'csv' ) {
			return(false);	
		} else {
			return(true);
		}
    } else {
		return(false);
	}
}
function isValidEmail($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return(false);
	} else {
		return(true);
	}
}
function filterPhone($number) {
	$new_number = preg_replace("/[^0-9.]/", "", $number); // numerik olmayan karakterleri siler
	if(substr($new_number,0,1) != 5) { // ilk karakter 5 değilse
		$new_number = substr($new_number,1); // ilk karakteri siler
	}
	return($new_number);
}
function removeDuplicatedRecord($array,$arrayKey) {
	foreach($arrayKey as $key) {
		$uniqueArray = array_unique(array_column($array, $key));
		$array = array_intersect_key($array, $uniqueArray);
	}
	return($array);
}
function db() {
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "mivento_assesment";
	$mysqli = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database);
	return($mysqli);
}
function query($sql) {
	$mysqli = db();
	$sql = $mysqli->query($sql); //sqli çalıştırır
	if(!$sql) { // eğer sql hatalıysa
		$response = $mysqli->error;
	} else {
		$response = $sql;
	}
	return($response);
}
function insert($table,&$fields){
    $col = "INSERT INTO $table (`".implode("` , `",array_keys(end($fields)))."`) ";
    $val = " VALUES ('";		
    foreach($fields as $key => $row) { 
		foreach($row as $row_key => $value) {
			$row_fields[$row_key] = $value;
		}
    $values = implode("' , '",array_values($row_fields));		
	$sql = $col.$val.$values."');";
	$response[] = query($sql);
    }
	return($response);
}
function select($query){   
	$data = array();
	$result = query($query);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
	   $data[] = $row;
	}
	return $data;	
}
function escape($value) {
    $return = '';
    for($i = 0; $i < strlen($value); ++$i) {
        $char = $value[$i];
        $ord = ord($char);
        if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
            $return .= $char;
        else
            $return .= '\\x' . dechex($ord);
    }
    return $return;
}
?>