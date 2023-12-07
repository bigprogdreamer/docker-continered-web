<?php
$mysql = new mysqli('mysql-container', 'root', 'secret', 'flowers');
if ($mysql->connect_error)
{
  die("Ошибка cоединения: " . $mysql->connect_error);
}

// Допустим, $i - это ваш идентификатор товара, полученный откуда-то.

// Запрос для Flower
$queryFlower = "SELECT * FROM `Flower` WHERE `goods_id` = ?";
$stmtFlower = $mysql->prepare($queryFlower);
$stmtFlower->bind_param("i", $i);
$stmtFlower->execute();
$flowerResult = $stmtFlower->get_result();
$Flower = $flowerResult->fetch_assoc();
$stmtFlower->close();

// Запрос для Goods
$queryGoods = "SELECT * FROM `Goods` WHERE `goods_id` = ?";
$stmtGoods = $mysql->prepare($queryGoods);
$stmtGoods->bind_param("i", $i);
$stmtGoods->execute();
$goodsResult = $stmtGoods->get_result();
$Good = $goodsResult->fetch_assoc();
$stmtGoods->close();

// Закрытие соединения с базой данных
$mysql->close();
?>


<div class="col-sm-4">
  <div class="card card-sm shadow-sm">
    <img src="img/<?php echo $i?>.jpeg" class="img-thumbnail" alt="цветы" style="max-width: 300px; max-height: 300px;">
    <div class="card-body d-flex flex-column">
      <p class="card-text">
          Изысканное творение - <?php echo $Flower['flower_type']; ?> с завораживающим цветом - <?php echo $Flower['color']; ?>. Его восхитительный <?php echo $Flower['aroma']; ?> аромат пленяет чувства, создавая волшебный опыт. Своим изящным ростом <?php echo $Flower['height']; ?>, оно добавляет нотку изящества в любую обстановку.
      </p>
      <div class="mt-auto">
        <div class="btn-group">
          <form method="post" action="templates/payment.php">
              <button type="submit" class="btn btn-sm btn-outline-secondary">
                  <img src="img/buy-icon.jpeg" alt="корзина" style="width: 30px; height: 30px;">
              </button>
              <input type="hidden" name="price_per_item" value="<?php echo $Good['price_per_item']; ?>" />
          </form>
        </div>
        <small class="text-body-secondary">Цена за штуку: <?php echo $Good['price_per_item']; ?></small>
      </div>
    </div>
  </div>
</div>
