<?php
require_once('DBWrapper.php');

$url= $_REQUEST["url"];
$configName= $_REQUEST["configName"];

$homepage = file_get_contents($url);
$homepage = preg_replace("/[^A-Za-z]/", ' ', $homepage);

$homepage = preg_split("/[\s,]+/",$homepage);

$finalAnswer = null;
foreach ($homepage as $value) {
	if($value != ""){
		 if(isset($finalAnswer[$value]))
	    	$finalAnswer[$value]++;
	    else
	    	$finalAnswer[$value] = 1;
	}
}

$dbConn = DBWrapper::getInstance();
$dbConn->Open();  // Ensuring DB connection remains accross multiple calls
$sqlToExecute = "INSERT INTO Configs (url,configName) VALUES ('$url','$configName')";
$result = $dbConn->executeQuery($sqlToExecute);
$configId = $dbConn->getLastInsertId();


foreach ($finalAnswer as $key => $value) {
	$sqlToExecute = "INSERT INTO wordsStore (configId,word,count) VALUES ('$configId','$key',$value)";
	$result = $dbConn->executeQuery($sqlToExecute);
}
$dbConn->Close();
echo json_encode($finalAnswer);
?>