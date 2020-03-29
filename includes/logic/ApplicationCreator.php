<?php
require_once 'CommericalKitchen.php';
require_once 'STP.php';
require_once 'OWC.php';
require_once 'GarbageRoom.php';
require_once 'WasteSegregationRoom.php';
require_once 'Washroom.php';
require_once 'CommercialAndInstitutional.php';

class ApplicationCreator
{	
	private $strSolution;
	
	private $strType;
	
	private $strApplication;	
	
	private $jCalculationData;
	
	private $jCustomerData;

	public function __construct()
	{
		$jData = json_decode(file_get_contents('php://input'), true);
		$this->jCustomerData = $jData["customerData"];
		
		$this->strSolution = $this->jCustomerData["CS"];
		$this->strType = $this->jCustomerData["CT"];
		$this->strApplication = $this->jCustomerData["CA"]["value"];
		$this->jCalculationData = $this->jCustomerData["calculationData"];

		$arrPurpose = $this->jCustomerData["purpose"]["value"];
		$strOtherPurpose = $this->jCustomerData["otherPurpose"]["value"];		
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
			else if(strcasecmp($this->strApplication, "Garbage Room") == 0)
			{
				$objApplication = new GarbageRoom($this->jCalculationData);
			}
			else if(strcasecmp($this->strApplication, "Waste Segregation Room") == 0)
			{
				$objApplication = new WasteSegregationRoom($this->jCalculationData);
			}
			else if(strcasecmp($this->strApplication, "Washroom") == 0)
			{
				$objApplication = new Washroom($this->jCalculationData);
			}
		}
		else if(strcasecmp($this->strSolution, "Air") == 0 && strcasecmp($this->strType, "Indoor") == 0)
		{
			$objApplication = new CommercialAndInstitutional($this->jCustomerData);
		}
		else
		{
			throw new Exception('Not implemented'); 
		}
		
		return $objApplication;
	}	
}

?>