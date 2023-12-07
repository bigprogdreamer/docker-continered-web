<?php
session_start();
$csrfToken = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrfToken;
?>
    
<html>
  <head>
    <?php include 'header.php'; ?>
    <style>
      body {
        background-image: url('/img/registration.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <h2> Регистрация </h2>
      <form action="/templates/check.php" method="post">
        <input type="text" class="form-control" name="login"
        id="login" placeholder="Введите логин">
        <input type="text" class="form-control" name="password"
        id="password" placeholder="Введите пароль">
        <input type="text" class="form-control" name="name"
        id="name" placeholder="Введите имя">
        <input type="text" class="form-control" name="city"
        id="city" placeholder="Ваш город">
        <input type="text" class="form-control" name="gender"
        id="gender" placeholder="Пол">
        <input type="number" class="form-control" name="age"
        id="age" placeholder="age">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <button class="btn-success" type="submit" style="margin-top: 20px;">Зарегистрировать нового пользователя</button>

      </form>
    </div>
  </body>
</html>
