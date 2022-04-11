<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/header.php");?>

<section id="basket">
	<div class="container">
		<div class="main-label basket-label">Корзина</div>
		
<?php
 function connecttoBase ($tableName1 = 'dbshop', $tableName2 = 'dbbasket', $sortName1 = 'id', $sortName2 = 'id_basket', $sortBy = 'ASC') {
    // Соединяемся, выбираем базу данных
	$hostBase = 'localhost';
	$userBase = 'root';
	$passBase = '=xbQXvR9NhNBJQ0Q?%2]';
	$nameBase = 'dbgamerswrld';
	$portBase = 3306;
	
	$rowAll = array();
	$tableName3 = 'dbproductsize';
	
	$mysqli = new mysqli($hostBase, $userBase, $passBase, $nameBase, $portBase);
	
	if ($mysqli->connect_errno)
	{
		echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error.'<br>';
	}
	
	$res = $mysqli->query(" SELECT * FROM ".$tableName2." WHERE user_id = ".$_SESSION['id']);

	if($res->{num_rows} != '') {

		?>	
				<div class="basket-area">
			<? 

			while ($line = mysqli_fetch_array($res)) {
				$sizeid = $line['product_id'];
				$id = substr($sizeid, 0, -1);
				$currentcount = $line['product_count'];
				$basketid = $line['id_basket'];
				
				$new = $mysqli->query(" SELECT * FROM ".$tableName1." WHERE id = ".$id." ");
				$row = mysqli_fetch_array($new);
				$name = $row['name'];
				$count = $row['count'];
				$image = $row['image'];
				$price = $row['price'];
				$fakeprice = $price*1.6;
				$status = $row['status'];
				?>
					<div class="basket-card" id="basket-<?=$id?>">
					
					<? if ($status == 1) {
						$newv = $mysqli->query(" SELECT * FROM ".$tableName3." WHERE id = ".$sizeid." ");
						$rown = mysqli_fetch_array($newv);
						$count = $rown['count'];						
					}?>
					
						<div class="basket-card-img"><a href="/newgamerswrld/shop/details.php?id=<?=$id?>"><img src="<?=$image?>"></a></div>
						<div class="basket-details-body">
							<div class="basket-details-title"><?=$name?></div>
							<div class="basket-details-title-lr">
								<div class="basket-details-price"><?=$price?><div class="fakeprice"><?=$fakeprice?></div></div>							
							</div>
							<div class="quantity_goodss">
								<input class="form-control" type="number" step="1" min="1" max="<?=$count?>" id="num_count" name="quantity" value="<?=$currentcount?>" title="Qty" onchange="changeCount();">
								<input id="checkid" value="<?=$sizeid?>" name="itemid" type="hidden">
								<input id="checkbasketid" value="<?=$basketid?>" name="itemid" type="hidden">
							</div>
						</div>
					</div>
					<div class="btn-del"><a class="btn fas fa-times-circle close-btn"></a></div>
					
				<?
			}	?>
					<div class="btn-buy"><a href="/newgamerswrld/shop/success.php" class="btn btn-success btn-buy-item">Оформить заказ</a></div>
				</div>
				<?
		}
		else
		{
				?><div class="empty-basket">В корзине нет товаров.</div><?
		}
	}
connecttoBase();
?>

<script type="text/javascript">
	
			// Меняем count
			function changeCount() {
				var currentCount = document.getElementById("num_count").value;
				var currentId = document.getElementById("checkid").value;
				
				$.ajax(
				{
					type: "POST",
					url: "/newgamerswrld/shop/countchange.php",
					data: {currentCount, currentId},
					success: function(data)
					{
						console.log(data);
						console.log('Успешно!');
					}
				});
			}
			
			
			$(document).ready(function() {
				
				// проверка для input
				$('.form-control').on('change, input', function()
				{
					var maxitemCount = Number($(this).attr('max'));
					var currentitemCount = Number($(this).val());

					if (currentitemCount > maxitemCount) {
						$(this).val(maxitemCount); 
					}

					if (currentitemCount < 1) {
						$(this).val(1);
					} 			
				});
				
				// Удаляем item
				$('.btn-del').click(function() {
					var basketId = document.getElementById("checkbasketid").value;
					$.ajax(
					{
						type: "POST",
						url: "/newgamerswrld/shop/delitem.php",
						data: {basketId},
						success: function(data)
						{
							console.log('Успешно!');
						}
					});
					location.reload();
				});
				
				// Оформляем заказ
				$('.btn-buy').click(function() {
					p = 1;
					$.ajax(
					{
						type: "POST",
						url: "/newgamerswrld/shop/neworder.php",
						data: {p},
						success: function(data)
						{
							console.log('Успешно!');
						}
					});					
				});
				
			});
</script>

<?php include ($_SERVER['DOCUMENT_ROOT']."/newgamerswrld/template/footer.php");?>