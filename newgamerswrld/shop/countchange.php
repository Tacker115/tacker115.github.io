<?php
    session_start();
    ?>
<?php
function changeBasketCount()
{
	// Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	$thisid = $_POST['currentId'];
	$newcount = $_POST['currentCount'];
	
	
	$edit = $mysqli->query(" UPDATE dbbasket SET product_count = '".$newcount."' WHERE product_id = ".$thisid." ");
	
	if ($mysqli->connect_errno)
	 {
		 echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error.'<br>';
	 }
	 print_r($_POST);

}
changeBasketCount();
?>
