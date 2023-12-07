<html lang='ru'>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=deviece-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <style>
    body {
      background-image: url('/img/abstract-watercolor-background_23-2149054089.avif');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
    .btn-outline-secondary:hover {
      background-color: pink;
    }
    .card{
      width: 100%;
      height: 100%;
    }
  </style>
  <title>for course web-site</title>
</head>

<?php
$lk = $_SESSION['lk'];
$cabinet = $_SESSION['cabinet'];
?>

<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
    <a href="/index.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
      <img src="/img/shop icon.png" alt="Shop Icon" width="40" height="32" class="me-2">
      <span class="fs-4">Alexander Flower Shop</span>
    </a>
    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
      <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/index.php">Главная страница</a>
      <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/templates/about.php">О нас</a>
      <a class="me-3 py-2 link-body-emphasis text-decoration-none" href=<?php echo $lk; ?>> <?php echo $cabinet; ?> </a>
      <a class="py-2 link-body-emphasis text-decoration-none" href="/templates/registration.php">Регистрация</a>
    </nav>
</div>
