<?php
require_once 'config/secure.php';
require_once 'session/Logout.php';
require_once 'session/Login.php';
require_once 'session/Register.php';

if(isset($_GET['session']))
{
	if(strcmp($_GET['session'], "login") == 0)
	{
		$obj = new Login();
		$obj->run();
		echo $obj->printMsg();
	}
	else if(strcmp($_GET['session'], "logout") == 0)
	{
		(new Logout())->run();
	}
	else if(strcmp($_GET['session'], "register") == 0)
	{
		$obj = new Register();
		$obj->run();
		echo $obj->printMsg();
	}
}

?>