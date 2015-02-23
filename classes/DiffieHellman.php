<?php
class DiffieHellman {
	private $p;
	private $g;
	private $secret;
	private $A;
	private $B;
	private $K;
	
	/*CONSTRUCTOR*/
	public function __construct($p,$g){
		$this->setP($p);
		$this->setG($g);
	}
	
	/*FUNCTIONS*/
	public function calculateKey(){
		$this->setB(bcpowmod($this->getG(),$this->getSecret(),$this->getP()));
		$this->setK(bcpowmod($this->getA(),$this->getSecret(),$this->getP()));
		return $this->getK();
	}
	
	public function getData(){
		$data = array(
			"A" => $this->getA(), /*unnecessary, debug-only*/
			"B" => $this->getB(),
			"K" => $this->getK() /*DEBUG-ONLY!!*/
		);
		return $data;
	}
	
	/*GETTERS und SETTERS*/
	//(I wish there was something like Lombok for PHP...)
	public function setP($p){
		$this->p = $p;
	}
	
	public function getP(){
		return $this->p;
	}
	
	public function setG($g){
		$this->g = $g;
	}
	
	public function getG(){
		return $this->g;
	}
	
	public function setSecret($secret){
		$this->secret = $secret;
	}
	
	public function getSecret(){
		return $this->secret;
	}
	
	public function setA($A){
		$this->A = $A;
	}
	
	public function getA(){
		return $this->A;
	}
	
	public function setB($B){
		$this->B = $B;
	}
	
	public function getB(){
		return $this->B;
	}
	
	public function setK($K){
		$this->K = $K;
	}
	
	public function getK(){
		return $this->K;
	}
}
?>