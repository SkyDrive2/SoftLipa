<?php
include "db_connect.php";

if (isset($_GET['orderID'])) {
  $orderID = $_GET['orderID'];

  // 取得訂單明細資料
  $sqlOrderDetails = "SELECT * FROM OrderDetails WHERE OrderID = $orderID";
  $stmtOrderDetails = $conn->query($sqlOrderDetails);
  $orderDetails = $stmtOrderDetails->fetchAll(PDO::FETCH_ASSOC);

  // 回復庫存數量
  foreach ($orderDetails as $detail) {
    $productID = $detail['ProductID'];
    $quantity = $detail['Quantity'];

    // 取得產品原始庫存數量
    $sqlProduct = "SELECT StockQuantity FROM Products WHERE ProductID = $productID";
    $stmtProduct = $conn->query($sqlProduct);
    $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);
    $stockQuantity = $product['StockQuantity'];

    // 回復庫存數量
    $newStockQuantity = $stockQuantity + $quantity;

    // 更新產品庫存數量
    $sqlUpdateStock = "UPDATE Products SET StockQuantity = $newStockQuantity WHERE ProductID = $productID";
    $conn->query($sqlUpdateStock);
  }

  // 刪除訂單明細資料
  $sqlDeleteDetails = "DELETE FROM OrderDetails WHERE OrderID = $orderID";
  $stmtDeleteDetails = $conn->query($sqlDeleteDetails);

  // 刪除訂單資料
  $sqlDeleteOrder = "DELETE FROM Orders WHERE OrderID = $orderID";
  $stmtDeleteOrder = $conn->query($sqlDeleteOrder);

  header("Location: dashboard.php?page=order-details");
}
?>