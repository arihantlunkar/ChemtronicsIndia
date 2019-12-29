<?php
require_once 'config/constants.php';
require_once 'config/db.php';

session_start();

function sendVerificationEmail($userEmail, $token)
{
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Thank you for signing up on Chemtronics India. Please click on the link below to verify your account:</p>
        <a href="http://localhost/ChemtronicsIndia/index.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>

    </html>';
	
	$subject = 'Verify your email';
	$message = $body;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: ' .EMAIL. "\r\n".
		'Reply-To: ' .$userEmail. "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	mail($userEmail, $subject, $message, $headers);
}

function verifyEmail($token)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = $user['verified'];
            $_SESSION['message'] = "Your email address has been verified successfully";
            $_SESSION['type'] = 'alert-success';
            header('location: index.php');
            exit(0);
        }
    } else {
        echo "User not found!";
    }
}
