<?php
include "./component/header.php";
session_start();
$page = $_GET['page'];
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
      padding-top: 200px;
    }
  </style>

  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      selectMenuItem('profile'); // 選擇並設定「個人檔案」為橘色
    });

    function selectMenuItem(item) {
      // 重置所有項目的文字顏色為預設值
      var menuItems = document.getElementsByClassName('menu-item');
      for (var i = 0; i < menuItems.length; i++) {
        menuItems[i].style.color = 'black';
      }

      // 設置被點擊項目的文字顏色為橘色
      var selectedItem = document.querySelector('.menu-item[data-item="' + item + '"]');
      selectedItem.style.color = 'orange';

      // 隱藏所有的區域
      var sections = document.querySelectorAll('.section');
      for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
      }

      // 根據被點擊的項目顯示對應的區域
      if (item === 'profile') {
        var profileSection = document.querySelector('.section.profile-section');
        profileSection.style.display = 'block';
      } else if (item === 'purchaseList') {
        var purchaseListSections = document.querySelectorAll('.section.order-details');
        for (var i = 0; i < purchaseListSections.length; i++) {
          purchaseListSections[i].style.display = 'block';
        }
      }

    }
    window.addEventListener('DOMContentLoaded', (event) => {
      var page = '<?php echo $page; ?>';

      // 檢查 page 參數並選擇對應的側邊欄項目
      if (page === 'order-details') {
        selectMenuItem('purchaseList');
      } else {
        selectMenuItem('profile');
      }
    });


  </script>

</head>



<body class="all">
  <div class="for-header"></div>

  <div class="profile-section-wrapper">
    <div class="dashboard-container">
      <div class="sidebar">
        <div class="user-profile">

          <img src="images/user.png" class="user-photo">
          <div class="user-edit">
            <div class="user-name">
              <?php echo $_SESSION['UserName']; ?>
            </div>
            <div class="edit-data" onclick="enableEdit()"><i class="fas fa-edit"></i>編輯資料</div>
          </div>
        </div>
        <div class="menu">
          <div class="menu-item" data-item="profile" onclick="selectMenuItem('profile')"><i class="fa-solid fa-file"
              style="color:rgb(20, 110, 190);"></i><span class="menu-label">個人檔案</span></div>
          <div class="menu-item" data-item="purchaseList" onclick="selectMenuItem('purchaseList')"><i
              class="fa-regular fa-clipboard" style="color:rgb(20, 110, 190);"></i><span class="menu-label">購買清單</span>
          </div>
          <div class="menu-item" onclick="location.href='logout.php'"><i class="fa-solid fa-right-from-bracket"
              style="color:red;"></i><span class="menu-label">帳戶登出</span></div>
        </div>


      </div>

      <div class="main-content">
        <?php include "./component/smallpage/profile-section.php"; ?>
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
          echo '<div class="section order-details ">';
          echo '<div class = "no-orders">';
          echo '還不趕快讓我賺錢！';
          echo '</div>';
          echo '</div>';
        }

        ?>

      </div>
    </div>
  </div>
  </div>
  </div>


</body>

</html>