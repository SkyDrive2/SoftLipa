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
  $cartId = $userID;

  try {
    // 檢查是否存在相同的CartID和UserID
    $checkSql = "SELECT COUNT(*) AS count FROM ShoppingCart WHERE CartID = $cartId AND UserID = $userID";
    $checkResult = $conn->query($checkSql);
    $count = $checkResult->fetchColumn();

    if ($count > 0) {
      // 如果已存在相同的CartID和UserID，直接插入Cart_Product表
      $cartProductSql = " MERGE INTO Cart_Product AS Target
        USING (
          SELECT $productId AS ProductID, $cartId AS CartID, $quantity AS Quantity
        ) AS Source
        ON (Target.ProductID = Source.ProductID AND Target.CartID = Source.CartID)
        WHEN MATCHED THEN
          UPDATE SET Target.Quantity = Target.Quantity + Source.Quantity
        WHEN NOT MATCHED THEN
          INSERT (ProductID, CartID, Quantity) VALUES (Source.ProductID, Source.CartID, Source.Quantity);";
      $cartProductResult = $conn->query($cartProductSql);

      if ($cartProductResult) {
        $_SESSION['addToCartSuccess'] = true;
        echo '<script>alert("商品已成功加入購物車！");</script>';

        if ($sourcePage == "index") {
          echo '<script>
                      document.addEventListener("DOMContentLoaded", function() {
                        window.location.href = "index.php";
                      });
                    </script>';
        } elseif ($sourcePage == "product_details") {
          echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
            var productId = ' . $productId . ';
            window.location.href = "product_details.php?id=" + productId;
          });
        </script>';
        }
      } else {
        $_SESSION['addToCartSuccess'] = false;
        echo '<script>alert("看來你沒資格買我的東西:)");</script>';

        if ($sourcePage == "index") {
          echo '<script>
                      document.addEventListener("DOMContentLoaded", function() {
                        window.location.href = "index.php";
                      });
                    </script>';
        } elseif ($sourcePage == "product_details") {
          echo '<script>
                      document.addEventListener("DOMContentLoaded", function() {
                        var productId = ' . $productId . ';
                        window.location.href = "product_details.php?id=" + productId;
                      });
                    </script>';
        }
      }

    } else {
      // 如果不存在相同的CartID和UserID，先插入ShoppingCart表再插入Cart_Product表
      $shoppingCartSql = "INSERT INTO ShoppingCart (CartID, UserID) VALUES ($cartId, $userID)";
      $shoppingCartResult = $conn->query($shoppingCartSql);

      if ($shoppingCartResult) {
        $cartProductSql = " MERGE INTO Cart_Product AS Target
            USING (
              SELECT $productId AS ProductID, $cartId AS CartID, $quantity AS Quantity
            ) AS Source
            ON (Target.ProductID = Source.ProductID AND Target.CartID = Source.CartID)
            WHEN MATCHED THEN
              UPDATE SET Target.Quantity = Target.Quantity + Source.Quantity
            WHEN NOT MATCHED THEN
              INSERT (ProductID, CartID, Quantity) VALUES (Source.ProductID, Source.CartID, Source.Quantity);";
        $cartProductResult = $conn->query($cartProductSql);

        if ($cartProductResult) {
          $_SESSION['addToCartSuccess'] = true;
          echo '<script>alert("商品已成功加入購物車！");</script>';

          if ($sourcePage == "index") {
            echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            window.location.href = "index.php";
                          });
                        </script>';
          } elseif ($sourcePage == "product_details") {
            echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            var productId = ' . $productId . ';
                            window.location.href = "product_details.php?id=" + productId;
                          });
                        </script>';
          }
        } else {
          $_SESSION['addToCartSuccess'] = false;
          echo '<script>alert("看來你沒資格買我的東西:)");</script>';

          if ($sourcePage == "index") {
            echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            window.location.href = "index.php";
                          });
                        </script>';
          } elseif ($sourcePage == "product_details") {
            echo '<script>
                          document.addEventListener("DOMContentLoaded", function() {
                            var productId = ' . $productId . ';
                            window.location.href = "product_details.php?id=" + productId;
                          });
                        </script>';
          }
        }
      } else {
        $_SESSION['addToCartSuccess'] = false;
        echo '<script>alert("加入購物車失敗！");</script>';

        if ($sourcePage == "index") {
          echo '<script>
                      document.addEventListener("DOMContentLoaded", function() {
                        window.location.href = "index.php";
                      });
                    </script>';
        } elseif ($sourcePage == "product_details") {
          echo '<script>
                      document.addEventListener("DOMContentLoaded", function() {
                        var productId = ' . $productId . ';
                        window.location.href = "product_details.php?id=" + productId;
                      });
                    </script>';
        }
      }
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