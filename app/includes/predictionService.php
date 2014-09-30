<?php
error_reporting(~0);
ini_set('display_errors', 1);

class predictionService {

	protected $json;
	protected $newJSON;
	protected $direction;
	protected $routeTitle;
	protected $predictions;

	public function __construct(){
		$this->json='';
		$this->newJSON='';
		$this->direction='';
		$this->predictions='';
	}

	public function setJSON($val){
		$this->json=$val;
	}

	public function setNewJSON($val){
		$this->newJSON=$val;
	}

	public function setDirection($val){
		$this->direction=$val;
	}

	public function setRouteTitle($val){
		$this->routeTitle=$val;
	}

	public function setPredictions($val){
		$this->predictions=$val;
	}

	public function getJSON(){
		return $this->json;
	}

	public function getNewJSON(){
		return $this->newJSON;
	}

	public function getDirection(){
		return $this->direction;
	}

	public function getRouteTitle(){
		return $this->routeTitle;
	}

	public function getPredictions(){
		return $this->predictions;
	}

	public function createPredictionJSON(){
		$json = $this->getJSON();
		$decodedJSON = json_decode($json,true);
		$newJSON = $decodedJSON['predictions'];	
		$this->setNewJSON($newJSON);	
	}

	public function getPredictionJSON(){
		$newJSON = $this->getNewJSON();
		$direction = $this->getDirection();
		$routeTitle = $this->getRouteTitle();
		$newJSONString = '';

		for($i=0; $i<count($newJSON); $i++){ 
			if($newJSON[$i]['attributes']['routeTitle']===$routeTitle){
				$newJSONString = $newJSON[$i]['direction']['prediction'];
				/*echo '<pre>';
				var_dump($newJSON[$i]['direction']['prediction']);
				echo '</pre>';
				*/				
			}
		}

		$newJSONString = json_encode($newJSONString);
		$this->setPredictions($newJSONString); 
	}
}
?>