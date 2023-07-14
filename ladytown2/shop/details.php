<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/header.php");?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>
<?php
		$prodt_info = $mysqli->query(" SELECT * FROM prodt WHERE id_prodt = ".$_GET['id']." ");
		$prodt_row = mysqli_fetch_array($prodt_info);
?>

<!-- Details -->
<div class="page">
	<div class="details">
		<div class="page-header--details">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h1 class="header-title"><?=$prodt_row['name']?></h1>              
					</div>
					<div class="col-12">
						<ul class="breadcrumb">
							<a href="/ladytown/shop/">Магазин</a><?=$prodt_row['name']?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
				$varprodt_info = $mysqli->query(" SELECT * FROM varprodt WHERE prodt_id_prodt = ".$_GET['id']." ");
				$varprodt = mysqli_fetch_array($varprodt_info);
		?>
		<div class="page-inner">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-md-5 col-lg-6 card-image">
						<?php
						$vpcolor_info = $mysqli->query(" SELECT color_id_color, image FROM varprodt WHERE prodt_id_prodt = ".$_GET['id']." GROUP BY color_id_color");
						while ($row = mysqli_fetch_array($vpcolor_info)) { ?>
							<div data-color-id="<?=$row['color_id_color']?>">
								<img src="<?=$row['image']?>" alt="">
							</div>
						<?php }?>

					</div>
					<div class="col-12 col-md-7 col-lg-5 offset-lg-1 prod-inner">
						<div class="price-area">
							<div data-price>
								<h2><?=$prodt_row['price']?>₽</h2>
							</div>
							<?php
								$vpsize_info = $mysqli->query(" SELECT * FROM varprodt WHERE prodt_id_prodt = ".$_GET['id']." ");
								while ($row = mysqli_fetch_array($vpsize_info)) { ?>		
									<div data-price-id="<?=$row['id_varprodt']?>">
										<h2><?=$row['price']?>₽</h2>
									</div>
								<?php
								}
							?>
						</div>
						<form action="" method="post" class="details-form">
							<table>
								<tr class="prod-info">
									<td class="label-form-sec">
										<label>Выберите цвет</label>
									</td>
									<td>
										<div class="color-choose">
											<?php
													$vpcolor_info = $mysqli->query(" SELECT DISTINCT color_id_color FROM varprodt WHERE prodt_id_prodt = ".$_GET['id']." ");
													$fst_clr = 1;
													while ($row = mysqli_fetch_array($vpcolor_info)) {
														$color_catch = $mysqli->query(" SELECT * FROM colors WHERE id_color = ".$row['color_id_color']." ");
														$color_catch_row = mysqli_fetch_array($color_catch); ?>
														<div>
															<input class="color-radio <?php if ($fst_clr == 1) {?>active<?php }?>" id="<?=$color_catch_row['term']?>" data-color="<?=$color_catch_row['id_color']?>" type="radio" name="color" value="<?=$color_catch_row['term']?>">
															<label for="<?=$color_catch_row['term']?>"><span style="background-color: <?=$color_catch_row['code']?>"></span></label>
														</div>
														<?php
														$fst_clr++;
													}
											?>
										</div>
									</td>
								</tr>
								<tr class="prod-info">
									<td class="label-form-sec">
										<label>Выберите размер</label>
									</td>
									<td>
										<div class="size-choose">
											<?php
													$vpsize_info = $mysqli->query(" SELECT * FROM varprodt WHERE prodt_id_prodt = ".$_GET['id']." ");
													while ($row = mysqli_fetch_array($vpsize_info)) { 
													$size_catch = $mysqli->query(" SELECT * FROM sizes WHERE id_size = ".$row['size_id_size']." ");
													$size_catch_row = mysqli_fetch_array($size_catch); ?>
											<div data-color-id="<?=$row['color_id_color']?>">
												<input class="size-radio" type="radio" id="<?=$row['id_varprodt']?>" name="size" value="<?=$row['id_varprodt']?>">
												<label for="<?=$row['id_varprodt']?>"><span><?=$size_catch_row['name']?></span></label>
											</div>
											<?php
													}
											?>
										</div>
									</td>
								</tr>
							</table>
							<div class="add-basket">
								<button class="btn-c btn-main btn-form" id="add-basket" type="submit" disabled>Добавить в корзину</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/footer.php");?>