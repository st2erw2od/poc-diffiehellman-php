<?php
//error handler
function errorHandler($errorNumber, $errorMessage){
	echo "Error $errorNumber: $errorMessage";
}
set_error_handler('errorHandler',E_USER_WARNING);

//class auto loader
function __autoload($class){
	$path = "classes/$class.php";
	if(file_exists($path)) {
		require $path;
	} else {
		trigger_error("Class $class not found!",E_USER_WARNING);
		return false;
	}
}
?>