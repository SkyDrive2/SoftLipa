<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <title>任性的人</title>
  <link rel="stylesheet" type="text/css" href="./global_style.css">
  <script src="https://kit.fontawesome.com/00b6be94d5.js" crossorigin="anonymous"></script>
  
</head>

<body>
  <header>
    <div class="header-left">

      <a href="index.php" class="logo-link">
      <?php
        // 檢查是否有查詢參數
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
          echo '<h1>搜尋結果</h1>';
        } else {
          echo '<h1>任性的人</h1>';
        }
      ?>
      </a>


    </div>
    <div class="header-right">

      <div id="search-box">
        <input type="text" id="search-input" placeholder="輸入商品名" onkeypress="handleKeyPress(event)">
      </div>
      <a id="search-icon"><i  class="fas fa-search"></i></a>
      <?php
          session_start();

          if (isset($_SESSION['Email']) && $_SESSION['Email']) {
            echo '<a href="dashboard.php"><i class="fas fa-user"></i></a>';
          } else {
            echo '<a href="login.php  "><i class="fas fa-user"></i></a>';
          }
      ?>
      <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    </div>

    <script>
      // 新增一個變數，預設為 false
      var isSearchPerformed = false;
    </script>
  </header>



  <script>
  document.addEventListener('DOMContentLoaded', function () {
    var searchIcon = document.getElementById('search-icon');
    var searchBox = document.getElementById('search-box');

    var isSearchBoxVisible = false;

    searchIcon.addEventListener('click', function () {
      isSearchBoxVisible = !isSearchBoxVisible;

      if (isSearchBoxVisible) {
        searchBox.classList.add('active');
      } else {
        searchBox.classList.remove('active');
      }
    });

    searchIcon.addEventListener('mouseenter', function () {
      if (!isSearchBoxVisible) {
        searchBox.classList.add('active');
      }
    });

    searchIcon.addEventListener('mouseleave', function () {
      if (!isSearchBoxVisible) {
        searchBox.classList.remove('active');
      }
    });

    searchBox.addEventListener('mouseenter', function () {
      if (!isSearchBoxVisible) {
        searchBox.classList.add('active');
      }
    });

    searchBox.addEventListener('mouseleave', function () {
      if (!isSearchBoxVisible) {
        searchBox.classList.remove('active');
      }
    });

    function handleKeyPress(event) {
      if (event.key === 'Enter') {
        // 防止表單提交
        event.preventDefault();

        // 獲取使用者輸入的搜尋關鍵字
        var keyword = searchBox.querySelector('#search-input').value;

        // 進行搜尋
        if (keyword.trim() !== '') {
          // 使用 window.location.href 重新導向至搜尋結果頁面，並將關鍵字作為查詢參數傳遞
          window.location.href = 'search.php?keyword=' + keyword;
          isSearchPerformed = true;
        }
      }
    }

    var searchInput = document.getElementById('search-input');
    searchInput.addEventListener('keypress', handleKeyPress);
  });
</script>



</body>

</html>