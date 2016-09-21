<?php
require_once('DBWrapper.php');

$configId= $_REQUEST["configId"];

$dbConn = DBWrapper::getInstance();
$dbConn->Open();  // Ensuring DB connection remains accross multiple calls
$sqlToExecute = "DELETE FROM Configs where id = ".$configId;
$result = $dbConn->executeQuery($sqlToExecute);
$sqlToExecute = "DELETE FROM wordsStore where configId = ".$configId;
$result = $dbConn->executeQuery($sqlToExecute);
$dbConn->Close();

 echo "true";
?>