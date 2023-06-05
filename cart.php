<?php
include "db_connect.php";
include './component/header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>使用者資料</title>
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
  <h1>購物車</h1>
  
  <table>
    <tr>
      <th>商品照片</th>
      <th>商品名稱</th>
      <th>單價</th>
      <th>數量</th>
      <th>小計</th>
      <th>操作</th>
    </tr>
    <!-- 這裡使用伪代码代替從資料庫取得購物車商品的程式碼 -->
    <?php
      // 假設$cartItems是從資料庫取得的購物車商品
      foreach ($cartItems as $item) {
        // 取得商品資訊
        $productID = $item['ProductID'];
        $productName = $item['ProductName'];
        $productDescription = $item['ProductDescription'];
        $price = $item['Price'];
        $stockQuantity = $item['StockQuantity'];
        $productPhoto = $item['ProductPhoto'];
        $quantity = $item['Quantity'];

        // 計算小計
        $subtotal = $price * $quantity;
    ?>
      <tr>
        <td><img src="<?php echo $productPhoto; ?>" alt="<?php echo $productName; ?>"></td>
        <td><?php echo $productName; ?></td>
        <td><?php echo $price; ?></td>
        <td>
          <input type="number" value="<?php echo $quantity; ?>" min="1" max="<?php echo $stockQuantity; ?>">
        </td>
        <td><?php echo $subtotal; ?></td>
        <td>
          <button class="delete-button" data-productid="<?php echo $productID; ?>">刪除</button>
        </td>
      </tr>
    <?php
      }
    ?>
  </table>
  
  <div>
    <p>總金額: <?php echo $totalAmount; ?></p>
    <button class="checkout-button">結帳</button>
  </div>
  
  <script>
    // JavaScript程式碼
  </script>

  </body>
</html>