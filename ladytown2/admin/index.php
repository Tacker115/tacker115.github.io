<?php
    session_start();
    //echo '<pre>';var_dump($_SESSION);echo '</pre>';
	$session_icon = 'login';
	$session_link = 'form_auth';
	if(isset($_SESSION['login']) && isset($_SESSION['password'])){ 
		$session_link = 'logout';
		$session_icon = $session_link;
	}
?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>
<?php
	$res = $mysqli->query("SELECT count(*) FROM baskets");
	$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/ladytown/template/bootstrap.min.css">
	<link rel="stylesheet" href="/ladytown/template/slick.css">
	<link rel="stylesheet" href="/ladytown/template/style.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/ladytown/template/bootstrap.min.js"></script>
	<script src="/ladytown/template/slick.js"></script>
	<script src="/ladytown/template/script.js"></script>
	<title>Admin</title>
</head>
<body id="body">
	<div class="admin">
		<div class="page-admin">
			<div class="page-header">
				<div class="container-md">
					<div class="row">
						<div class="col-12">
							<h1 class="header-title">Заказы</h1>              
						</div>
						<div class="col-12">
							<ul class="breadcrumb">
								 <a href="/ladytown/">Главная</a> Заказы 
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="admin-inner">
				<div class="container-md">
					<table class="table-order-admin w-100">
                        <thead class="table-basket-thead">
                            <tr>
                                <th class="table-title-admin" scope="col">№</th>
                                <th class="table-title-admin" scope="col">Товар</th>
                                <th class="table-title-admin" scope="col">Цена</th>
                                <th class="table-title-admin text-center" scope="col">Кол-во</th>
                                <th class="table-title-admin text-center" scope="col">Клиент</th>
                                <th class="table-title-admin text-center" scope="col">Дата</th>
                                <th class="table-title-admin text-center" scope="col">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
					            $orders = $mysqli->query(" SELECT * FROM orders ");
					            if ($orders->num_rows > 0) {     
					        ?>
                            <?php
	                            while ($row = mysqli_fetch_array($orders)) {
	                            $customers_join = $mysqli->query(" SELECT * FROM orders o, customers c WHERE '".$row['customer_id_customer']."' = c.id_customer");
	                            $brow = mysqli_fetch_array($customers_join);
	                            $email = $brow['email'];
	                            $id = $row['numorder'];
	                            $name = $row['varprodt_name'];
	                            $price = $row['varprodt_price'];
	                            $count = $row['varprodt_count'];
	                            $odatetime = $row['odatetime'];
	                            $status = $row['status'];
                            ?>
                            <tr class="basket-card" data-tr-basket="<?=$id?>">
                            	<td class="order-id" data-td-basket="<?=$id?>">
                                    <?=$id?>
                                </td>
                                <td class="product-name" data-td-basket="<?=$id?>">
                                    <?=$name?>
                                </td>
                                <td class="product-price" data-td-basket="<?=$id?>">
                                    ₽<?=$price?>
                                </td>
                                <td class="product-count text-center" data-td-basket="<?=$id?>">
                                    <?=$count?>
                                </td>
                                <td class="customer-email text-center" data-td-basket="<?=$id?>">
                                    <?=$email?>
                                </td>
                                <td class="customer-odatetime text-center" data-td-basket="<?=$id?>">
                                    <?=$odatetime?>
                                </td>
                                <td class="order-status text-center" data-td-basket="<?=$id?>">
                                    <?php if($status == 0) : ?>
                                    	<a class="circle-took" data-td-basket="<?=$id?>" href="#" data-status="<?=$status?>"><img src="/ladytown/img/circle.svg" alt=""></a>
                                    <?php else : ?>
                                   		<a class="circle-took" data-td-basket="<?=$id?>" href="#" data-status="<?=$status?>"><img src="/ladytown/img/circle-ok.svg" alt=""></a>
									<?php endif; ?>
                                </td>
                            </tr>
                            <?php
                                 }
                            } ?>  
                        </tbody>
                	</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>