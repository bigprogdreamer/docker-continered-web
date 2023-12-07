<?php
session_start();
$client_data = $_SESSION['client'];
$cabinet = "вход в личный кабинет";
$lk = "/templates/kabinet.php";
if ($client_data['client_name'] != "")
{
  $cabinet = $client_data['client_name'];
  $lk = "/templates/user_page.php";
}
$_SESSION['lk'] = $lk;
$_SESSION['cabinet'] = $cabinet;
?>

<?php
  include 'templates/header.php';
  $mysql = new mysqli('mysql-container', 'root', 'secret', 'flowers');
  if ($mysql->connect_error)
  {
    die("Ошибка cоединения: " . $mysql->connect_error);
  }
  $stmt = $mysql->prepare("SELECT * FROM `Goods`");
  if ($stmt === false)
  {
    die("Error in preparing the SQL statement");
  }

  $stmt->execute();

  $res = $stmt->get_result();

  $row_count = 0;
  if ($res)
  {
      $row_count = $res->num_rows;
  }
  $stmt->close();
  $mysql->close;
?>




<body>
    <div class="container">
      <h2 class="mb-5"> Наши продукты </h2>
      <div class="d-flex flex-wrap">
        <?php
          for ($i = 1; $i <= $row_count; $i++):
              include 'templates/card.php';
          endfor;
         ?>
      </div>
    </div>
</body>
</html>
