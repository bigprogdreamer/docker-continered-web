<?php
  session_start();
  if (!isset($_POST['csrf_token']))
  {
    die("CSRF-токен отсутствует.");
  }
  // Проверка соответствия токена в сессии предоставленному токену
  if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])
  {
    // Обработка ошибки: токены не совпадают
    die("CSRF-токены не совпадают.");
  }

  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $password = trim($_POST['password']); // Не фильтруем пароль, так как он может содержать специальные символы
  $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
  $city = trim(filter_var($_POST['city'], FILTER_SANITIZE_STRING));
  $gender = trim(filter_var($_POST['gender'], FILTER_SANITIZE_STRING)); // Предполагаем, что пол - это ограниченный набор значений, не нуждается в фильтрации
  $age = trim(filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT));

  if (mb_strlen($login) < 4 ){
    echo "Слишком короткий логин";
    exit();
  }
  else if (!($gender == "male" || $gender == "female"))
  {
    echo "У нас только 2 гендера!";
    exit();
  }

  $mysql = new mysqli('mysql-container', 'root', 'secret', 'flowers');
  if ($mysql->connect_error)
  {
    die("Ошибка соединения: " . $mysql->connect_error);
  }
  $password = md5($password . "aaaaaaaa");
  $mysql->begin_transaction();

  $statement = $mysql->prepare("INSERT INTO `users` (phone_number, password_a) VALUES (?, ?)");
  $statement->bind_param("ss", $login, $password);

  $success = $statement->execute();

  if (!$success) {
      echo "Ошибка при добавлении данных: " . $statement->error;
      $mysql->rollback();
      exit();
  }

  $res = $mysql->query("SELECT * FROM `users` WHERE `phone_number` = '$login' AND `password_a` = '$password'");
  $user = $res->fetch_assoc();


  $result = $mysql->query('INSERT INTO `client` (user_id, client_name, age, city, gender, total_spent, discount)
                            VALUES ("' . $user['id'] . '", "' . $name . '", ' . $age . ', "' . $city . '",
                            "' . $gender . '", 0, 0)');
  if (!$result) {
    echo "Данные не добавлены: клиент занят" ;
    $mysql->rollback();
    exit();
  }

  $mysql->commit(); //конец транзакции

  $_SESSION = array();
  session_destroy();
  header('Location: /');

  $mysql->close;

 ?>
