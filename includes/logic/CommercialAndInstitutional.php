<?php
require_once 'Utility.php';
require_once 'AirSolution.php';
require_once 'ApplicationInterface.php';

class CommercialAndInstitutional extends AirSolution implements ApplicationInterface 
{
    function calculateMultiplicationFactor($strAirConditioning, $strApplicationType)
	{
		$fMF1 = 0;
		$fMF2 = 0;
				
		if(strcasecmp($strAirConditioning, "Central HVAC") == 0)
		{
			$fMF1 = 0.0020;
		}
		else if(strcasecmp($strAirConditioning, "Fan Coil Units [FCU]") == 0)
		{
			$fMF1 = 0.0010;
		}
		else if(strcasecmp($strAirConditioning, "Cassette") == 0 || strcasecmp($strAirConditioning, "Window / Split") == 0 || strcasecmp($strAirConditioning, "Column ACs") == 0)
		{
			$fMF1 = 0.0005;
		}
		
		if(strcasecmp($strApplicationType, "Offices") == 0 || strcasecmp($strApplicationType, "Banks") == 0 || strcasecmp($strApplicationType, "Corporate Bldgs") == 0 || strcasecmp($strApplicationType, "Commercial Places") == 0 || strcasecmp($strApplicationType, "Hotels") == 0 || strcasecmp($strApplicationType, "Resort") == 0 || strcasecmp($strApplicationType, "Board Room") == 0 || strcasecmp($strApplicationType, "School") == 0 || strcasecmp($strApplicationType, "Collages") == 0 || strcasecmp($strApplicationType, "Library") == 0 || strcasecmp($strApplicationType, "Day care") == 0 || strcasecmp($strApplicationType, "Nursery") == 0 || strcasecmp($strApplicationType, "Creche") == 0)
		{
			$fMF2 = 0.002;
		}
		else if(strcasecmp($strApplicationType, "Auditorium") == 0 || strcasecmp($strApplicationType, "Conference Hall") == 0 || strcasecmp($strApplicationType, "Indoor Stadium") == 0 || strcasecmp($strApplicationType, "Hospital") == 0 || strcasecmp($strApplicationType, "Healthcare") == 0 || strcasecmp($strApplicationType, "Gym") == 0 || strcasecmp($strApplicationType, "Sports Club") == 0 || strcasecmp($strApplicationType, "Cold Storage") == 0 || strcasecmp($strApplicationType, "Airport") == 0 || strcasecmp($strApplicationType, "Mall") == 0 || strcasecmp($strApplicationType, "Theater") == 0 || strcasecmp($strApplicationType, "Restaurants") == 0 || strcasecmp($strApplicationType, "Casino") == 0 || strcasecmp($strApplicationType, "Pub") == 0 || strcasecmp($strApplicationType, "Pharmaceutical") == 0 || strcasecmp($strApplicationType, "API") == 0 || strcasecmp($strApplicationType, "Food & Beverage") == 0 || strcasecmp($strApplicationType, "Bakery") == 0 || strcasecmp($strApplicationType, "Dairy") == 0 || strcasecmp($strApplicationType, "Confectionary") == 0 || strcasecmp($strApplicationType, "Chocolate") == 0 || strcasecmp($strApplicationType, "Toothpaste") == 0 || strcasecmp($strApplicationType, "Aquaculture") == 0 || strcasecmp($strApplicationType, "Pet food") == 0 || strcasecmp($strApplicationType, "Nutritional Food") == 0 || strcasecmp($strApplicationType, "Warehouse") == 0)
		{
			$fMF2 = 0.003;
		}
		else if(strcasecmp($strApplicationType, "Fire restoration") == 0 || strcasecmp($strApplicationType, "Fish Market") == 0 || strcasecmp($strApplicationType, "Slaughter House") == 0)
		{
			$fMF2 = 0.02;
		}
		else if(strcasecmp($strApplicationType, "Smoking Lounge") == 0 || strcasecmp($strApplicationType, "Butchery") == 0 || strcasecmp($strApplicationType, "Change rooms") == 0 || strcasecmp($strApplicationType, "Washrooms") == 0 || strcasecmp($strApplicationType, "Warehouse") == 0)
		{
			$fMF2 = 0.005;
		}
		else if(strcasecmp($strApplicationType, "Ethylene Control") == 0)
		{
			$fMF2 = 0.01;
		}
		else if(strcasecmp($strApplicationType, "Mortuary") == 0)
		{
			$fMF2 = 0.05;
		}
		else if(strcasecmp($strApplicationType, "Garbage Rooms") == 0)
		{
			$fMF2 = 0.03;
		}
		else if(strcasecmp($strApplicationType, "Garbage Shoots") == 0)
		{
			$fMF2 = 0.04;
		}		
		
		$this->fMF = $fMF1 + $fMF2;
	}
	
	function getApplicationType()
	{
		$strApplication = $this->tCalculationData["CA"]["value"];			

		$strApplicationType = "";
		if(strcasecmp($strApplication, "Commercial | Institutional") == 0)
		{
			$strApplicationType = $this->tCalculationData["CACTValue"];
		}
		else if(strcasecmp($strApplication, "Manufacturing Company") == 0)
		{
			$strApplicationType = $this->tCalculationData["CAMTValue"];
		}
		return $strApplicationType;
	}

	function runFormula()
	{
		$req = $this->tCalculationData["calculationData"]["req"];
		
		$fRoomArea = $req["cmRA"];
		$strRoomAreaUnitVal = $req["cmRAUnitVal"];
		$fConversionRoomArea = Utility::getConversionValue($strRoomAreaUnitVal);
		
		$fRoomHeight = $req["cmRH"];
		$strRoomHeightUnitVal = $req["cmRHUnitVal"];
		$fConversionRoomHeight = Utility::getConversionValue($strRoomHeightUnitVal);			
		
		$this->calculateMultiplicationFactor($this->tCalculationData["CACValue"], $this->getApplicationType());		
		
		$fValue = ($fRoomArea * $fConversionRoomArea) * ($fRoomHeight * $fConversionRoomHeight) * $this->fMF * 21;
			
		$this->calculateModelNo("Indoor", $fValue);
	}
	
	function printModelNo()
	{		
		return $this->strModelNo;
	}
}

?>