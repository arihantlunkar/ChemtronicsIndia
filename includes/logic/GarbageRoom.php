<?php
require_once 'Utility.php';
require_once 'AirSolution.php';
require_once 'ApplicationInterface.php';

class GarbageRoom extends AirSolution implements ApplicationInterface 
{
	function runFormula()
	{
		$req = $this->tCalculationData["req"];		
		
		$fRoomArea = $req["wgwRA"];
		$strRoomAreaUnitVal = $req["wgwRAUnitVal"];
		$fConversionRoomArea = Utility::getConversionValue($strRoomAreaUnitVal);
		
		$fRoomHeight = $req["wgwRH"];
		$strRoomHeightUnitVal = $req["wgwRHUnitVal"];
		$fConversionRoomHeight = Utility::getConversionValue($strRoomHeightUnitVal);
			
		$this->fMF = 0.05;		
		
		$fValue = ($fRoomArea * $fConversionRoomArea) * ($fRoomHeight * $fConversionRoomHeight) * $this->fMF * 60;
			
		$this->calculateModelNo("Exhaust", $fValue);
	}
	
	function printModelNo()
	{		
		return $this->strModelNo;
	}
}

?>