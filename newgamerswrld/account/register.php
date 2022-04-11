<?php
    //Запускаем сессию
    session_start();
 
    //Добавляем файл подключения к БД
    require_once("dbconnect.php");
	
	//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION['error_messages'] = '';
 
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION['success_messages'] = '';

    /*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
    */
    if(isset($_POST['btn_submit_register']) && !empty($_POST['btn_submit_register'])){
     
	if(isset($_POST['login'])){
	 
		//Обрезаем пробелы с начала и с конца строки
		$login = trim($_POST['login']);
	 
		if(!empty($login)){
	 
			$login = htmlspecialchars($login, ENT_QUOTES);
			 
			//Проверяем нет ли уже такого адреса в БД.
			$result_query = $mysqli->query("SELECT login FROM dbusers WHERE login = '".$login."' ");
			 
			//Если кол-во полученных строк ровно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
			if($result_query->num_rows == 1){
			 
				//Если полученный результат не равен false
				if(($row = $result_query->fetch_assoc()) != false){
					 
						// Сохраняем в сессию сообщение об ошибке. 
						$_SESSION['error_messages'] .= "<script>alert('Пользователь с таким логином уже зарегистрирован!');</script>";
						 
						//Возвращаем пользователя на страницу регистрации
						header("HTTP/1.1 301 Moved Permanently");
						header("Location: ".$address_site."/form_register.php");
					 
				}else{
					// Сохраняем в сессию сообщение об ошибке. 
					$_SESSION['error_messages'] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";
					 
					//Возвращаем пользователя на страницу регистрации
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: ".$address_site."/form_register.php");
				}
			 
				/* закрытие выборки */
				$result_query->close();
			 
				//Останавливаем  скрипт
				exit();
			}
			 
			/* закрытие выборки */
			$result_query->close();
	 
		}else{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error'>Укажите Ваш login</p>";
			 
			//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."/form_register.php");
	 
			//Останавливаем  скрипт
			exit();
			}
		 
		}else{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error'>Отсутствует поле для ввода Логин</p>";
			 
			//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."/form_register.php");
		 
			//Останавливаем  скрипт
			exit();
		}
	 
	 
	if(isset($_POST['password'])){
	 
		//Обрезаем пробелы с начала и с конца строки
		$password = trim($_POST['password']);
	 
		if(!empty($password)){
			$password = htmlspecialchars($password, ENT_QUOTES);
	 
			//Шифруем папроль
			//$password = md5($password.'top_secret'); 
		}else{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error'>Укажите Ваш пароль</p>";
			 
			//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."/form_register.php");
	 
			//Останавливаем  скрипт
			exit();
		}
	 
		}else{
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error'>Отсутствует поле для ввода пароля</p>";
			 
			//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."/form_register.php");
		 
			//Останавливаем  скрипт
			exit();
		}
	
	if(isset($_POST['name'])){

                //Обрезаем пробелы с начала и с конца строки
                $name = trim($_POST['name']);

                if(!empty($name)){
                    // Для безопасности, преобразуем специальные символы в HTML-сущности
                    $name = htmlspecialchars($name, ENT_QUOTES);
                }else{

                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION['error_messages'] .= "<p class='mesage_error'>Укажите Ваше имя</p>";
                    
                    //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    //Останавливаем  скрипт
                    exit();
                }
      
            }else{

                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION['error_messages'] .= "<p class='mesage_error'>Отсутствует поле с именем</p>";
                
                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }
			
	if(isset($_POST['phone'])){

                //Обрезаем пробелы с начала и с конца строки
                $phone = trim($_POST['phone']);

                if(!empty($phone)){
                    // Для безопасности, преобразуем специальные символы в HTML-сущности
                    $phone = htmlspecialchars($phone, ENT_QUOTES);
                }else{

                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION['error_messages'] .= "<p class='mesage_error'>Укажите Ваш телефон</p>";
                    
                    //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    //Останавливаем  скрипт
                    exit();
                }

                
            }else{

                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION['error_messages'] .= "<p class='mesage_error'>Отсутствует поле с телефоном</p>";
                
                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                //Останавливаем  скрипт
                exit();
            }

		//Запрос на добавления пользователя в БД
		$result_query_insert = $mysqli->query("INSERT INTO dbusers (login, password, name, phone) VALUES ('".$login."', '".$password."', '".$name."','".$phone."')");
		 
		if(!$result_query_insert){
			// Сохраняем в сессию сообщение об ошибке. 
			$_SESSION['error_messages'] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";
			 
			//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."/form_register.php");
		 
			//Останавливаем  скрипт
			exit();
		}else{
		 
			$_SESSION['success_messages'] = "<script>alert('Вы успешно зарегистрировались в системе! Теперь Вы можете авторизоваться используя Ваш логин и пароль.');</script>";
		 
			//Отправляем пользователя на страницу авторизации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$address_site."/form_auth.php");
		}
		 
		/* Завершение запроса */
		$result_query_insert->close();
		 
		//Закрываем подключение к БД
		$mysqli->close();
	
	
	}else{
 
        exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_main."> главную страницу </a>.</p>");
    }

?>