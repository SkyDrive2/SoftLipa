<?php
// 獲取從前端傳遞過來的資料
$cartID = $_POST['cartID'];
$productID = $_POST['productID'];
$quantity = $_POST['quantity'];

// 執行資料庫更新操作
include "db_connect.php";
$sql = "UPDATE Cart_Product SET Quantity = $quantity WHERE CartID = $cartID AND ProductID = $productID";
$stmt = $conn->query($sql);

if ($stmt) {
  header("Location: cart.php");
} else {
  echo "沒料";
}
?>