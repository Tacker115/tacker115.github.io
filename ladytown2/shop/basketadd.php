<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>
<?php
	$id_varprodt = $_POST['id_varprodt'];
	$add = $mysqli->query(" INSERT INTO baskets (varprodt_id_varprodt, varprodt_count) VALUES ('".$id_varprodt."', 1)  ");
	/* $check = $mysqli->query(" SELECT * baskets WHERE varprodt_id_varprodt = '".$id_varprodt."'");
	if ($check) {
		$row = mysqli_fetch_array($check);
		$count_value = $row['varprodt_count'];
		$count_value++;
		$update = $mysqli->query("UPDATE baskets SET varprodt_count = '".$count_value."' WHERE customer_id = '".$id_varprodt."'");
	}
	else {
		$add = $mysqli->query(" INSERT INTO baskets (varprodt_id_varprodt, varprodt_count) VALUES ('".$id_varprodt."', 1)  ");
	}*/
?>

