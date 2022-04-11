<?php
    session_start();
    ?>
<?php
function addOrder($tableName = 'dbbasket', $sortName = 'product_id', $sortBy = 'ASC')
{
	// Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$tableName2 = 'dborder';
	$tableName3 = 'dbshop';
	$tableName4 = 'dbproductsize';
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	$userid = $_SESSION['id'];
	$username = $_SESSION['name'];
	$userphone = $_SESSION['phone'];
	
	$new = $mysqli->query(" SELECT * FROM ".$tableName." ORDER BY ".$sortName." ".$sortBy." ");
	
	// ID для dborder
	$new4 = $mysqli->query(" SELECT * FROM ".$tableName2." ORDER BY id_main DESC ");
	$line4 = mysqli_fetch_array($new4);
	$mainid = $line4['id_main'];
	$mainid = $mainid + 1;
	$n = 0;
	
	while ($line = mysqli_fetch_array($new)) {
		
		$productid = $line['product_id'];
		$productcount = $line['product_count'];
		$edid = substr($productid, 0, -1);
		
		$new2 = $mysqli->query(" SELECT * FROM ".$tableName3." WHERE id = ".$edid." ");
		$line2 = mysqli_fetch_array($new2);
		$status = $line2['status'];
		$allproductcount = $line2['count'];
		$prodc = intval($productcount);
		$allprodc = intval($allproductcount);
		$newcount = $allprodc - $prodc;
 
		if ($status == 1) {
			
			$new3 = $mysqli->query(" SELECT * FROM ".$tableName4." WHERE id = ".$productid." ");
			$line3 = mysqli_fetch_array($new3);
			$productsizecount = $line3['count'];
			$prodsizec = intval($productsizecount);
			$updcount = $prodsizec - $prodc;
			
			$upd = $mysqli->query(" UPDATE ".$tableName4." SET count = ".$updcount." WHERE id = ".$productid." ");
		
		}
		
		
		// добавляем
		$d = "$userid$mainid$n";
		$add = $mysqli->query(" INSERT INTO ".$tableName2." (id_order, id_main, product_id, product_count, user_id, user_name, user_phone) VALUES ('".$d."', '".$mainid."', '".$edid."', '".$productcount."', '".$userid."', '".$username."', '".$userphone."')");
		//$add = $mysqli->query(" INSERT INTO ".$tableName2." (id_main, id_order, product_id, product_count, user_id, user_name, user_phone) VALUES ('".$oid."', '".$oid$userid$n."', '".$edid."', '".$productcount."', '".$userid."', '".$username."', '".$userphone."')");
		// удаляем
		$del = $mysqli->query(" UPDATE ".$tableName3." SET count = ".$newcount." WHERE id = ".$edid." ");
		
		$n++;
	}
	
	$clear = $mysqli->query(" DELETE FROM ".$tableName." ");


}
addOrder();
?>
