<?php
require_once 'Application.php';

abstract class AirSolution extends Application
{
	protected function calculateModelNo($fValue)
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
}

?>