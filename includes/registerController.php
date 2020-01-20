<?php
require_once 'config/db.php';
require_once 'emailController.php';

$data = json_decode(file_get_contents('php://input'), true);
$msg = ""; 

if($data)
{
	$firstname = $data['firstname'];
	$lastname = $data['lastname'];
	$companyName = '';
	$email = $data['email'];
	$cc = $data['cc'];
	$mobile = $data['mobile'];
	$password = $data['password'];
	$userProfile = $data['userProfile'];

	$token = bin2hex(random_bytes(50));
	$password = password_hash($password, PASSWORD_DEFAULT); //encrypt password

	$emailVerified = 0;
	$mobileVerified = 0;

	$sqlQuery = "SELECT * FROM users WHERE email='$email' LIMIT 1";
	$result = $conn->query($sqlQuery);

	if($result)
	{
		if ($result->num_rows > 0)
		{
			$msg = "That username is taken. Try another.";
		}
		else 
		{
			$sqlQuery = "INSERT INTO `users`(`firstName`, `lastName`, `companyName`, `countryCode`, `mobileNumber`, `endUser`, `email`, `token`, `password`, `emailVerified`, `mobileVerified`) VALUES ('$firstname', '$lastname', '$companyName', '$cc', '$mobile', '$userProfile', '$email', '$token', '$password', '$emailVerified', '$mobileVerified')";
			
			$result = $conn->query($sqlQuery);

			if ($result) 
			{			
				$username = $firstname." ".$lastname;
				$complete_link = VERIFICATION_LINK. "?token=".$token;
				if(sendVerificationEmail(FROM_EMAIL_ADDRESS, $email, $username, $complete_link))
				{		
					$msg = "Thank you for registering with Chemtronics India. In order to complete your registration, please click the confirmation link in the email that we have sent to you.";
				}
				else
				{
					$msg = "Sending verification email failed.";
				}
			} else 
			{
				$msg = "Database error: Could not register user.";
			}
		}
	}
	else
	{
		$msg = "Database error: Could not register user.";
	}
}

$conn->close();

echo $msg;