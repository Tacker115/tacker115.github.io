<?php
    session_start();
    ?>
	
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/newgamerswrld/template/style.css"/>
	<link rel="stylesheet" type="text/css" href="/newgamerswrld/reservation/include/jquery.datetimepicker.min.css"/>
	<link rel="stylesheet" type="text/css" href="/newgamerswrld/reservation/include/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/newgamerswrld/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="/newgamerswrld/slick/slick-theme.css"/>
    <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
	<script src="/newgamerswrld/template/script.js"></script>
	<script type="text/javascript" src="/newgamerswrld/slick/slick.min.js"></script>
	<script src="/newgamerswrld/reservation/include/script.js"></script>
	<script src="/newgamerswrld/reservation/include/jquery.datetimepicker.full.js"></script>
</head>
<body class="body">
    <header class="header"> 
		<div class="container main">
			<nav class="navbar navbar-expand-md" id="navbar-gmrswrld">
				<div class="logo-block">
					<a class="navbar-brand" id="navlink" href="/newgamerswrld/">
						<picture>
							<source srcset="/newgamerswrld/images/logo-mobile.png" media="(max-width: 991px)">	
							<img id="header-img" class="logo" src="/newgamerswrld/images/logo-main.png" alt="Logo">
						</picture>
					</a>
				</div>
				<div class="toggler-btn">
					<button id="btn-mobile" class="navbar-toggler navbar-dark bg-dark" data-bs-toggle="collapse" data-bs-target="#navbar">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse justify-content-center" id="navbar">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="/newgamerswrld/price/">Цены</a>
						</li>
						<li class="nav-item">
							<a href="/newgamerswrld/reservation/" class="nav-link">Бронь</a>
						</li>
						<li class="nav-item">
							<a href="/newgamerswrld/shop/" class="nav-link">Магазин</a>
						</li>
						<li class="nav-item">
							<a href="/newgamerswrld/contacts/" class="nav-link">Контакты</a>
						</li>
						
						<?php
							// Проверяем авторизован ли пользователь
							if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
							// если нет, то выводим блок с ссылками на страницу регистрации и авторизации
						?>
						
						<li class="nav-item links-block-item-mobile">
							<a class="nav-link" href="/newgamerswrld/account/form_auth.php"><i class="fa fa-user whover" aria-hidden="true"></i></a>
						</li>
						<li class="nav-item links-block-item-mobile">
							<a class="nav-link" href="/newgamerswrld/account/form_register.php"><i class="fa fa-user-plus whover plus" aria-hidden="true"></i></a>
						</li>
						
						<?php
							}else{
							//Если пользователь авторизован, то выводим ссылку Выход
						?>
						
						<li class="nav-item links-block-item-mobile">
							<a class="nav-link" href="/newgamerswrld/account/logout.php"><i class="fa fa-sign-out-alt whover" aria-hidden="true"></i></a>
						</li>
						
						<?php
							}
						?>
						
					</ul>
				</div>
							
				<div class="links-block">
					<?php
						// Проверяем авторизован ли пользователь
						if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
						// если нет, то выводим блок с ссылками на страницу регистрации и авторизации
					?>
					<div id="link_auth" class="links-block-item auth">
						<a href="/newgamerswrld/account/form_auth.php"><i class="fa fa-user whover" aria-hidden="true"></i></a>
					</div>
					<div id="link_register" class="links-block-item">
						<a href="/newgamerswrld/account/form_register.php"><i class="fa fa-user-plus whover" aria-hidden="true"></i></a>
					</div>
					<?php
						}else{
						//Если пользователь авторизован, то выводим ссылку Выход
					?> 
					<div id="link_logout" class="links-block-item logout">
						<a href="/newgamerswrld/account/logout.php"><i class="fa fa-sign-out-alt whover" aria-hidden="true"></i></a>
					</div>
					<?php
						}
					?>
				</div>
			</nav>
		</div>
    </header>
	<div class="page">