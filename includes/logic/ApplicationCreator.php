<?php
require_once 'CommericalKitchen.php';

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
		
		if(strcasecmp($this->strSolution, "Air") == 0 && strcasecmp($this->strType, "Exhaust") == 0 && strcasecmp($this->strApplication, "Commercial Kitchen") == 0)
		{
			$objApplication = new CommericalKitchen($this->jCalculationData);
		}
		else
		{
			throw new Exception('Not implemented'); 
		}
		
		return $objApplication;
	}	
}

?>