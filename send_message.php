<?php

require_once('./config.php');
require_once('./gcm.php');

if(isset($_GET["regId"]) && isset($_GET["message"])) {
	$reg_id = $_GET["regId"];
	$message = $_GET["message"];
	$registration_ids = array($reg_id);
	
	$message = array("message" => $message);
	
	$gcm = new GCM(GOOGLE_API_KEY);
	
	// @todo - Check if regId is in the database first...
	
	
	echo $gcm->send_notification($registration_ids, $message);
}

?>