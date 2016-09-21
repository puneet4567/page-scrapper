<?php
require_once('DBWrapper.php');
       
$configId= $_REQUEST["configId"];
$dbConn = DBWrapper::getInstance();
$dbConn->Open();  // Ensuring DB connection remains accross multiple calls
$sqlToExecute = "SELECT word,count FROM  wordsStore where configId = ".$configId;
$result = $dbConn->executeQuery($sqlToExecute);
$dbConn->Close();

$configData = null;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	$configData[$row["word"]] = $row["count"];
    }
  } else {
		echo "0 results";
  }
echo json_encode($configData);
?>