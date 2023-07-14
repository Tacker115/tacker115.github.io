<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/header.php");?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>

<!-- Basket -->
<div class="page">
    <div class="basket">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="header-title">Корзина</h1>
                    </div>
                    <div class="col-12">
                        <ul class="breadcrumb">
                            <a href="/ladytown/">Главная</a> Корзина
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <?php
            $basket = $mysqli->query(" SELECT varprodt_id_varprodt, SUM(varprodt_count) AS count FROM baskets GROUP BY varprodt_id_varprodt ");
            if ($basket->num_rows > 0) {     
        ?>
        <div class="page-inner">
            <div class="container">
                <div class="content-basket-inner">
                    <table class="table-basket">
                        <thead class="table-basket-thead">
                            <tr>
                                <th class="table-title media-table" scope="col">Товар</th>
                                <th class="table-title" scope="col">Цена</th>
                                <th class="table-title" scope="col">Количество</th>
                                <th class="table-title" scope="col">Всего</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            while ($row = mysqli_fetch_array($basket)) {
                            $basket_join = $mysqli->query(" SELECT '".$row['varprodt_id_varprodt']."' AS id, '".$row['count']."' AS count, v.name, v.price, v.image, v.count AS maxcount, v.prodt_id_prodt AS prodt_id FROM baskets b, varprodt v WHERE '".$row['varprodt_id_varprodt']."' = v.id_varprodt");
                            $brow = mysqli_fetch_array($basket_join);
                            $id = $brow['id'];
                            $prodt_id = $brow['prodt_id'];
                            $name = $brow['name'];
                            $image = $brow['image'];
                            $price = $brow['price'];
                            $count = $brow['count'];
                            $maxcount = $brow['maxcount'];
                            $cost = $price*$count;
                            $sum += $cost;
                            ?>
                            <tr class="basket-card" data-tr-basket="<?=$id?>">
                                <td class="media-inner">
                                    <div class="media d-flex align-items-center">
                                        <a class="remove btn-del" id="<?=$id?>" aria-label="Удалить эту позицию"><span>x</span></a>
                                        <div class="media-img">
                                            <a href="/ladytown/shop/details.php?id=<?=$id?>" class="media-link">
                                                <img src="<?=$image?>" alt="">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="/ladytown/shop/details.php?id=<?=$id?>" class="media-link"><?=$name?></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-price" data-td-basket="<?=$id?>">
                                    ₽<?=$price?>
                                </td>
                                <td class="product-quantity">
                                	<span>
                                		<input type="number" class="input-qty qty-basket" step="1" min="1" max="<?=$maxcount?>" value="<?=$count?>" title="Кол-во" data-td-basket="<?=$id?>">
			                        </span>
                                </td>
                                <td class="product-subtotal" data-td-basket="<?=$id?>">
                                    ₽<?=$cost?>
                                </td>
                            </tr>
                            <?php
                                 } ?>  
                        </tbody>
                    </table>

                    <div class="basket-inner">
                        <div class="basket-total-btns">
                            <div class="basket-tot-num">Итого: <span class="sum-result">₽<?=$sum?></span></div>
                            <div class="apply-order">
                                <a href="order.html" class="btn-c btn-main go-order">Оформить заказ</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php 
            } 
            else {
            ?>
            <div class="container basket-null">Корзина пуста!</div>
        <?php
        }
        ?>
    </div>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/footer.php");?>

