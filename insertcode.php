<?php

require('DBPJ_cn.inc');
require('DBPJ_db.inc');
$conn = db_connect(); 

$Forward = $_POST['Forward'];
$Backward = $_POST['Backward'];
$Right = $_POST['Right'];
$Left = $_POST['Left'];

//echo $_POST['Forward'];
//echo $_POST['Backward'];
//echo $_POST['Right'];
//echo $_POST['Left'];

if (($Forward)){
	if (($Backward)){
		if (($Left)){
			if (($Right)){	
				$queryInsert = "INSERT INTO directions_set (F, B, R, L) VALUES ($Forward,$Backward,$Right,$Left);";
				$result = db_do_query($conn, $queryInsert);
			}
		}
	}
}

header("Location:RobotDirectionDraw.php");

?> 