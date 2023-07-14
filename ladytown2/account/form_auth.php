<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/ladytown/template/bootstrap.min.css">
<link rel="stylesheet" href="/ladytown/template/slick.css">
<link rel="stylesheet" href="/ladytown/template/style.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/ladytown/template/bootstrap.min.js"></script>
<script src="/ladytown/template/slick.js"></script>
<script src="/ladytown/template/script.js"></script>

<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
		//Если в сессии существуют сообщения об ошибках, то выводим их
        if(isset($_SESSION['error_messages']) && !empty($_SESSION['error_messages'])){
            echo $_SESSION['error_messages'];
 
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION['error_messages']);
        }
		
		//Если в сессии существуют радостные сообщения, то выводим их
        if(isset($_SESSION['success_messages']) && !empty($_SESSION['success_messages'])){
            echo $_SESSION['success_messages'];
             
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION['success_messages']);
        }
    ?>
</div>
 
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
?>
 
<div class="auth-area">
    <div id="form_auth" class="auth-form">
        <form action="/ladytown/account/auth.php" method="post" name="form_auth" class="form-sys">
            <h2>Вход</h2>
			<div class="form-group-sys">
				<div class="form-field-wrap">
				<label class="no-label" for="login">Логин</label>
                    <input id="login" type="login" class="form-field" name="login" required="required">
                    <span id="login-label" class="focus-input" data-placeholder="Логин"></span>
				</div>
			</div>
			<div class="form-group-sys">	
				<div class="form-field-wrap">
				<label class="no-label" for="password">Пароль</label>
					<span class="pass-toggle pass-hide"><ion-icon name="eye"></ion-icon></span>
                    <input id="password" type="password" class="form-field" name="password" required="required">
                    <span id="password-label" class="focus-input" data-placeholder="Пароль"></span>
				</div>
			</div>	
			<div class="form-sys-btn2">
				<input class="btn btn-outline-success" type="submit" name="btn_submit_auth" value="Войти">
			</div>
        </form>
    </div>
 
<?php
    }else{
?>
 
    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
    </div>
 
<?php
    }
?>
</div>

<script>
	$(".form-field").each(function() {	
		$(this).on("blur", function() {
			if (this.value != "") {
				$(this).addClass("filled");
			}
			else { 
				$(this).removeClass("filled");
				}
			})		
	});
</script>
