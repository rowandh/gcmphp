<?php

// Receives a request from the Android device and creates a new user
require_once('./config.php');
require_once('./db.php');
require_once('./gcm.php');

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["regId"])) {
	$name = $_POST["username"];
	$email = $_POST["email"];
	$gcm_regid = $_POST["regId"];
	$gcm = new GCM(GOOGLE_API_KEY);
	$result = "";
	
	$db = new DB_Adapter(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	if($db->create_user($name, $email, $gcm_regid)) {
		$result = $gcm->send_notification(array($gcm_regid), "Account created successfully");
	} else {
		$result = "Error creating user";
	}
	
	echo $result
	
} else {
	echo "Incorrect parameters";
}

?>