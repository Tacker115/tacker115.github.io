<?php

    //Запускаем сессию
    session_start();
 
    //Добавляем файл подключения к БД
    require_once($_SERVER['DOCUMENT_ROOT']."/ladytown/db/connect.php");

	//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
	$_SESSION['error_messages'] = '';
 
	//Объявляем ячейку для добавления успешных сообщений
	$_SESSION['success_messages'] = '';
	
	/*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
	*/
	if(isset($_POST['btn_submit_auth']) && !empty($_POST['btn_submit_auth']))
	{
		//Обрезаем пробелы с начала и с конца строки
		$login = trim($_POST['login']);
		if(isset($_POST['login']))
		{
			if(!empty($login))
			{
				$login = htmlspecialchars($login, ENT_QUOTES);
			}
			else
			{
				// Сохраняем в сессию сообщение об ошибке. 
				$_SESSION['error_messages'] .= "<p class='mesage_error' >Поле для ввода логина не должно быть пустым.</p>";
				//Возвращаем пользователя на страницу регистрации
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".$address_account."/form_register.php");
				//Останавливаем скрипт
				exit();
			}
		}
		else
		{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error' >Отсутствует поле для ввода логин</p>";
			//Возвращаем пользователя на страницу авторизации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_account."/form_auth.php");
			//Останавливаем скрипт
			exit();
		}
		if(isset($_POST['password']))
		{
			//Обрезаем пробелы с начала и с конца строки
			$password = trim($_POST['password']);
			if(!empty($password))
			{
				$password = htmlspecialchars($password, ENT_QUOTES);
				//Шифруем пароль
				//$password = md5($password.'top_secret');
			}
			else
			{
				// Сохраняем в сессию сообщение об ошибке. 
				$_SESSION['error_messages'] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";
				//Возвращаем пользователя на страницу регистрации
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".$address_account."/form_auth.php");
				//Останавливаем скрипт
				exit();
			}
		}
		else
		{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";
			//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_account."/form_auth.php");
			//Останавливаем скрипт
			exit();
		}

		//Запрос в БД на выборке пользователя.
		$result_query_select = $mysqli->query("SELECT * FROM users WHERE login = '".$login."' AND password = '".$password."' ");
		$row = mysqli_fetch_array($result_query_select);

		if(!$result_query_select)
		{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";
		}
		else
		{
			//Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
			if($result_query_select->num_rows == 1)
			{
				// Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
				$_SESSION['login'] = $login;
				$_SESSION['password'] = $password;
				//Возвращаем пользователя на главную страницу
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".$address_main."/index.php");
			}
			else
			{
				// Сохраняем в сессию сообщение об ошибке. 
				$_SESSION['error_messages'] .= "<script>alert('Неправильный логин и/или пароль');</script>";
				//Возвращаем пользователя на страницу авторизации
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: ".$address_account."/form_auth.php");
				//Останавливаем скрипт
				exit();
			}
		} 
	}
	else
	{
		exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_main."> главную страницу </a>.</p>");
	}