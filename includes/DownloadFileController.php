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

if(isset($_GET['task']) && strcasecmp($_GET['task'], "BOQ") == 0)
{
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
		else if(strcasecmp($strApplication, "Garbage Room") == 0)
		{
			$path = "./assets/resources/BOQ-GarbageExhaustApplication/".$strFinalModelNum.".pdf";
		}
		else if(strcasecmp($strApplication, "Waste Segregation Room") == 0)
		{
			$path = "./assets/resources/BOQ-WasteSegregationExhaustApplication/".$strFinalModelNum.".pdf";
		}
		else if(strcasecmp($strApplication, "Washroom") == 0)
		{
			$path = "./assets/resources/BOQ-WashroomExhaustApplication/".$strFinalModelNum.".pdf";
		}
	}
}
else if(isset($_GET['task']) && strcasecmp($_GET['task'], "TS") == 0)
{
	$path = "./assets/resources/TechnicalSpecifications/TS_".$strFinalModelNum.".pdf";
}

echo $path;