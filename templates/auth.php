<?php
  session_start();
  $mysql = new mysqli('mysql-container', 'root', 'secret', 'flowers');
  if ($mysql->connect_error) {
    die("Ошибка cоединения: " . $mysql->connect_error);}

  $login = trim($_GET['login']);
  $password = trim($_GET['password']);
  $login = filter_var($login, FILTER_SANITIZE_STRING);

  $password = md5($password . "aaaaaaaa");
  $res = $mysql->query("SELECT * FROM `users` WHERE `phone_number` = '$login' AND `password_a` = '$password'");
  $user = $res->fetch_assoc();

  if (count($user) == 0)
  {
    echo "Пользователь не найден, проверьте логин или пароль";
  }
  else
  {
    $_SESSION['user'] = $user['id']; // Сохраняем данные пользователя в сессии
    header('Location: /templates/user_page.php');
  }
  $mysql->close;
?>
