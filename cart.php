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

$userId = $_SESSION['UserID'];


$sql = "SELECT CP.*, P.ProductName, P.ProductPhoto, P.Price, CP.Quantity
FROM ShoppingCart AS SC
JOIN Cart_Product AS CP ON SC.CartID = CP.CartID
JOIN Products AS P ON CP.ProductID = P.ProductID
WHERE SC.UserID = $userId ;
";

$result = $conn->query($sql);


$carts = array();
$totalAmount = 0;

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

            <th class="product-ti">商品</th>
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
            $cartId = $cart['CartID'];

            // 計算小計
            $subtotal = $price * $quantity;
            $totalAmount += $subtotal;
            ?>
            <tr class="gray-line">
              <td>
                <div class="product-con">
                  <div class="product">
                    <img src="<?php echo $productPhoto; ?>" alt="Product Photo" class="product-image">
                    <div class="product-name-con">
                      <div class="product-name">
                        <?php echo $productName; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="price-con">
                  <span class="price">$
                    <?php echo intval($price); ?>
                  </span>
                  <div>
              </td>
              <td>
                <dive class="quantity-input-group">
                  <div class="input-con">
                    <button class="quantity-btn decrement" type="button"><i class="fa fa-minus"></i></button>
                    <input class="quantity-input" type="text" name="quantity" value="<?php echo $quantity; ?>">
                    <button class="quantity-btn increment" type="button"><i class="fa fa-plus"></i></button>
                  </div>
                  <div>
              </td>
              <td>
                <div class="subtotal">

                  <?php echo "$ " . $subtotal; ?>
                </div>
              </td>
              <td>
                <form id="deleteForm" action="delete_cart.php" method="POST">
                  <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                  <input type="hidden" name="cartID" value="<?php echo $cartId; ?>">
                  <div class="delete-button">
                    <button type="submit">刪除</button>
                    <div>
                </form>

              </td>
            </tr>


            <?php
          }
          ?>

        </tbody>
      </table>
    </div>

    <div class="total-amount">
      總額：
      <?php echo "$ " . $totalAmount; ?>
    </div>
    </div>
    <button class="checkout-button">結帳</button>

    <script>
    // JavaScript程式碼
    </script>

  </body>

</html>