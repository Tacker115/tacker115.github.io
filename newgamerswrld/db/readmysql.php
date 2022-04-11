<?php
function connecttoBase($tableName = 'db20211001', $sortName = 'id', $sortBy = 'ASC')
{
	// Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);

	if ($mysqli->connect_errno)
	{
		//echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error.'<br>';
	}
	$res = $mysqli->query(" SELECT * FROM ".$tableName." ORDER BY ".$sortName." ".$sortBy." ");

	if($res)
	{
		while ($row = mysqli_fetch_array($res))
		{
			$rowAll[$row['tableN']][$row['id time']] = $row['status'];
		}
	}
	else
	{
		$rowAll['error'] = 'данных нет';
	}
	echo json_encode($rowAll, JSON_UNESCAPED_UNICODE);
}
connecttoBase($_POST['tableName']);
?>