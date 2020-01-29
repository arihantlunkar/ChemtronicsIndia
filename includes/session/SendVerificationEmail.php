<?php

class SendVerificationEmail
{
	public static function send($from_email, $to_email, $username, $link)
	{
		$subject = "[Chemtronics India] Please verify your device";
		$body = 
			'
			<!DOCTYPE html>
			<html lang="en">

			<head>
			  <meta charset="UTF-8">
			</head>

			<body>
			  <div>
				<p>Hi '.$username.',</p>
				<p>Thank you for registering to Chemtronics India. Please <a href="'.$link.'">click here</a> to verify your account.</p>        
			  </div>
			</body>
			
			</html>';
			
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' .$from_email. "\r\n".'Reply-To: ' .$to_email. "\r\n" .	'X-Mailer: PHP/' . phpversion();
		
		return mail($to_email, $subject, $body, $headers);
	}
}

?>