<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

session_destroy();
unset($_SESSION['username']);
unset($_SESSION['email']);
header("Location: ../index.php");
exit(0);
?>