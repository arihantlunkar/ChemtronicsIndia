<?php
require_once dirname(__DIR__) .'/db/DBController.php';
require_once 'SessionInterface.php';
require_once 'SendVerificationEmail.php';

class Register extends DBController implements SessionInterface
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
		$firstname = $this->data['firstname'];
		$lastname = $this->data['lastname'];
		$companyName = '';
		$email = $this->data['email'];
		$cc = $this->data['cc'];
		$mobile = $this->data['mobile'];
		$password = $this->data['password'];
		$userProfile = $this->data['userProfile'];

		$token = bin2hex(random_bytes(50));
		$password = password_hash($password, PASSWORD_DEFAULT); //encrypt password

		$emailVerified = 0;
		$mobileVerified = 0;

		$sqlQuery = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = $this->conn->query($sqlQuery);

		if($result)
		{
			if ($result->num_rows > 0)
			{
				$this->msg = "That username is taken. Try another.";
			}
			else 
			{
				$sqlQuery = "INSERT INTO `users`(`firstName`, `lastName`, `companyName`, `countryCode`, `mobileNumber`, `endUser`, `email`, `token`, `password`, `emailVerified`, `mobileVerified`) VALUES ('$firstname', '$lastname', '$companyName', '$cc', '$mobile', '$userProfile', '$email', '$token', '$password', '$emailVerified', '$mobileVerified')";
				
				$result = $this->conn->query($sqlQuery);

				if ($result) 
				{			
					$username = $firstname." ".$lastname;
					$complete_link = VERIFICATION_LINK. "?token=".$token;
					if(SendVerificationEmail::send(FROM_EMAIL_ADDRESS, $email, $username, $complete_link))
					{		
						$this->msg = "Thank you for registering with Chemtronics India. In order to complete your registration, please click the confirmation link in the email that we have sent to you.";
					}
					else
					{
						$this->msg = "Sending verification email failed.";
					}
				} else 
				{
					$this->msg = "Database error: Could not register user.";
				}
			}
		}
		else
		{
			$this->msg = "Database error: Could not register user.";
		}
	}
}

?>