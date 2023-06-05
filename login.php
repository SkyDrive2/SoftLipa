<?php include './component/header.php'; ?>

<html>
<meta charset="UTF-8">

<head>

  <meta charset="UTF-8">
  <title>任性的人</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/login.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">

  <script src="https://kit.fontawesome.com/00b6be94d5.js" crossorigin="anonymous"></script>

</head>

<body>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('search-icon').addEventListener('click', function () {
        var searchBox = document.getElementById('search-box');
        searchBox.classList.toggle('active');
      });
    });
  </script>


  <div class="login-container">
    <h2>登入您的帳號</h2>
    <form action="http://127.0.0.1/softlipa/login.php" method="post">
      <div class="form-group">
        <label for="email">輸入信箱：</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">輸入密碼：</label>
        <div class="password-input">
          <input type="password" id="password" name="password" required>
          <span class="toggle-password" onclick="togglePasswordVisibility()">
            <i class="fas fa-eye"></i>
          </span>
        </div>
      </div>

      <script>
        function togglePasswordVisibility() {
          var passwordInput = document.getElementById("password");
          var togglePassword = document.querySelector(".toggle-password");

          if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
          } else {
            passwordInput.type = "password";
            togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
          }
        }
      </script>

      <div class="form-group">
        <div class="login-button">
          <button type="submit">登入</button>
        </div>
        <div class="register-link">
          <a href="register.php">沒有帳號？</a>
        </div>
      </div>
    </form>
    <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
  </div>
</body>

</html>


<?php
  include "db_connect.php";
  
  


  if (isset($_POST['email']) && isset($_POST['password'])) {
    // 取得使用者提交的電子郵件和密碼
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
      // 準備 SQL 查詢
      $stmt = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";

      $result = $conn->query($stmt);

      // 檢查結果的筆數
      if ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
        // 登入成功
        session_start();

        // 將使用者資料存儲在 session 變數中
        $_SESSION['UserID'] = $row['UserID'];
        $_SESSION['UserName'] = $row['UserName'];
        $_SESSION['Address'] = $row['Address'];
        $_SESSION['ContactInfo'] = $row['ContactInfo'];
        $_SESSION['Email'] = $row['Email'];
       
        echo '<script>
                  if (confirm("登入成功！！！")) {
                    window.location.href = "dashboard.php";
                  }
                </script>';
        exit();
      } else {
        echo '<script>
        if (confirm("登入失敗，請重新登入")) {
          window.location.href = "login.php";
        }
      </script>';

      }
      
    } catch (PDOException $e) {
      echo "錯誤: " . $e->getMessage();
    }
   
}
?>
