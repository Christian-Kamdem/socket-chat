<?php
//header('Access-Control-Allow-Origin: *');
//declare(strict_types=1);
//require_once 'Modules/domainOrigin.php';
error_reporting(E_ALL) ;
if(1/*domainOrigin() === true*/){
	//header('Access-Control-Allow-Origin:'.$_SERVER['HTTP_ORIGIN']);
	$dataReceive = json_decode(file_get_contents('php://input'));
	$data = $dataReceive->data;
	$requestName = strip_tags($dataReceive->requestName);
	$allowedModules = ['save_message','change_statut_message','load_message'];
	//Switching following the type of the request
	if(in_array($requestName,$allowedModules,true) === true){
		include "modules/{$requestName}.php";
		echo $requestName($data);
	}else{
		echo json_encode(array('message' => 'Request name not found!'));
	}
}else {
	echo json_encode(array('message' => 'Domain origin not allowed!'));
}
?>