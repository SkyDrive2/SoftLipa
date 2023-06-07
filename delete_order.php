<?php
include "db_connect.php";

if (isset($_GET['orderID'])) {
  $orderID = $_GET['orderID'];

  // 刪除訂單明細資料
  $sqlDeleteDetails = "DELETE FROM OrderDetails WHERE OrderID = $orderID";
  $stmtDeleteDetails = $conn->query($sqlDeleteDetails);


  // 刪除訂單資料
  $sqlDeleteOrder = "DELETE FROM Orders WHERE OrderID = $orderID";
  $stmtDeleteOrder = $conn->query($sqlDeleteOrder);


  header("Location: dashboard.php?page=order-details");
}
?>