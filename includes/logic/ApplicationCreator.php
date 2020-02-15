<?php
require_once 'CommericalKitchen.php';
require_once 'STP.php';
require_once 'OWC.php';

class ApplicationCreator
{	
	private $strSolution;
	
	private $strType;
	
	private $strApplication;	
	
	private $jCalculationData;

	public function __construct()
	{
		$jData = json_decode(file_get_contents('php://input'), true);
		$jCustomerData = $jData["customerData"];
		
		$this->strSolution = $jCustomerData["CS"];
		$this->strType = $jCustomerData["CT"];
		$this->strApplication = $jCustomerData["CA"]["value"];
		$this->jCalculationData = $jCustomerData["calculationData"];

		$arrPurpose = $jCustomerData["purpose"]["value"];
		$strOtherPurpose = $jCustomerData["otherPurpose"]["value"];		
	}

	public function create()
	{			
		$objApplication = null;
		
		if(strcasecmp($this->strSolution, "Air") == 0 && strcasecmp($this->strType, "Exhaust") == 0)
		{
			if(strcasecmp($this->strApplication, "Commercial Kitchen") == 0)
			{
				$objApplication = new CommericalKitchen($this->jCalculationData);
			}
			else if(strcasecmp($this->strApplication, "STP") == 0)
			{
				$objApplication = new STP($this->jCalculationData);
			}
			else if(strcasecmp($this->strApplication, "OWC") == 0)
			{
				$objApplication = new OWC($this->jCalculationData);
			}
		}
		else
		{
			throw new Exception('Not implemented'); 
		}
		
		return $objApplication;
	}	
}

?>