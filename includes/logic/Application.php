<?php

abstract class Application
{
	protected $tCalculationData;
	
	protected $strModelNo;
	
	protected $fMF;
	
	public function __construct($tCalculationData)
    {
        $this->tCalculationData = $tCalculationData;
		$this->strModelNo = "";		
		$this->fMF = -1;
		
		$this->runFormula();
    }
	
	abstract public function printModelNo();
	
	abstract public function runFormula();
}

?>