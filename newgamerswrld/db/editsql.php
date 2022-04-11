<?php
function resbase($bd = 'db20211001', $status = 'y', $idtime = '120')
{
	// Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	
	$editid = explode(",", $_POST['id']);
	for ($x=0; $x<count($editid); $x++) {
		$sql = $mysqli->query(" UPDATE ".$_POST['dataTime']." SET status = 'y', name = '".$name."', phone = '".$phone."' WHERE id = ".$editid[$x]."");
	}
	if ($mysqli->connect_errno)
	 {
		 echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error.'<br>';
	 }

}
resbase($_POST['dataTime']);
?>
