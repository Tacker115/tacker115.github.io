<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/header.php");?>
		
<section id="test-basket">
	<div class="container">
		<div class="main-label" style="padding-top: 90px;">Корзина</div>
		<div class="basket-area">
			<div class="basket-card" id="basket-10">
				<div class="basket-card-img"><a href="/newgamerswrld/shop/details.php?id=10"><img src="/newgamerswrld/shop/images/product-1.jpg"></a></div>
				<div class="basket-details-body">
					<div class="basket-details-title">Игровой коврик для мыши World of Warcraft, черный</div>
					<div class="basket-details-title-lr">
						<div class="basket-details-price">800₽<div class="fakeprice">1280₽</div></div>							
					</div>
					<div class="quantity_goodss">
						<input class="form-control" type="number" step="1" min="1" max="" id="num_count" name="quantity" value="1" title="Qty">
						<input id="checkid" value="21" name="itemid" type="hidden">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/footer.php");?>


<?php
function connecttoBase($tableName1 = 'dbshop', $tableName2 = 'dbbasket', $sortName = 'id', $sortBy = 'DESC')
{
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	
	$rs = $mysqli->query(" SELECT * FROM ".$tableName1." ORDER BY ".$sortName." ".$sortBy." ");
	$res = $mysqli->query(" SELECT * FROM ".$tableName2." ORDER BY ".$sortName." ".$sortBy." ");
	
	if($res) {
		$p = mysqli_num_rows($rs);
		$y = 1;
		while ($y <= $p) {
			$row = mysqli_fetch_array($rs);
			$line = mysqli_fetch_array($res);
			$id = $line['id_basket'];
			$productid = $line['product_id'];
			$productcount = $line['product_count'];
			$productname = $row['name'];
			$productimage = $row['image'];
			$productprice = $row['price'];
			$productfakeprice = $productprice*1.6;
			?>
			
			<div class="details-card" id="<?=$id?>">
			<div class="details-img">
				<img src="<?=$productimage?>">
			</div>
			<div class="details-body">
				<div class="details-title"><?=$productname?></div>
				<div class="details-title-lr">
					<div class="details-left-label">Цена</div>
					<div class="details-right-label">О товаре</div>
				</div>
				<div class="details-body-block">
					<div class="details-left">
						<div class="details-price"><?=$productprice?>₽<div class="fakeprice"><?=$fakeprice?>₽</div></div>
						<?
						$edid = mb_substr($id, 0, (strlen($id)-1));
						$new = $mysqli->query(" SELECT * FROM ".$tableName."  WHERE id IN (".$edid."1, ".$edid."2,".$edid."3,".$edid."4,".$edid."5) ");
						if($new) { 
						
							$linec = mysqli_fetch_array($new);
							$defcount = $linec['count'];
							$defid = $linec['id'];	
							$defsize = $linec['size'];
						
						?>
						
						<div class="input-group quantity_goods">
							<div class="details-count-label">Размер</div>
							<select id="selectBox" class="form-select size-select" onchange="changeFunc();">
								<option name="option" class="option" value="<?=$defid?>" data-count="<?=$defcount?>" selected>
									<div class="option-size"><?=$defsize?></div>
									<div class="option-count">- <?=$defcount?> шт.</div>
								</option>
							<?
							while ($line = mysqli_fetch_array($new))
							{	
								$mid = $line['id'];
								$msize =  $line['size'];
								$mcount = $line['count'];
								if ($mcount != 0) {
								?>
								<option name="option" class="option" value="<?=$mid?>" data-count="<?=$mcount?>">
									<div class="option-size"><?=$msize?></div>
									<div class="option-count">- <?=$mcount?> шт.</div>
								</option>
							<? }
							}?>
							</select>
						</div> 
						
						
						<div class="input-group quantity_goods">
						  <div class="details-count-label">Кол-во</div>
						  <input class="form-control" type="number" step="1" min="1" max="<?=$defcount?>" id="num_count" name="quantity" value="1" title="Qty">
						  <input id="checkid" value="<?=$edid?>1" name="itemid" type="hidden">
						</div>
						

						<div class="btn-buy"><a class="btn btn-primary btn-buy-item">Добавить в корзину</a></div>
						<div class="btn-buy inactive"><a href="/newgamerswrld/shop/basket.php" class="btn btn-success btn-buy-item">Перейти в корзину</a></div>
					</div>
					<?}
					else {
						?>
						<div class="input-group quantity_goods">
						  <div class="details-count-label">Кол-во</div>
						  <input class="form-control" type="number" step="1" min="1" max="<?=$count?>" id="num_count" name="quantity" value="1" title="Qty">
						  <input id="checkid" value="<?=$id?>" name="itemid" type="hidden">
						</div>
						
					
					<?}
						?>
					<div class="details-right">						
						<div class="details-desc"><?=$shortDesc?></div>
					</div>
				</div>						
			</div>
		</div>
		
			
		<?	
		}
	} else {
		
		?><div>Корзина пуста</div><?
		}
	}
	else{
		alert('Ошибка на сайте!');
	}
	?>	
	</div>
</div>
</section>
<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/footer.php");?>