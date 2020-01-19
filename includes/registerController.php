<?php
require_once 'config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

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

// Check if email already exists
$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $sql);

$msg = ""; 
if (mysqli_num_rows($result) > 0) {
	$msg = "Email already exists";
}
else {
	$query = "INSERT INTO users SET firstName=?, lastName=?, companyName=?, countryCode=?, mobileNumber=?, endUser=?, email=?, token=?, password=?, emailVerified=?, mobileVerified=?";
	
	$stmt = $conn->prepare($query);
	$stmt->bind_param('sssssssssii', $firstname , $lastname, $companyName, $cc, $mobile, $userProfile, $email, $token, $password, $emailVerified, $mobileVerified);
	
	$result = $stmt->execute();	
	$stmt->close();

	if ($result) {		
		$msg = "Thank you for registering with Chemtronics India. Before you can be given access to the website we need to verify your email.";
	} else {
		$msg = "Database error: Could not register user";
	}
}

echo $msg;