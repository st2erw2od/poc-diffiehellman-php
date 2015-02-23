<?php
/*
 * web service consumer
 * so that we don't have to directly access $_GET, $_POST
 * and can check the data at one place for every value
 */
class WebServiceConsumer {
	//get the data
	public function getData(){
		$data = array();
		foreach($_GET as $key => $value){
			if($this->checkData($key,$value)){
				$data += array($key => $value);
			}
		}
		foreach($_POST as $key => $value){
			if($this->checkData($key,$value)){
				$data += array($key => $value);
			}
		}
		return $data;
	}
	
	//check the data
	private function checkData($key,&$value){
		//security, prevent malicious code
		$value = htmlspecialchars($value);
		return true;
	}
}
?>