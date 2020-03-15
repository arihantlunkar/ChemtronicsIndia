<?php
require_once 'config/secure.php';
require_once 'logic/Utility.php';

$path = "";

$jData = json_decode(file_get_contents('php://input'), true);
$jCustomerData = $jData["customerData"];

$strSolution = $jCustomerData["CS"];
$strType = $jCustomerData["CT"];
$strApplication = $jCustomerData["CA"]["value"];
$strFinalModelNum = $jCustomerData["finalModelNum"];

if(strcasecmp($strSolution, "Air") == 0 && strcasecmp($strType, "Exhaust") == 0)
{
	if(strcasecmp($strApplication, "Commercial Kitchen") == 0)
	{
		$path = "./assets/resources/BOQ-KitchenExhaustApplication/".$strFinalModelNum.".pdf";
	}
	else if(strcasecmp($strApplication, "STP") == 0)
	{
		$path = "./assets/resources/BOQ-STPExhaustApplication/".$strFinalModelNum.".pdf";
	}
	else if(strcasecmp($strApplication, "OWC") == 0)
	{
		$path = "./assets/resources/BOQ-OWCExhaustApplication/".$strFinalModelNum.".pdf";
	}
}

echo $path;