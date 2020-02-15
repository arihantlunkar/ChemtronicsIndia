<?php
require_once 'constants.php';

//No one should crawl website for more than 20 sec
set_time_limit(20);

//Turn off error reporting
error_reporting(0);

//Only ajax call allowed from chemtronics website
if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], HTTP_REFERER) !== false) 
{
	;
}
else
{
	die();
}