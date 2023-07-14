<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>

<?php
	$id_varprodt = $_POST['varprodt_id'];
	$del = $mysqli->query(" DELETE FROM baskets WHERE varprodt_id_varprodt = ".$id_varprodt." ");
?>