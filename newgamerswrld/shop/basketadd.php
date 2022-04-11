<?php
    session_start();
    ?>
<?php
function addBasket()
{
	// Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	$userid = $_SESSION['id'];
	$productid = $_POST['dataId'];
	$productcount = $_POST['dataCount'];
	
	
	$add = $mysqli->query(" INSERT INTO dbbasket (user_id, product_id, product_count) VALUES ('".$userid."', '".$productid."', '".$productcount."')");
	
	if ($mysqli->connect_errno)
	 {
		 echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error.'<br>';
	 }

}
addBasket();
?>
