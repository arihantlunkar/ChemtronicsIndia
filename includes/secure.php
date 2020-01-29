<?php

//No one should crawl website for more than 20 sec
set_time_limit(20);

//Turn off error reporting
error_reporting(0);

//If right developer key is defined somewhere in the page
if (defined('DEVELOPER_KEY') && strcasecmp(DEVELOPER_KEY, "dqnBKK-?3gq4^Nk+") == 0) 
{
	;
} 
else
{
	//Only ajax call allowed from chemtronics website
	if(isset($_SERVER["HTTP_REFERER"]) && strcmp($_SERVER["HTTP_REFERER"], "http://localhost/ChemtronicsIndia/home.php") == 0) 
	{
		;
	}
	else
	{
		die();
	}
}