<?php
session_start();
$user_id = $_SESSION['user'];
if ($user_id <= 0)
{
  header("Location:/templates/kabinet.php");
  exit();
}
$mysql = new mysqli('mysql-container', 'root', 'secret', 'flowers');
if ($mysql->connect_error)
{
  die("Ошибка соединения: " . $mysql->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id != 0)
{
    $price_per_item = $_POST["price_per_item"];
    $current_time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO `cheque` (client_id, employee_id, time_bought, payment_method, total_summ) VALUES ($user_id, 1, '$current_time', 'card', $price_per_item)";
    if ($mysql->query($sql) === TRUE)
    {
        header("Location:/templates/user_page.php");
        exit(); // Обязательно завершите выполнение скрипта после вызова header
    }
    else
    {
        echo "Ошибка: " . $sql . "<br>" . $mysql->error;
    }
}

  $mysql->close;
?>
