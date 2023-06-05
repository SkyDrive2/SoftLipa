<?php
  include "db_connect.php";
  include './component/header.php';
  ?>
  <!DOCTYPE html>
  <html>

  <meta charset="UTF-8">

  <head>
    <title>使用者資料</title>
    <link rel="stylesheet" type="text/css" href="./component/global_style.css">
    <link rel="stylesheet" type="text/css" href="./styles/dashborad.css">
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
  <div class = for-header></div>
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
    <h1><?php echo $row['ProductName']; ?></h1>
    <img src="<?php echo $row['ProductPhoto']; ?>" alt="Product Photo">
    <p>價格：TW$<?php echo $row['Price']; ?></p>
    <p>存貨：<?php echo $row['StockQuantity']; ?></p>
    <p>描述：<?php echo nl2br($productDescription); ?></p>
    <?php
} else {
    echo "找不到該商品。";
}

  // 關閉連線
  $conn->close();
?>
