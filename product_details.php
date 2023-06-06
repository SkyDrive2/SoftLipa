<?php
include "db_connect.php";
include './component/header.php';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>任性的人</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">
  <link rel="stylesheet" type="text/css" href="./styles/product_detail.css">
  <script src="https://kit.fontawesome.com/00b6be94d5.js" crossorigin="anonymous"></script>

  <style>
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 98%;
      z-index: 9999;
    }


    .for-header {
      padding-top: 150px;
    }
  </style>
</head>

<body>

  <div class="for-header"></div>
  <div class="containAll">
    <?php
    $productID = $_GET['id'];

    // 編寫 SQL 查詢
    $sql = "SELECT * FROM Products WHERE ProductID = $productID";

    // 執行查詢
    $result = $conn->query($sql);

    // 檢查查詢結果是否存在
    if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      // 顯示商品詳細資料
      $productDescription = str_replace('\n', "\n", $row['ProductDescription']);
      ?>
      <div class="container">
        <div class="product-photo">
          <img src="<?php echo $row['ProductPhoto']; ?>" alt="Product Photo">
        </div>
        <div class="product-details">
          <div class="product-info">
            <h1>
              <?php echo $row['ProductName']; ?>
            </h1>
            <p class="product-price">NT$
              <?php echo intval($row['Price']); ?>
            </p>

            <div class="quantity-wrapper">
              <label class="quantity-label">數量</label>
              <div class="quantity-input-group with-border">
                <button class="quantity-btn decrement" type="button"><i class="fa fa-minus"></i></button>
                <input class="quantity-input" type="text" name="quantity">
                <button class="quantity-btn increment" type="button"><i class="fa fa-plus"></i></button>
              </div>


              <div class="add-to-cart ">
                <form action="addToCart.php" method="post">
                  <input type="hidden" id="hiddenQuantity" name="quantity" value='1'>
                  <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                  <input type="hidden" name="sourcePage" value="product_details">
                  <button type="submit">加入購物車</button>
                </form>
                <script>
                  var decrementBtn = document.querySelector('.quantity-btn.decrement');
                  var incrementBtn = document.querySelector('.quantity-btn.increment');
                  var quantityInput = document.querySelector('.quantity-input');
                  var hiddenQuantity = document.getElementById('hiddenQuantity');
                  quantityInput.value = 1;
                  decrementBtn.addEventListener('click', function () {
                    var currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                      quantityInput.value = currentValue - 1;
                      hiddenQuantity.value = quantityInput.value;
                    }
                  });

                  incrementBtn.addEventListener('click', function () {
                    var currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                    hiddenQuantity.value = quantityInput.value;
                  });
                </script>
                <p class="product-quantity">現庫存只剩下
                  <?php echo $row['StockQuantity']; ?>件
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="product-description">
        <h2><span>商品描述</span></h2>
        <p>
          <?php echo nl2br($productDescription); ?>
        </p>
      </div>


      <div class="wave"></div>
      <div class="wave"></div>
      <div class="wave"></div>
      <?php
    } else {
      echo "找不到該商品。";
    }

    // 關閉連線
    $conn->close();
    ?>

  </div>

</body>

</html>