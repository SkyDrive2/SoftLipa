<?php

// 在這裡處理資料插入和庫存減少的動作

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
  // 獲取訂單資訊
  session_start();
  include "db_connect.php";
  $userID = $_SESSION['UserID'];
  $totalAmount = $_POST['totalAmount'];

  // 在Orders表中插入資料
  $sql = "INSERT INTO Orders (UserID, TotalAmount) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$userID, $totalAmount]);

  $Order_sql = "SELECT OrderID FROM Orders WHERE UserID = $userID";

  // 準備查詢
  $Order_stmt = $conn->query($Order_sql);
  if ($row = $Order_stmt->fetch(PDO::FETCH_ASSOC)) {
    $orderID = $row['OrderID'];
  }

  $products = json_decode($_POST['products'], true);
  foreach ($products as $cart) {
    $productID = $cart['ProductID'];
    $quantity = $cart['Quantity'];
    $price = $cart['Price'];

    // 更新商品庫存數量
    $updateStockQuery = "UPDATE Products SET StockQuantity = StockQuantity - $quantity WHERE ProductID = $productID";

    $updateStockStmt = $conn->query($updateStockQuery);


    // 在OrderDetails表中插入資料
    $insertOrderDetailsQuery = "INSERT INTO OrderDetails (OrderID, ProductID, Price, Quantity) VALUES ($orderID, $productID, $price, $quantity)";
    $insertOrderDetailsStmt = $conn->query($insertOrderDetailsQuery);

  }


  // 刪除購物車相關商品資料
  $clearCartProductQuery = "DELETE FROM Cart_Product WHERE CartID IN (SELECT CartID FROM ShoppingCart WHERE UserID = $userID)";
  $clearCartProductStmt = $conn->query($clearCartProductQuery);

  // 清空購物車資訊
  // 假設您的購物車資料表為 ShoppingCart 和 Cart_Product
  $clearCartQuery = "DELETE FROM ShoppingCart WHERE UserID = $userID";
  $clearCartStmt = $conn->query($clearCartQuery);


  // 重定向到訂單完成頁面或其他處理邏輯
  header("Location: order_completed.php");
  exit();
}
?>