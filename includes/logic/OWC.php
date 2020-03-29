<?php
require_once 'Utility.php';
require_once 'AirSolution.php';
require_once 'ApplicationInterface.php';

class OWC extends AirSolution implements ApplicationInterface 
{
    function calculateMultiplicationFactor($fCT)
	{
		if($fCT >= 10.0)
		{
			$this->fMF = 1;
		}
		else if ($fCT >= 9.5 && $fCT <= 9.9)
		{
			$this->fMF = 1.2;
		}
		else if ($fCT >= 9.0 && $fCT <= 9.4)
		{
			$this->fMF = 1.4;
		}
		else if ($fCT >= 8.5 && $fCT <= 8.9)
		{
			$this->fMF = 1.5;
		}
		else if ($fCT >= 8.0 && $fCT <= 8.4)
		{
			$this->fMF = 1.8;
		}	
	}

	function runFormula()
	{
		$req = $this->tCalculationData["req"];		
		$nonReq = $this->tCalculationData["nonReq"];		
		
		$fFlowEA = $req["flowEA"];
		$strFlowEAUnitVal = $req["flowEAUnitVal"];
		$fConversionFlowEA = Utility::getConversionValue($strFlowEAUnitVal);
		
		$fLenExDuct = $req["lenExDuct"];
		$strLenExDuctUnitVal = $req["lenExDuctUnitVal"];
		$fConversionLenExDuct = Utility::getConversionValue($strLenExDuctUnitVal);
		
		$fExVel = $req["exVel"];
		$strExVelUnitVal = $req["exVelUnitVal"];
		$fConversionExVel = Utility::getConversionValue($strExVelUnitVal);
		
		$fCT = round((($fLenExDuct*$fConversionLenExDuct)/($fExVel*$fConversionExVel)), 1);
		
		$this->calculateMultiplicationFactor($fCT);		
		
		if($this->fMF != -1)
		{			
			$fValue = $fFlowEA * $this->fMF * 3.57;
			
			$this->calculateModelNo("Exhaust", $fValue);
		}
	}
	
	function printModelNo()
	{		
		return $this->fMF != -1 ? $this->strModelNo : "Treatment time is not sufficient, you may have to increase exhaust duct length or reduce exhaust air velocity by increasing exhaust duct cross section area or both. Click Here for “Design Criteria” for best results. You can also contact solution provider on solution@chemtronicsindia.com";
	}
}

?>