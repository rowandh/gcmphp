<?php

require_once('config.php');
require_once('db.php');

$db = new DB_Adapter(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//var_dump($db->create_user("Harry", "Test", "1234"));

$users = $db->get_all_users();
var_dump($users);




?>