<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/header.php");?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>

<!-- Shop -->
<div class="page">
	<div class="shop">
		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h1 class="header-title">Магазин</h1>              
					</div>
					<div class="col-12">
						<ul class="breadcrumb">
							 <a href="/ladytown/">Главная</a> Магазин 
						</ul>
					</div>

				</div>
			</div>
		</div>

		<div class="page-inner">
			<div class="container">
				<div class="shop-inner-btn">
					<div class="row">
              			<div class="col-lg-12">
              				<ul class="shop-btns-area">
              					<li class="shop-category active" data-filter="0">
              						<a href="#">
              							<h2 class="shop-category-title">Все</h2>
              						</a>
              					</li>
              					<?php 
									$result_query_select = $mysqli->query("SELECT * FROM categories");
									while ($row = mysqli_fetch_array($result_query_select)) { ?>
							        <li class="shop-category" data-filter="<?php echo $row['id_category']; ?>">
	              						<a href="#">
	              							<h2 class="shop-category-title"><?php echo $row['name']; ?></h2>
	              						</a>
              						</li>
						    	<?php 
						    		} 
						    	?>
              				</ul>
              			</div>	
              		</div>
				</div>

				<div class="shop-prod">
					<div class="prod-count-info">
						<?php 
							$result_query_select = $mysqli->query("SELECT * FROM prodt ORDER BY added DESC");
						?>
						<p>Показано <span class='pcf-value'></span> из <?php echo $result_query_select->num_rows;?> товаров</p>
					</div>
					<div class="prod-area">
						<div class="row">
							<?php 
								while ($row = mysqli_fetch_array($result_query_select)) {
							?>
							<div class="col-12 col-sm-6 col-lg-4" data-category="<?=$row['categories_id_category']?>">
								<div class="card-item">
									<div class="card-item-img">
										<a class="card-img-link" href="/ladytown/shop/details.php?id=<?=$row['id_prodt']?>"></a>
										<img class="card-item-linkmore" src="/ladytown/img/card-more.svg" alt="">
										<img class="card-img" src="<?=$row['image']?>" alt="">
									</div>
									<a class="card-title-link" href="/ladytown/shop/details.php?id=<?=$row['id_prodt']?>"><?=$row['name']?></a>
									<div class="card-price"><?=$row['price']?>₽</div>
								</div>	
							</div><?php
							}
							?>
						</div>
					</div>
					<div class="prod-count-info">
						<p>Показано <span class='pcf-value'></span> из <?php echo $result_query_select->num_rows;?> товаров</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/footer.php");?>