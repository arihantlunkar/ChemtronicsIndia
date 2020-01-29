<?php
require_once dirname(__DIR__) .'/db/DBController.php';
require_once 'SessionInterface.php';

class Login extends DBController implements SessionInterface
{	
	private $data;
	
	private $msg;
	
	public function __construct()
	{
		parent::__construct();
		$this->data = json_decode(file_get_contents('php://input'), true);
		$this->msg = "";
	}
	
	public function printMsg()
	{
		return $this->msg;
	}
	
	public function run()
	{
		$email = $this->data['username'];
		$password = $this->data['password'];

		$sqlQuery = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = $this->conn->query($sqlQuery);

		if($result)
		{
			if ($result->num_rows > 0) 
			{
				$row = $result->fetch_assoc();
				
				if(!password_verify($password, $row['password']))
				{
					$this->msg = "Wrong password. Try again or click Forgot password to reset it.";
				}
				else if($row['emailVerified'] == 0)
				{
					$this->msg = "Email address is not verified.";
				}
				else
				{
					if (session_status() == PHP_SESSION_NONE) 
					{
						session_start();
					}
					
					$_SESSION['email'] = $row['email'];
					$_SESSION['username'] = $row['firstName']." ".$row['lastName'];
				}
			}
			else 
			{
				$this->msg = "Couldn't find your account.";
			}
		} 
		else 
		{
			$this->msg = "Database error: Login failed.";
		}
	}
}

?>