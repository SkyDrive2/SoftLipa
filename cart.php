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

  <div class = "for-header"></div>
  <body>  

    <div class = "all-carts">
      <div class = "title-con">
      <div class="check">

      </div>
      <div class="ex-product">商品</div>
      <div class="ex-per">單價</div>
      <div class="ex-qua">數量</div>
      <div class="ex-tot">總計</div>
      <div class="ex-exc">操作</div>
      </div>
      <div class = "details">
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
  <div class="per-cart">
    <div class="cells">
      <div class="check">
        <!-- 這裡放入勾選商品的邏輯 -->
      </div>
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

        <div class="price-con">
          <div>
            <span class = "price" >$<?php echo intval($price); ?></span>
          </div>
        
        </div>
        <div class="quantity-input-group">  
        <div class="input-con ">
          <button class="quantity-btn decrement" type="button"><i class="fa fa-minus"></i></button>
          <input class="quantity-input" type="text" name="quantity" value="<?php echo $quantity; ?>">
          <button class="quantity-btn increment" type="button"><i class="fa fa-plus"></i></button>
        </div>
      </div>
        <div class="subtotal">
          $<?php echo $subtotal; ?>
        </div>
        
        <button class="delete-button">刪除</button>
      </div>
    </div>
  </div>
<?php
}
?>

<div class="total-amount">
  <!-- 這裡放入總金額的顯示 -->
</div>

<button class="checkout-button">結帳</button>

  
  <script>
    // JavaScript程式碼
  </script>

  </body>
</html>