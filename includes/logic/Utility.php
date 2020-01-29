<?php

class Utility
{
	public static function getConversionValue($strUnit)
	{
		$fConversion = 1;
		switch($strUnit)
		{
			case "cmh":			
				$fConversion = 0.000278;
				break;
			case "ft":			
			case "fps":			
				$fConversion = 0.3048;
				break;
			case "fpm":	
			case "cfm":			
				$fConversion = 0.00508;
				break;
			case "mph":			
				$fConversion = 0.44704;
				break;
			default:
				$fConversion = 1;
				break;
		}
		return $fConversion;
	}
}

?>