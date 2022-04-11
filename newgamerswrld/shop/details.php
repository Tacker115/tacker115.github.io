<?php
    session_start();
	$userid = $_SESSION['id'];
?>
<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/header.php");?>

<?php function connecttoBase($tableName = 'dbshop', $sortName = 'id', $sortBy = 'DESC')
{
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	$tableName2 = 'dbproductsize';
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	$res = $mysqli->query(" SELECT * FROM ".$tableName." ORDER BY ".$sortName." ".$sortBy." ");

 	if($res)
	{ ?>
<section id="details">
	<?
		$rs = $mysqli->query(" SELECT * FROM ".$tableName."  WHERE id = ".$_GET['id']." ");
		$row = mysqli_fetch_array($rs);
		$id = $row['id'];
		$image = $row['image'];
		$name = $row['name'];
		$price = $row['price'];
		$fakeprice = $price*1.6;
		$count = $row['count'];
		$shortDesc = $row['shortDesc'];
		$status = $row['status'];
	?>
	<div class="details-card" id="<?=$_GET['id']?>">
		<div class="container">
			<div class="details-body">
				<div class="details-title"><?=$name?></div>
				<div class="details-img">
					<img src="<?=$image?>">
				</div>
				<div class="details-body-block">
					<div class="details-tobuy">
						<div class="details-label">Цена</div>
						<div class="details-price"><?=$price?>₽<div class="fakeprice"><?=$fakeprice?>₽</div></div>
						<?
					if($status == 1) {
						
						$new = $mysqli->query(" SELECT * FROM ".$tableName2." WHERE id IN (".$id."1, ".$id."2,".$id."3,".$id."4,".$id."5) AND (count > 0) ");						
						$linec = mysqli_fetch_array($new);
						
						$defcount = $linec['count'];
						$defid = $linec['id'];	
						$defsize = $linec['size'];
					
					?>
						
						<div class="input-group quantity_goods">
							<div class="details-label">Размер</div>
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
						  <div class="details-label">Кол-во</div>
						  <input class="form-control count-input" type="number" step="1" min="1" max="<?=$defcount?>" id="num_count" name="quantity" value="1" title="Qty">
						  <input id="checkid" value="<?=$mid?>" name="itemid" type="hidden">
						</div>
						
						<?} else { ?>
							
							<div class="input-group quantity_goods">
							  <div class="details-label">Кол-во</div>
							  <input class="form-control count-input" type="number" step="1" min="1" max="<?=$count?>" id="num_count" name="quantity" value="1" title="Qty">
							  <input id="checkid" value="<?=$id?>0" name="itemid" type="hidden">
							</div>
						<?	
					}?>
						
						<input id="checkuserid" value="<?=$_SESSION['id']?>" type="hidden">
						<? if (strlen($_SESSION['id']) >= 1) { ?>
						<div class="btn-buy"><a class="btn btn-primary btn-buy-item">Добавить в корзину</a></div>
						<div class="go-basket inactive"><a href="/newgamerswrld/shop/basket.php" class="btn btn-success btn-buy-item">Перейти в корзину</a></div>
						<? } ?>
					</div>
					
					<div class="details-info">
						<div class="details-label">О товаре</div>
						<div class="details-desc"><?=$shortDesc?></div>
					</div>
				</div>
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

<script type="text/javascript">
		
		
		// id товара в input + максимальное значение для count
		function changeFunc() {
			var selectBox = document.getElementById("selectBox");
			var s = document.getElementById("checkid");
			s.value = selectBox.options[selectBox.selectedIndex].value;
			
			var p = selectBox.options[selectBox.selectedIndex].getAttribute('data-count');
			document.getElementById('num_count').setAttribute('max', p);
		}
		
		$(function() {
			// проверка для input
			$('.count-input').on('change, input', function()
			{
				var maxCount = Number($(this).attr('max'));
				var currentCount = Number($(this).val());
				
				if (currentCount > maxCount) {
					$(this).val(maxCount); 
				}
				
				if (currentCount < 1) {
					$(this).val(1);
				} 			
			});
			
			// манипуляции с товаром по нажатию кнопки
			$('.btn-buy').click(function() {
				var dataId = document.getElementById("checkid").value;
				var dataCount = document.getElementById("num_count").value;
				$.ajax(
				{
					type: "POST",
					url: "/newgamerswrld/shop/basketadd.php",
					data: {dataId, dataCount},
					success: function(data)
					{
						console.log('Успешно!');
					}
				});
				console.log(dataId);
				
			   $('.go-basket.inactive').removeClass('inactive');
			   $('.btn-buy').addClass('inactive');
			});
					
		});
</script>


<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/footer.php");?>