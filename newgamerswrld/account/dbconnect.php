<?php
 
    $server = "localhost"; // имя хоста (уточняется у провайдера), если работаем на локальном сервере, то указываем localhost
    $username = "root"; // Имя пользователя БД
    $password = "=xbQXvR9NhNBJQ0Q?%2]"; // Пароль пользователя. Если у пользователя нету пароля то, оставляем пустое значение ""
    $database = "dbgamerswrld"; // Имя базы данных, которую создали
     
    // Подключение к базе данных через MySQLi
    $mysqli = new mysqli($server, $username, $password, $database);
 
    // Проверяем, успешность соединения. 
    if ($mysqli->connect_errno)
	{ 
        die("<p><strong>Ошибка подключения к БД</strong></p><p><strong>Код ошибки: </strong> ". $mysqli->connect_errno ." </p><p><strong>Описание ошибки:</strong> ".$mysqli->connect_error."</p>"); 
    }
	else
	{
		//echo 'соединение есть';
	}
 
    // Устанавливаем кодировку подключения
    $mysqli->set_charset('utf8');
	
	$address_site = "/newgamerswrld/account";
	$address_main = "/newgamerswrld";
 
?>