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
        <h1>任性的人</h1>
      </a>


    </div>
    <div class="header-right">

      <div id="search-box">
        <input type="text"> 
      </div>
      <a href="#" id="search-icon"><i class="fas fa-search"></i></a>
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
  });




</script>


</body>

</html>