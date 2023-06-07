<?php
session_start();


include "db_connect.php";
$sql = "SELECT * FROM Orders WHERE UserID = {$_SESSION['UserID']}";

$stmt = $conn->query($sql);
$orders = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $orders[] = $row;
}
if (count($orders) > 0) {
  foreach ($orders as $order) {
    $orderID = $order['OrderID'];
    $orderDate = $order['OrderDate'];
    $totalAmount = $order['TotalAmount'];
    $sqlDetails = "SELECT * FROM OrderDetails WHERE OrderID = $orderID";

    $stmtDetails = $conn->query($sqlDetails);
    $orderDetails = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="section order-details">';
    foreach ($orderDetails as $detail) {
      echo '<div class="order-con">';
      echo '<div class="empty"></div>';
      echo '<div class="border"></div>';

      $productID = $detail['ProductID'];
      $quantity = $detail['Quantity'];
      $price = $detail['Price'];

      // 取得商品資料
      $sqlProduct = "SELECT * FROM Products WHERE ProductID = $productID";
      $stmtProduct = $conn->query($sqlProduct);
      $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);
      $productPhoto = $product['ProductPhoto'];
      $productName = $product['ProductName'];

      echo '<div class="per-product">';
      echo '<div class = "de-product">';
      echo '<div class="image-wrap">';
      echo '<a href="product_details.php?id=' . $productID . '">';
      echo '<img class="product-photo" src="' . $productPhoto . '">';
      echo '</a>';
      echo '</div>';
      echo '<div class="product-details">';
      echo '<div class = "section-product-name">';
      echo '<span class="product-name">' . $productName . '</span>';
      echo '</div>';
      echo '<div class = section-quantity>';
      echo '<p class="product-quantity">x' . $quantity . '</p>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '<p class="product-price">＄' . intval($price) . '</p>';

      echo '</div>';

      echo '</div>'; // 結束商品區塊的 div
    }

    echo '<div class="order-section">';
    echo '<p class = "date">' . $orderDate . '</p>';
    echo '<div class = "right-section">';
    echo '<button class="cancel-button" onclick="window.location.href=\'delete_order.php?orderID=' . $orderID . '\'">取消訂單</button>';
    echo '<div>訂單金額:</div>';
    echo '<div class = "total-amount">＄' . intval($totalAmount) . '</div>';
    echo '</div>';
    echo '</div>';

    echo '</div>'; // 結束 section 的 div

    // 添加訂單之間的間距
    echo '<div class="order-spacing"></div>';
  }
} else {
  echo '<div class="section no-orders">';
  echo '目前沒有訂單。';
  echo '</div>';
}

?>