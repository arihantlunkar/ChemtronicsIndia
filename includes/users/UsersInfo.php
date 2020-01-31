<?php
require_once dirname(__DIR__) .'/db/DBController.php';

class UsersInfo extends DBController
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getJsonData()
	{
		$sqlQuery = "SELECT firstName, lastName, countryCode, mobileNumber, endUser, email FROM users";
		$result = $this->conn->query($sqlQuery);		

		$rows = array();
		if($result)
		{
			while($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}			
		}	
		
		$json_data = array(
			"data" => $rows   // total data array
		);
		
		return json_encode($json_data);		
	}
}

?>