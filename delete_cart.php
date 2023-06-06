<?php
ob_start();
// 獲取要刪除的商品ID和購物車ID
$productID = $_POST['productID'];
$cartID = $_POST['cartID'];

include "db_connect.php";
// 準備和執行刪除語句
$sql = "DELETE FROM Cart_Product WHERE ProductID = $productID AND CartID = $cartID";

$stmt = $conn->query($sql);
ob_end_clean();
if ($stmt) {
  header("Location: cart.php");
} else {
  echo "沒料";
}



exit;
?>