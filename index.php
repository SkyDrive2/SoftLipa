<?php
include './component/header.php';

// 從資料庫中取得商品資料
include "db_connect.php";
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

// 存儲商品資料的陣列
$products = array();

if ($result->fetch(PDO::FETCH_ASSOC)) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}

// 關閉資料庫連線
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>任性的人</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/index.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">

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
<body>
    <div class = "for-header"></div>
<div class="main-content">
    <?php
     // 取得排序方式（價格高低）       
     $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
     $productsPerPage = isset($_GET['per_page']) ? $_GET['per_page'] : 9;
     ?>
    <div class="top-right">
            <form class="select-form" action="?per_page=<?php echo $productsPerPage; ?>&sort=<?php echo $sort; ?>" method="GET">
                <select name="per_page" onchange="this.form.submit()">
                    <option value="9" <?php if ($productsPerPage == 9) echo 'selected'; ?>>每頁 9 個</option>
                    <option value="12" <?php if ($productsPerPage == 12) echo 'selected'; ?>>每頁 12 個</option>
                    <option value="15" <?php if ($productsPerPage == 15) echo 'selected'; ?>>每頁 15 個</option>
                </select>
            </form>
            
            <form class="select-form" action="?per_page=<?php echo $productsPerPage; ?>&sort=<?php echo $sort; ?>" method="GET">
                <select name="sort" onchange="this.form.submit()">
                    <option value="">排序方式</option>
                    <option value="high" <?php if ($sort == 'high') echo 'selected'; ?>>價格高到低</option>
                    <option value="low" <?php if ($sort == 'low') echo 'selected'; ?>>價格低到高</option>
                </select>
            </form>
        </div>
    <div class="section">
        <?php
        // 計數器，用於計算每行已顯示的商品數量
        $counter = 0;

       
        // 排序商品資料
        if ($sort == 'high') {
            usort($products, function ($a, $b) {
                return $b['Price'] - $a['Price'];
            });
        } else if ($sort == 'low') {
            usort($products, function ($a, $b) {
                return $a['Price'] - $b['Price'];
            });
        }

        // 取得要顯示的商品數量和每頁商品數量
        $totalProducts = count($products);
        
        $maxProducts = min($totalProducts, $productsPerPage);

        // 計算總頁數
        $totalPages = ceil($totalProducts / $productsPerPage);

        // 取得當前頁數
        $currentPage = $_GET['page'] ?? 1;

        // 計算起始索引和結束索引
        $startIndex = ($currentPage - 1) * $productsPerPage;
        $endIndex = $startIndex + $maxProducts;

        // 迴圈取得每筆商品資料
        foreach (array_slice($products, $startIndex, $maxProducts) as $product) {
            $productName = $product["ProductName"];
            $price = $product["Price"];
            $productPhoto = $product["ProductPhoto"];
            ?>
            <div class="product">
            <a href="product_details.php?id=<?php echo $product['ProductID']; ?>" class="product-link">
            <img src="<?php echo $productPhoto; ?>" alt="Product Photo" class="product-image">
            <div class="overlay"></div>
            </a>


                <h3><?php echo $productName; ?></h3>
                <p>TW$<?php echo $price; ?></p>
            </div>
            <?php
            $counter++;

            // 每行已顯示三個商品，換行
            if ($counter % 3 == 0) {
                echo '</div>'; // 結束上一行
                echo '<div class="section">'; // 開始新的一行
            }
        }

        // 若最後一行商品不足三個，補齊空白
        if ($counter % 3 != 0) {
            $remainingItems = 3 - ($counter % 3);
            for ($i = 0; $i < $remainingItems; $i++) {
                echo '<div class="product empty"></div>';
            }
        }
        ?>
    </div> <!-- 結束最後一行 -->
</div> <!-- 結束 main-content 區塊 -->




<!-- Your clothing display code here -->

<div class="page-count">
    <?php
    if ($currentPage > 1) {
        $prevPage = $currentPage - 1;
        echo '<a href="?page=' . $prevPage . '&per_page=' . $productsPerPage . '"> << </a>';
    }
    echo '<p>第 ' . $currentPage . ' 頁 / 共 ' . $totalPages . ' 頁</p>';
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        echo '<a href="?page=' . $nextPage . '&per_page=' . $productsPerPage . '"> >></a>';
    }
    ?>
</div>

<div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
  </div>
</body>
</html>
