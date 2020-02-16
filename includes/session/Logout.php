<?php
require_once 'SessionInterface.php';

class Logout implements SessionInterface
{
	public function run()
	{
		if (session_status() == PHP_SESSION_NONE) 
		{
			session_start();
		}

		session_destroy();
		
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		unset($_SESSION['isAdmin']);
		
		header("Location: ../index.php");
		exit(0);
	}
}

?>