<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
URL: <input type="text" name="fname" id="urlName" style="width:500px">&nbsp;&nbsp;&nbsp;
Config Name:<input type="text" name="fname" id="configName" style="width:100px">&nbsp;&nbsp;&nbsp;
<input type="submit" value="Submit" onclick="GetPageContent()">
<br><br><br>

<?php
require_once('DBWrapper.php');
$dbConn = DBWrapper::getInstance();
$dbConn->Open();  // Ensuring DB connection remains accross multiple calls
$sqlToExecute = "SELECT id,configName FROM  Configs";
$result = $dbConn->executeQuery($sqlToExecute);
$dbConn->Close();

  if ($result->num_rows > 0) {
    echo "<table id = 'configTable' style='border : 1px solid black'><th>Config</th><th>Action</th>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='border : 1px solid black'><label onclick='renderTable(".$row["id"].")'>".$row["configName"]."</label></td>";
        echo "<td style='border : 1px solid black'><button onclick='deleteConfig(".$row["id"].")'>"."Delete"."</button></td></tr>";
    }
    echo "</table><br>";
  }
?>

<table id="wordCount" border='1'>
<thead>
    <tr>
        <th>Word</th>
         <th>Word Count</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="text/javascript">
	function deleteConfig(configId){
		$.ajax({
	        url: '/deleteConfigData.php',
	        type: 'GET',
	        dataType: "json",
	        data: {
	            configId: configId
	        },
	        success: function (data) {  
	        	if(data == true){
	        		alert("config deleted");
	        		location.reload();
	        	}
			},
			error: function (data) {
			}
	    });	
	}
	function renderTable(configId){
		$.ajax({
	        url: '/getConfigData.php',
	        type: 'GET',
	        dataType: "json",
	        data: {
	            configId: configId
	        },
	        success: function (data) {  
	        	$("#wordCount tbody tr").remove();
	        	var trHTML = '';
		        $.each(data, function (word, wordCount) {
		            trHTML += '<tr><td>' + word + '</td><td>' + wordCount + '</td></tr>';
		        });
       			$('#wordCount tbody').append(trHTML);
				console.log(data);
			},
			error: function (data) {
			}
	    });	
	}
	function GetPageContent(){
		$.ajax({
	        url: '/getData.php',
	        type: 'GET',
	        dataType: "json",
	        data: {
	            url: $('#urlName').val(),
	            configName: $('#configName').val()
	        },
	        success: function (data) {  
				alert("config added");
	        		location.reload();
			},
			error: function (data) {
			}
	    });	
	}
</script>