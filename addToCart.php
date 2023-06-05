<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>任性的人</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/login.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">
</head>
<body>
<?php
    session_start();
    include "db_connect.php";
    include "./component/header.php";

    if (!isset($_SESSION['UserID'])) {
        $_SESSION['NoLog'] = true;
        echo '<script>alert("要登入才能買東西阿！不然我哪知道你誰");</script>';
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    $userID = $_SESSION['UserID'];
    $quantity = $_POST['quantity'];
    $productId = $_POST['productID'];
    $sourcePage = $_POST['sourcePage'];


    try {
      $sql = "MERGE INTO ShoppingCart AS Target
      USING (SELECT '$userID' AS UserID, '$productId' AS ProductID, '$quantity' AS Quantity) AS Source
      ON (Target.UserID = Source.UserID AND Target.ProductID = Source.ProductID)
      WHEN MATCHED THEN
          UPDATE SET Target.Quantity = Target.Quantity + Source.Quantity
      WHEN NOT MATCHED THEN
          INSERT (UserID, ProductID, Quantity) VALUES (Source.UserID, Source.ProductID, Source.Quantity);";
      $result = $conn->query($sql);
      if ($result) {
        $_SESSION['addToCartSuccess'] = true;
        echo '<script>alert("商品已成功加入購物車！");</script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                  var productId = ' . $productId . ';
                  window.location.href = "product_details.php?id=" + productId;
                });
              </script>';
      } else {
        $_SESSION['addToCartSuccess'] = false;
        echo '<script>alert("看來你沒資格買我的東西:)");</script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                  var productId = ' . $productId . ';
                  window.location.href = "product_details.php?id=" + productId;
                });
              </script>';
      }
      
  } catch (PDOException $e) {
      echo '錯誤：' . $e->getMessage();
  }
?>

<div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div> 
</div>

</body>
</html>