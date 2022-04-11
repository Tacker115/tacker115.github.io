<?php
    session_start();
	$userid = $_SESSION['id'];
    ?>
<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/header.php");?>
<?php
function connecttoBase($tableName = 'dbshop', $sortName = 'id', $sortBy = 'DESC')
{
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	
	$res = $mysqli->query(" SELECT * FROM ".$tableName." ORDER BY ".$sortName." ".$sortBy." ");

 	if($res)
	{ ?>
<section id="shop">
	<div class="container">
		<div class="shop-all">
			<div class="shop-top">
				<div class="main-label">Магазин</div>
				<? if (strlen($_SESSION['id']) >= 1) { ?>
				<div class="basket-link"><a href="/newgamerswrld/shop/basket.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a></div>
				<? } ?>
			</div>
			<div class="shop-area">
				<?
					$p = mysqli_num_rows($res);
					$y = 1;
					
					while ($y <= $p)
					{ 
						$rs = $mysqli->query(" SELECT * FROM ".$tableName."  WHERE id = ".$y." ");
						$row = mysqli_fetch_array($rs);
						$id = $row['id'];
						$image = $row['image'];
						$name = $row['name'];
						$price = $row['price'];
						$fakeprice = $price*1.6;
						$count = $row['count'];
						
				?>
				<div class="shop-card" id="card-<?=$id?>">
				  <div class="card-img"><a href="/newgamerswrld/shop/details.php?id=<?=$id?>"><img src="<?=$image?>"></a></div>
				  <div class="card-body">
					<div class="price-count-block">
						<div class="price-block"><?=$price?>₽<span><?=$fakeprice?>₽</span></div>
						<div class="count-block"><?=$count?> шт.</div>
					</div>
					<div class="card-title"><a href="/newgamerswrld/shop/details.php?id=<?=$id?>"><?=$name?></a></div>
					<div class="btn-block"><a class="btn btn-primary shop-btn" href="/newgamerswrld/shop/details.php?id=<?=$id?>">Подробнее</a></div>
				  </div>
				</div>
				<?$y++;
					} ?>	
			</div>
		</div>
	</div>
</section>
<?
	}
	else
	{
		$rowAll['error'] = 'данных нет';
	}   
}
connecttoBase();
?>

<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/footer.php");?>

