<?php

function verifyToken($token)
{
	require_once 'config/db.php';

	$sqlQuery = "SELECT * FROM users WHERE token='$token' LIMIT 1";
	$result = $conn->query($sqlQuery);
	
	if($result)
	{
		if ($result->num_rows > 0) 
		{
			$row = $result->fetch_assoc();
			
			if($row['emailVerified'] == 0)
			{
				$sqlQuery = "UPDATE users SET emailVerified=1 WHERE token='$token'";
				$result = $conn->query($sqlQuery);	
			}			
		}
	}
	
	$conn->close();
}

?>

