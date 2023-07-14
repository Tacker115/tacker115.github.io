<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>
<?php
	$click = $_POST['click'];
	$status = $_POST['status'];
	if ($status == 0) : $edit = $mysqli->query(" UPDATE orders SET status = 1 WHERE numorder = '".$click."' ");
	else : $edit = $mysqli->query(" UPDATE orders SET status = 0 WHERE numorder = '".$click."' ");
	endif;
?>