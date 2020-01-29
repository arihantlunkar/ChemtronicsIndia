<?php
require_once dirname(__DIR__).'/config/constants.php';

class DBController
{
	protected $conn;
	
	public function __construct()
	{
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if ($this->conn->connect_error) {
			die("Database connection failed: " . $this->conn->connect_error);
		}
	}
	
	public function __destruct()
	{
		$this->conn->close();
	}
}

?>