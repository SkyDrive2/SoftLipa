<?php
include "db_connect.php";
include './component/header.php';
session_start();
if (!isset($_SESSION['UserID'])) {
  $_SESSION['NoLog'] = true;
  echo '<script>alert("要登入才能買東西阿！不然我哪知道你誰");</script>';
  echo '<script>window.location.href = "login.php";</script>';
  exit();
}

$userid = $_SESSION['UserID'];


$sql = "SELECT P.ProductPhoto,P.ProductName, P.Price, SC.*FROM ShoppingCart SC JOIN Products P ON SC.ProductID = P.ProductID WHERE SC.UserID = $userid;";
$result = $conn->query($sql);


// 存儲商品資料的陣列
$carts = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $carts[] = $row;
}

// 關閉資料庫連線
$conn = null;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>購物車</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">
  <link rel="stylesheet" type="text/css" href="./styles/cart.css">
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

  <body>

    <div class="all-carts">
      <table class="cart-table">
        <thead>
          <tr>

            <th>商品</th>
            <th>單價</th>
            <th>數量</th>
            <th>總計</th>
            <th>操作</th>

          </tr>
        </thead>
        <tbody>
          <?php
          // 假設 $carts 是從資料庫取得的購物車商品
          foreach ($carts as $cart) {
            // 取得商品資訊
            $productID = $cart['ProductID'];
            $productName = $cart['ProductName'];
            $price = $cart['Price'];
            $stockQuantity = $cart['StockQuantity'];
            $productPhoto = $cart['ProductPhoto'];
            $quantity = $cart['Quantity'];

            // 計算小計
            $subtotal = $price * $quantity;
            ?>
            <tr>
              <td class="check">
                <!-- 這裡放入勾選商品的邏輯 -->
              </td>
              <td class="product-con">
                <div class="product">
                  <img src="<?php echo $productPhoto; ?>" alt="Product Photo" class="product-image">
                  <div class="product-name-con">
                    <div class="product-name">
                      <?php echo $productName; ?>
                    </div>
                  </div>
                </div>
              </td>
              <td class="price-con">
                <span class="price">$
                  <?php echo intval($price); ?>
                </span>
              </td>
              <td class="quantity-input-group">
                <div class="input-con">
                  <button class="quantity-btn decrement" type="button"><i class="fa fa-minus"></i></button>
                  <input class="quantity-input" type="text" name="quantity" value="<?php echo $quantity; ?>">
                  <button class="quantity-btn increment" type="button"><i class="fa fa-plus"></i></button>
                </div>
              </td>
              <td class="subtotal">$
                <?php echo $subtotal; ?>
              </td>
              <td><button class="delete-button">刪除</button></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="total-amount">
      <!-- 這裡放入總金額的顯示 -->
    </div>
    </div>
    <button class="checkout-button">結帳</button>

    <script>
    // JavaScript程式碼
    </script>

  </body>

</html>