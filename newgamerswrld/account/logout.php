<?php
    //Запускаем сессию
    session_start();
	
	unset($_SESSION['id']);	
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    unset($_SESSION['name']);
    unset($_SESSION['phone']);

    // Возвращаем пользователя на ту страницу, на которой он нажал на кнопку выход.
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$_SERVER["HTTP_REFERER"]);
?>