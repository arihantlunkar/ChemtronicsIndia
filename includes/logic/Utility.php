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
			case "f2":
				$fConversion = 0.09290304;
				break;
			default:
				$fConversion = 1;
				break;
		}
		return $fConversion;
	}
	
	public static function debug_to_console($data) 
	{
		$output = $data;
		if (is_array($output))
			$output = implode(',', $output);

		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}
}

?>