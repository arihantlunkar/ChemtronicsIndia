<?php
require_once 'Utility.php';
require_once 'AirSolution.php';
require_once 'ApplicationInterface.php';

class STP extends AirSolution implements ApplicationInterface 
{
    function calculateMultiplicationFactor($fCT)
	{
		if($fCT >= 6)
		{
			$this->fMF = 0.08;
		}
		else if ($fCT >= 5.5 && $fCT <= 5.9)
		{
			$this->fMF = 0.10;
		}
		else if ($fCT >= 5.0 && $fCT <= 5.4)
		{
			$this->fMF = 0.12;
		}
		else if ($fCT >= 4.5 && $fCT <= 4.9)
		{
			$this->fMF = 0.15;
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
			
			$this->calculateModelNo($fValue);
		}
	}
	
	function printModelNo()
	{		
		return $this->fMF != -1 ? $this->strModelNo : "Treatment time is not sufficient, you may have to increase exhaust duct length or reduce exhaust air velocity by increasing exhaust duct cross section area or both. Click Here for “Design Criteria” for best results. You can also contact solution provider on solution@chemtronicsindia.com";
	}
}

?>