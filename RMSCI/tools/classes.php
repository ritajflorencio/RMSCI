<?php


class CR{
	
	public $x = "";
	public $y = "";
	
	public $bodyPart = "";
	public $seriesDescription = "";
	public $equipmentModel = "";


	function __construct($x, $y, $bodyPart, $seriesDescription, $equipmentModel) {
		
		$this->x = $x;
		$this->y = $y;
		$this->bodyPart = $bodyPart;
		$this->seriesDescription = $seriesDescription;
		$this->equipmentModel = $equipmentModel;
	}
}



class CT {
	
	public $x = "";
	public $y = "";
	public $bodyPart = "";
	public $equipmentModel = "";


	function __construct($x, $y, $bodyPart, $equipmentModel) {
		
		$this->x = $x;
		
		$this->y = $y;
		
		$this->bodyPart = $bodyPart;
		$this->equipmentModel = $equipmentModel;
	}
}



class organDose {
	public $x = "";
	public $y = "";
	public $sliceThickness_cm = "";
	public $equipmentModel = "";


	function __construct($x, $y, $sliceThickness_cm, $equipmentModel) {
		
		$this->x = $x;
		
		$this->y = $y;
		$this->sliceThickness_cm = $sliceThickness_cm;
		$this->equipmentModel = $equipmentModel;
	}
}

class MG {
	public $x = "";
	public $y = "";
	public $equipmentModel = "";


	function __construct($x, $y,$equipmentModel) {
		
		$this->x = $x;
		
		$this->y = $y;
		$this->equipmentModel = $equipmentModel;
	}
}

?>