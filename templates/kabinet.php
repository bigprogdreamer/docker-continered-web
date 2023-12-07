<?php session_start();?>
<head>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <div class="container" style="max-width: 600px; margin-top: 60px;">
    <h2> Вход в личный кабинет </h2>
    <form action="/templates/auth.php" method="get">
      <input type="text" class="form-control" name="login"
      id="login" placeholder="Введите логин">
      <input type="text" class="form-control" name="password"
      id="password" placeholder="Введите пароль">
      <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
      <button class="btn btn-primary w-100 py-2" type="submit">Авторизация</button>
    </form>
  </div>
</body>
