<?php

abstract class Application
{
	public $tCalculationData;
	
	public $strModelNo;
	
	public $fMF;
	
	public function __construct($tCalculationData)
    {
        $this->tCalculationData = $tCalculationData;
		$this->strModelNo = "";		
		$this->fMF = -1;
		
		$this->runFormula();
    }
	
	abstract public function runFormula();
	
	abstract public function calculateMultiplicationFactor($fCT); 	
}

?>