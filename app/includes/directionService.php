<?php
error_reporting(~0);
ini_set('display_errors', 1);

class directionService {

	protected $json;
	protected $newJSON;
	protected $directions;

	public function __construct(){
		$this->json='';
		$this->newJson='';
		$this->directions='';
	}

	public function setJSON($val){
		$this->json=$val;
	}

	public function setNewJSON($val){
		$this->newJSON = $val;
	}

	public function setDirection($val){
		$this->directions=$val;
	}

	public function getJSON(){
		return $this->json;
	}

	public function getNewJSON(){
		return $this->newJSON;
	}

	public function getDirection(){
		return $this->directions;
	}

	public function decodeJSON(){
		$json = $this->getJSON();
		$decodedJSON = json_decode($json,true);
		$newJSON = $decodedJSON['predictions'];		
		$this->setNewJSON($newJSON);
	}

	public function getDirections(){
		$newJSON = $this->getNewJSON();
		$newJSONString = '';
		$i = 0;


		if(!isset($newJSON['attributes']['dirTitleBecauseNoPredictions'])){
			$i=0;
			$newJSONString = '{"directions":[';
			foreach((array)$newJSON as $item){
				if(isset($item['attributes']['title'])){
					if($i>=1){
						$newJSONString  = $newJSONString.',';
					}
					$newJSONString  = $newJSONString.'{';
					$newJSONString  = $newJSONString.'"direction":';					
					$newJSONString  = $newJSONString.'"'.$item['attributes']['title'].'"';
					$newJSONString  = $newJSONString.'}';
					$i += 1;
				}elseif(isset($item['direction']['attributes']['title'])){
					if($i>=1){
						$newJSONString  = $newJSONString.',';
					}
					$newJSONString  = $newJSONString.'{';
					$newJSONString  = $newJSONString.'"direction":';					
					$newJSONString  = $newJSONString.'"'.$item['direction']['attributes']['title'].'"';
					$newJSONString  = $newJSONString.'}';
					$i += 1;
				}	
			}
			$newJSONString  = $newJSONString.']}';
		}else{
			$newJSONString = '{"directions":[{';
			$newJSONString = $newJSONString.'"error":"No predictions available for this stop."';
			$newJSONString = $newJSONString.'}]}';
		}

		$this->setDirection($newJSONString);

		/*echo '<pre>';
		var_dump($newJSON);
		echo '<pre>';*/		
	}
}
?>