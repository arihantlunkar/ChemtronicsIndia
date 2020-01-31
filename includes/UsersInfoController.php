<?php
require_once 'config/secure.php';
require_once 'users/UsersInfo.php';

echo (new UsersInfo())->getJsonData();

?>