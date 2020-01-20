<?php

$data = json_decode(file_get_contents('php://input'), true);
$msg = ""; 

if($data)
{		
	require_once 'config/db.php';

	$email = $data['username'];
	$password = $data['password'];

	$sqlQuery = "SELECT * FROM users WHERE email='$email' LIMIT 1";
	$result = $conn->query($sqlQuery);

	if($result)
	{
		if ($result->num_rows > 0) 
		{
			$row = $result->fetch_assoc();
			
			if(!password_verify($password, $row['password']))
			{
				$msg = "Wrong password. Try again or click Forgot password to reset it.";
			}
			else if($row['emailVerified'] == 0)
			{
				$msg = "Email address is not verified.";
			}
			else
			{
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				
				$_SESSION['email'] = $row['email'];
				$_SESSION['username'] = $row['firstName']." ".$row['lastName'];
			}
		}
		else 
		{
			$msg = "Couldn't find your account.";
		}
	} 
	else 
	{
		$msg = "Database error: Login failed.";
	}

	$conn->close();
}

echo $msg;