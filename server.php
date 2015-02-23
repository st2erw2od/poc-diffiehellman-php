<?php
/*
 * Diffie-Hellman key exchange
 * client: a, g, p                 server: b
 * A = g ^ a mod p   -> g, p, A    B = g ^ b mod p
 * K = B ^ a mod p	       B <-    K = A ^ b mod p
 * 
 * p and g can be hardcoded, because these are just seeds
 * the real magic happens with modulo (discrete logarithm problem)
 */
 
session_start();

require_once 'utilities.php';

$webServiceConsumer = new WebServiceConsumer();
$data = $webServiceConsumer->getData();

if(count($data)>0 && isset($data['a'])){
	$p = '161521746670640296426473658228859984306663144318152681524054709078245736590366297248377298082656939330673286493230336261991466938596691073112968626710792148904239628873374506302653492009810626437582587089465395941375496004739918498276676334238241465498030036586063929902368192004233172032080188726965600617167';
	$g = 2;
	$diffieHellman = new DiffieHellman($p,$g);
	$diffieHellman->setSecret(RandomNumber::generateRandomNumber());
	$diffieHellman->setA($data['a']);
	$_SESSION['K'] = $diffieHellman->calculateKey();
	$returnData = $diffieHellman->getData();
	echo json_encode($returnData);
}
else{
	$_SESSION['K'] = "";
	echo "";
}
?>