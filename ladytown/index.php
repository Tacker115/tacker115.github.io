<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/header.php");?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>

<!-- Intro -->
<div class="intro" id="intro">
	<div class="container">
		<div class="row">
			
			<div class="order-2 order-md-1 col-md-7">
				<div data-slider1 class="data-slider1">
					<div>
						<div class="sl1-item sl1-fst">
							<div class="intro-inner">
								<div class="intro-title">Новые поступления в этом сезоне</div>
								<div class="intro-text">Утонченные сочетания и бархатные оттенки - вот то, что вы искали в этом сезоне. Время исследовать.</div>
							</div>
						</div>
					</div>
					<div>
						<div class="sl1-item sl1-fst">
							<div class="intro-inner">
								<div class="intro-title">Что-то новенькое! Мы заждались тебя!</div>
								<div class="intro-text">Надоело искать себя в сером городе? Настало время новых идей, свежих красок и вдохновения с ladytown!</div>
							</div>
						</div>
					</div>
					<div>
						<div class="sl1-item sl1-fst">
							<div class="intro-inner">
								<div class="intro-title">Включай новый сезон с ladytown</div>
								<div class="intro-text">Мы обновили ассортимент - легендарные коллекции и новинки от отечественных дизайнеров</div>
							</div>
						</div>
					</div>
				</div>
				<div class="intro-btn">
					<button id="scroll__down" class="intro-btn-fst" data-section="#newcol" type="button">
                		<img class="scroll-down" src="/ladytown/img/scroll-down.svg" alt="">
                	</button>
					<a class="btn-c btn-main intro-btn-scnd" href="/ladytown/shop/">Открыть магазин</a>
				</div>
			</div>


			<div class="order-1 order-md-2 col-md-5 rs" id="rs">
				<div class="rs-bcg" id="bcg"></div>
				<div class="rs-inner">
					<div class="iside intro-ls"><img src="/ladytown/img/intro-ls.png" alt=""></div>
					<div class="iside intro-rs"><img src="/ladytown/img/intro-rs.png" alt=""></div>
					<div data-slider2 class="data-slider2">
						<div><div class="intro-image"><img src="/ladytown/img/intro-1.jpg" alt=""></div></div>
						<div><div class="intro-image"><img src="/ladytown/img/intro-2.jpg" alt=""></div></div>
						<div><div class="intro-image"><img src="/ladytown/img/intro-3.jpg" alt=""></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- NewCol -->	
<section class="fst-sec" id="newcol">
	<div class="container">
		<div class="section-title">Новая коллекция</div>
		<div class="cards">
			<div class="row justify-content-between">
				<?php 
					$result_query_select = $mysqli->query("SELECT * FROM prodt ORDER BY added DESC limit 3");
					while ($row = mysqli_fetch_array($result_query_select)) {
				?>
				<div class="col-12 col-sm-6 col-lg-4">
					<div class="card-item">
						<div class="card-item-img">
							<a class="card-img-link" href="/ladytown/shop/details.php?id=<?=$row['id_prodt']?>"></a>
							<img class="card-item-linkmore" src="/ladytown/img/card-more.svg" alt="">
							<img class="card-img" src="<?=$row['image']?>" alt="">
						</div>
						<a class="card-title-link" href="/ladytown/shop/details.php?id=<?=$row['id_prodt']?>"><?php echo $row['name'];?></a>
						<div class="card-price"><?=$row['price']?>₽</div>
					</div>	
				</div>
				<?php
				}
				?>
			</div>	
		</div>
		<div class="col-12 btn-newcol">
			<a class="btn-c btn-trivial" href="/ladytown/shop/">Открыть магазин</a>
		</div>	
	</div>
</section>

<!-- Services -->	
<section>
	<div class="container">
		<div class="section-title">Что для нас важно</div>
		<div class="services">
			<div class="row justify-content-between">
				<div class="col-12 col-sm-6 col-md-4 services-item">
					<img class="services-icon" src="/ladytown/img/quality.svg" alt=""></a>
					<h3 class="services-title">Качество</h3>
					<p class="services-text">Наши профессионалы работают на лучшем оборудовании для пошива одежды беспрецедентного качества</p>
				</div>
				<div class="col-12 col-sm-6 col-md-4 services-item">
					<img class="services-icon" src="/ladytown/img/speed.svg" alt=""></a>
					<h3 class="services-title">Скорость</h3>
					<p class="services-text">Благодаря отлаженной системе в ladytown мы можем отшивать до 20-ти единиц продукции в наших собственных цехах</p>
				</div>
				<div class="col-12 col-sm-6 col-md-4 services-item">
					<img class="services-icon" src="/ladytown/img/responsibility.svg" alt=""></a>
					<h3 class="services-title">Ответственность</h3>
					<p class="services-text">Мы заботимся о людях и планете. Безотходное производство и комфортные условия труда - все это ladytown</p>
				</div>
			</div>	
		</div>
	</div>
</section>

<!-- Team -->	
<section>
	<div class="container">
		<div class="section-title">Команда мечты ladytown</div>
		<div class="team">
			<div class="row align-items-center justify-content-between">
				<div class="col-12 col-xl-8 sl3-area">
					<div data-slider3 class="data-slider3">
						<div>
							<div class="sl3-item sl1-fst">
								<img src="/ladytown/img/sl3-1.png" alt="">
							</div>
						</div>
						<div>
							<div class="sl3-item sl1-fst">
								<img src="/ladytown/img/sl3-2.png" alt="">
							</div>
						</div>
						<div>
							<div class="sl3-item sl1-fst">
								<img src="/ladytown/img/sl3-3.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="col-10 col-xl-3 offset-xl-1 sl3-text">
					<div class="d-flex justify-content-center flex-column h-100">
						<h3>Для каждой</h3>
						<p class="team-text">Каждая девушка уникальна. Однако, мы схожи в миллионе мелочей. <br><br>ladytown ищет эти мелочи и создает прекрасные вещи, которые выгодно подчеркивают достоинства каждой девушки.</p>
						<a href="/ladytown/about/" class="more-link">Подробнее о бренде</a>
					</div>
				</div>
			</div>	
		</div>
	</div>
</section>

<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/footer.php");?>