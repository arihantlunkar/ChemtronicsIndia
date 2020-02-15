<?php
require_once 'Utility.php';
require_once 'Application.php';
require_once 'ApplicationInterface.php';

class CommericalKitchen extends Application implements ApplicationInterface 
{
    public function calculateMultiplicationFactor($fCT, $strEspVal = "")
	{
		if($fCT >= 7)
		{
			$this->fMF = 0.08;
		}
		else if ($fCT >= 6.5 && $fCT <= 6.9)
		{
			$this->fMF = 0.09;
		}
		else if ($fCT >= 6.0 && $fCT <= 6.4)
		{
			$this->fMF = 0.10;
		}
		else if ($fCT >= 5.5 && $fCT <= 5.9)
		{
			$this->fMF = 0.12;
		}
		else if ($fCT >= 5.0 && $fCT <= 5.4)
		{
			$this->fMF = 0.15;
		}	
		if(strcasecmp($strEspVal, "No") == 0 && $this->fMF != -1)
		{
			$this->fMF *= 1.25;
		}
	}

	public function calculateModelNo($fValue)
	{	
		$strPrefix = "";
		$strPostfix = "";
		if($fValue >= 0 && $fValue <= 2000)
		{
			$strPrefix = "EXO";
		}
		else if($fValue >= 2001 && $fValue <= 17200)
		{
			$strPrefix = "EXO-OXY";
		}
		
		if($fValue <= 290)
		{
			$strPostfix = "-25";
		}
		else if($fValue >= 291 && $fValue <= 570)
		{
			$strPostfix = "-50";
		}
		else if($fValue >= 571 && $fValue <= 1150)
		{
			$strPostfix = "-100";
		}
		else if($fValue >= 1151 && $fValue <= 1725)
		{
			$strPostfix = "-150";
		}
		else if($fValue >= 1726 && $fValue <= 2000)
		{
			$strPostfix = "-200";
		}
		else if($fValue >= 2001 && $fValue <= 2299)
		{
			$strPostfix = "-200";
		}
		else if($fValue >= 2300 && $fValue <= 4500)
		{
			$strPostfix = "-300";
		}
		else if($fValue >= 4501 && $fValue <= 6500)
		{
			$strPostfix = "-500";
		}
		else if($fValue >= 6501 && $fValue <= 7999)
		{
			$strPostfix = "-700";
		} 
		else if($fValue >= 8000 && $fValue <= 11500)
		{
			$strPostfix = "-1000";
		}
		else if($fValue >= 11501 && $fValue <= 17200)
		{
			$strPostfix = "-1500";
		} 
		
		$this->strModelNo = $strPrefix.$strPostfix;
		
		if(strcmp($this->strModelNo, "") == 0)
		{
			$this->strModelNo = "No Model Found";
		}
		else
		{
			$this->strModelNo = "Model number is : " . $this->strModelNo;
		}
	}
	
	public function runFormula()
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
		
		$strEspVal = $req["espVal"];
		
		$fNumHoods = $nonReq["numHoods"];
		$strTypeCookingVal = $nonReq["typeCookingVal"];
		
		$fCT = round((($fLenExDuct*$fConversionLenExDuct)/($fExVel*$fConversionExVel)), 1);
		
		$this->calculateMultiplicationFactor($fCT, $strEspVal);
		
		if($this->fMF != -1)
		{
			$fValue = $fFlowEA * $this->fMF * 3.57;
			
			$this->calculateModelNo($fValue);
		}
	}
	
	public function printModelNo()
	{		
		return $this->fMF != -1 ? $this->strModelNo : "Treatment time is not sufficient, you may have to increase exhaust duct length or reduce exhaust air velocity by increasing exhaust duct cross section area or both. Click Here for “Design Criteria” for best results. You can also contact solution provider on solution@chemtronicsindia.com";
	}
}

?>