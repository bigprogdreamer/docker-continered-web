<?php session_start();?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=deviece-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <title>User Profile</title>
  <link rel="stylesheet" href="/css/style.css">
</head>

<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
    <a href="/index.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
      <img src="/img/shop icon.png" alt="Shop Icon" width="40" height="32" class="me-2">
      <span class="fs-4">Alexander Flower Shop</span>
    </a>
    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
      <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/index.php">Главная страница</a>
      <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/templates/about.php">О нас</a>
      <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/templates/user_page.php">личный кабинет</a>
      <a class="py-2 link-body-emphasis text-decoration-none" href="/templates/registration.php">Регистрация</a>
    </nav>
</div>

<body>
  <?php
    $mysql = new mysqli('mysql-container', 'root', 'secret', 'flowers');

    if ($mysql->connect_error)
    {
      die("Ошибка cоединения: " . $mysql->connect_error);
    }

    if(isset($_SESSION['user']))
    {
        $user = intval($_SESSION['user']);
        $res = $mysql->query("SELECT * FROM `client` WHERE `user_id` = ' $user '");
        $client_data = $res->fetch_assoc();
        $_SESSION['client'] = $client_data;
    }
    else
    {
        echo "Данные пользователя не найдены";
        $user = intval($_SESSION['user']);
        echo $user;

    }
    $mysql->close;
  ?>
  <div class="container mt-3">
    <h1> <?php $client_data['client_name'] ?> Profile</h1>

  <form action="logout.php" method="post">
      <div class="card mt-4" style="width: 18rem;">
          <div class="card-body">
              <h5 class="card-title"><?php echo $client_data['client_name']; ?></h5>
              <p class="card-text">Age: <?php echo $client_data['age']; ?></p>
              <p class="card-text">Gender: <?php echo $client_data['gender']; ?></p>
              <p class="card-text">Spending: <?php echo $client_data['total_spent']; ?></p>
              <p class="card-text">City: <?php echo $client_data['city']; ?></p>
          </div>
          <button class="btn-success" type="submit" style="margin-top: 20px;">выйти из акканута</button>
      </div>
  </form>
  </div>

</body>
