<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/header.php");?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");?>

<!-- Order -->
<div class="page">
    <div class="order">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="header-title">Оформление заказа</h1>
                    </div>
                    <div class="col-12">
                        <ul class="breadcrumb">
                            <a href="/ladytown/">Главная</a>
                            <a href="/ladytown/shop/basket.php">Корзина</a> Оформление заказа
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-inner">
            <div class="container">
                <form action="" method="post" class="order-form">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="customer-field">
                                <h3 class="order-form-title">Данные покупателя</h3>
                                <input type="text" name="Name" class="customer-input" placeholder="Имя" onkeyup="this.value = this.value.replace(/[^А-Яа-яЁё -]/g, '');" maxlength="15">
                                <input type="email" name="Email" class="customer-input" placeholder="E-mail"
                                onkeyup="this.value = this.value.replace(/[^a-z0-9@.-]/g, '');" maxlength="30">
                                <input type="tel" name="Phone" class="customer-input" placeholder="Телефон" onkeyup="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11">
                            </div>
                            <div class="customer-field">
                                <h3 class="order-form-title">Адрес получателя</h3>
                                <input type="text" name="Index" class="customer-input" placeholder="Почтовый индекс" onkeyup="this.value = this.value.replace(/[^A-Za-z0-9 -]/g, '');" maxlength="15">
                                <input type="text" name="Country" class="customer-input" placeholder="Страна" onkeyup="this.value = this.value.replace(/[^А-Яа-яЁё -]/g, '');" maxlength="15">
                                <input type="text" name="City" class="customer-input" placeholder="Город" onkeyup="this.value = this.value.replace(/[^А-Яа-яЁё -]/g, '');" maxlength="15">
                                <input type="text" name="Street" class="customer-input" placeholder="Улица" onkeyup="this.value = this.value.replace(/[^А-Яа-яЁё -]/g, '');" maxlength="15">
                                <input type="text" name="House" class="customer-input" placeholder="Дом" onkeyup="this.value = this.value.replace(/[^А-Яа-яЁё0-9/]/g, '');" maxlength="5">
                                <input type="num" name="Flat" class="customer-input" placeholder="Квартира" onkeyup="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="5">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-1 col-lg-6 offset-lg-2">
                            <div class="info-order">
                                <h3 class="order-form-title">Ваш заказ</h3>
                                <table class="table-order">
                                    <thead>
                                        <tr>
                                            <th scope="col">Товар</th>
                                            <th scope="col">Кол-во</th>
                                            <th scope="col">Всего</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sum = 0;
                                        $connectbasket = $mysqli->query(" SELECT varprodt_id_varprodt, varprodt_count FROM baskets ");
                                        while ($row = mysqli_fetch_array($connectbasket)) {
                                        $id = $row['varprodt_id_varprodt'];
                                        $count = $row['varprodt_count'];
                                        $basket_join = $mysqli->query(" SELECT '".$id."' AS id, '".$count."' AS count, v.name, v.price FROM baskets b, varprodt v WHERE '".$id."' = v.id_varprodt");
                                        $brow = mysqli_fetch_array($basket_join);
                                        $name = $brow['name'];
                                        $pos = strpos($name, ',');
                                        $ename = substr($name, 0, $pos);
                                        $price = $brow['price'];
                                        $cost = $price*$count;
                                        $sum += $cost;
                                        ?>
                                        <tr>
                                            <td><?=$ename?></td>
                                            <td><?=$count?></td>
                                            <td>₽<?=$cost?></td>
                                        </tr><?php
                                        } ?>
                                        <tr class="order-res">
                                            <td>Всего</td>
                                            <td></td>
                                            <td>₽<?=$sum?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="payment">
                                <button class="btn-c btn-main make-offer" type="submit" name="make-offer" value="Разместить заказ" disabled>Разместить заказ</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT']."/ladytown/template/footer.php");?>