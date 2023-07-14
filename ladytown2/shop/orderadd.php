<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>
<?php
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$checkcustomers = $mysqli->query(" SELECT COUNT(*) FROM customers ");
	$customerscount = mysqli_fetch_array($checkcustomers);
	$newcustomer = $customerscount[0];
	$newcustomer++;
	$addcustomer = $mysqli->query(" INSERT INTO customers (id_customer, name, phone, email, address) VALUES ('".$newcustomer."', '".$name."', '".$phone."', '".$email."', '".$address."')  ");

	$connectbasket = $mysqli->query(" SELECT varprodt_id_varprodt, varprodt_count FROM baskets ");
    while ($row = mysqli_fetch_array($connectbasket)) {
	    $id = $row['varprodt_id_varprodt'];
	    $count = $row['varprodt_count'];
	    $basket_join = $mysqli->query(" SELECT '".$id."' AS id, '".$count."' AS count, v.name, v.price, v.count AS currentcount FROM baskets b, varprodt v WHERE '".$id."' = v.id_varprodt");
	    $brow = mysqli_fetch_array($basket_join);
	    $name = $brow['name'];
	    $price = $brow['price'];
	    $currentcount = $brow['currentcount'];
	    $editcount = $currentcount - $count;

    	$addorder = $mysqli->query(" INSERT INTO orders (varprodt_id_varprodt, varprodt_name, varprodt_price, varprodt_count, odatetime, status, customer_id_customer) VALUES ('".$id."', '".$name."', '".$price."', '".$count."', now(), 0, '".$newcustomer."') ");

		$editcount = $mysqli->query(" UPDATE varprodt SET count = '".$editcount."' WHERE id_varprodt = '".$id."' ");
	}
	
	$truncate = $mysqli->query(" TRUNCATE TABLE baskets ");
?>