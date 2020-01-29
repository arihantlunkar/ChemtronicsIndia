<?php
require_once dirname(__DIR__).'/db/DBController.php';
require_once 'SessionInterface.php';

class VerifyToken extends DBController implements SessionInterface
{	
	private $token;
	
	public function __construct($token)
	{
		parent::__construct();
		$this->token = $token;
	}

	public function run()
	{
		$sqlQuery = "SELECT * FROM users WHERE token='$this->token' LIMIT 1";
		$result = $this->conn->query($sqlQuery);
		
		if($result)
		{
			if ($result->num_rows > 0) 
			{
				$row = $result->fetch_assoc();
				
				if($row['emailVerified'] == 0)
				{
					$sqlQuery = "UPDATE users SET emailVerified=1 WHERE token='$this->token'";
					$result = $this->conn->query($sqlQuery);	
				}			
			}
		}
	}
}

?>