<?php
// Quick and dirty DB adapter
// Don't use in production!
// Unsecure (no prepared statements etc...)

class DB_Adapter {

	private $host;
	private $user;
	private $password;
	private $database;
	private $mysqli;
	
	public function __construct($host, $user, $password, $database) {
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
		return $this->connect();
	}
	
	public function connect() {
		$this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
		return $this->mysqli;
	}
	
	public function create_user($name, $email, $gcm_regid) {
		$con = $this->mysqli;
		$query = "INSERT INTO gcm_users(name, email, gcm_regid, created_at) VALUES('$name', '$email', '$gcm_regid', NOW())";
		
		$result = $con->query($query); // Returns true if successful
		
		if($result) {
			return $this->get_user_by_id($con->insert_id);
		} else {
			return false;
		}
	}
	
	public function get_user($email) {
		$query = "SELECT * from gcm_users WHERE email = '$email'";
		return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
	}
	
	public function get_user_by_id($id) {
		$query = "SELECT * from gcm_users WHERE id = '$id'";
		return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
	}
	
	public function get_all_users() {
		$query = "SELECT * from gcm_users";
		return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);;
	}
	
	public function close() {
		return $this->mysqli->close();
	}
}

?>