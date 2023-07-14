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
	<title>Ladytown</title>
</head>
<body id="body">
	<header class="header" id="header">
		<div class="container">
			<div class="row">
				<div class="col-10 col-md-3 col-lg-2"><a class="logo-link" href="/ladytown/"><img src="/ladytown/img/logo.svg" alt=""></a></div>
	    		<div class="order-4 order-md-2 col-md-7 col-lg-6 offset-lg-1 col-xl-5">
	    			<nav class="nav" id="nav">
						<ul>
							<li class="nav--li active" data-href="">
								<a class="nav--link" href="/ladytown/">Главная</a>
							</li>
							<li class="nav--li" data-href="shop">
								<a class="nav--link" href="/ladytown/shop/">Магазин</a>
							</li>
							<li class="nav--li" data-href="about">
								<a class="nav--link" href="/ladytown/about/">О бренде</a>
							</li>
							<li class="nav--li" data-href="contacts">
								<a class="nav--link" href="/ladytown/contacts/">Контакты</a>
							</li>
							<li class="nav--li icon--li header-icon" id="session_basket_mob">
								<a class="basket-link" href="/ladytown/shop/basket.php">
									<img src="/ladytown/img/basket.svg" alt="">
									<span class="basket-num"><?php echo $row[0];?></span>
								</a>
							</li>
							<li class="nav--li icon--li header-icon service-icon" id="session_service_mob">
								<a class="basket-link" href="/ladytown/admin/">
									<img src="/ladytown/img/service.svg" alt="">
								</a> 
							</li>
							<li class="nav--li icon--li header-icon service-icon" id="session_mob">
								<a class="basket-link" href="/ladytown/account/<?php echo $session_link;?>.php" data-session="<?php echo $session_link;?>">
									<img src="/ladytown/img/<?php echo $session_icon;?>.svg" alt="">
								</a>
							</li>
						</ul>
					</nav>
	    		</div>
				
				<div class="d-none d-md-block order-md-3 col-md-2 col-lg-3 col-xl-3 offset-xl-1 ml-auto">
					<div class="header-info">
						<div class="phone">
							<a href="tel:+7(495)8235412">
								<button class="callback" type="button">
									<img class="callback-icon" src="/ladytown/img/callback.svg" alt="">
								</button>
							</a>
							<a class="number" href="tel:+7(495)8235412"> +7 (495) 823-54-12</a>
						</div>
						<div class="icons-header">
							<a class="icons-header-link header-icon2" id="session_basket" href="/ladytown/shop/basket.php">
								<img src="/ladytown/img/basket.svg" alt="">
								<span class="basket-num"><?=$row[0]?></span>
							</a>
							<a class="icons-header-link header-icon2" id="session_service" href="/ladytown/admin/">
								<img src="/ladytown/img/service.svg" alt="">
							</a>
							<a class="icons-header-link header-icon2" id="session" href="/ladytown/account/<?php echo $session_link;?>.php" data-session="<?php echo $session_link;?>">
								<img src="/ladytown/img/<?php echo $session_icon;?>.svg" alt="">
							</a>
						</div>
					</div>
				</div>

				<div class="col-2 d-md-none d-flex justify-content-end">
					<button class="nav-toggle" id="nav_toggle" type="button">
						<span class="nav-toggle__item">Menu</span>
					</button>
	    		</div>
			</div>
		</div>
	</header>

	<div class="hidden">