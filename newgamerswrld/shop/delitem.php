<?php
function delItem()
{
	// Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	$basketid = $_POST['basketId'];
	
	$del = $mysqli->query(" DELETE FROM dbbasket WHERE id_basket = ".$basketid." ");
	
	if ($mysqli->connect_errno)
	 {
		 echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error.'<br>';
	 }

}
delItem();
?>