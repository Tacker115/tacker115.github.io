<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>
<?php
	$arrBaskets = $_POST['arrBasket'];
	$truncate = $mysqli->query(" TRUNCATE TABLE baskets ");
	foreach ($arrBaskets as $key => $value) {
	  $addition = $mysqli->query(" INSERT INTO baskets (varprodt_id_varprodt, varprodt_count) VALUES ('".$key."', '".$value."')  ");
	}
?>