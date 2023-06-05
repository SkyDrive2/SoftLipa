<!DOCTYPE html>
<?php include './component/header.php'; ?>
<html>
<meta charset="UTF-8">

<head>
  <title>註冊帳號</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/login.css">
  <script src="https://kit.fontawesome.com/00b6be94d5.js" crossorigin="anonymous"></script>
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
    function toggleConfirmPasswordVisibility() {
      var confirmPasswordInput = document.getElementById("confirmPassword");
      var toggleConfirmPassword = document.querySelector(".toggle-confirm-password");

      if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        toggleConfirmPassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
      } else {
        confirmPasswordInput.type = "password";
        toggleConfirmPassword.innerHTML = '<i class="fas fa-eye"></i>';
      }
    }

    function validatePassword() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      var requirements = document.getElementById("passwordRequirements");

      var hasUppercase = /[A-Z]/.test(password);
      var hasLowercase = /[a-z]/.test(password);
      var hasSymbol = /[\W_]/.test(password);

      if (!hasUppercase || !hasLowercase || !hasSymbol) {
        requirements.textContent = "⚠️須包含大小寫及符號";
      } else if (password !== confirmPassword) {
        requirements.textContent = "⚠️密碼與確認密碼不一致";
      } else {
        requirements.textContent = "";
      }
    }

    function validateEmail() {
      var emailInput = document.getElementById("username").value;
      var emailWarning = document.getElementById("emailWarning");
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(emailInput)) {
        emailWarning.textContent = "⚠️請輸入有效的電子郵件地址";
      } else {
        emailWarning.textContent = "";
      }
    }

    function checkFormValidity() {
      var emailWarning = document.getElementById("emailWarning").textContent;
      var passwordRequirements = document.getElementById("passwordRequirements").textContent;
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      var registerButton = document.getElementById("registerButton");

      if (
        emailWarning === "" &&
        passwordRequirements === "" &&
        username.trim() !== "" &&
        password.trim() !== "" &&
        confirmPassword.trim() !== ""
      ) {
        registerButton.disabled = false; // 啟用按鈕
      } else {
        registerButton.disabled = true; // 禁用按鈕
      }
    }


  </script>
   
</head>

<body>
  
  <script>
    document.addEventListener('DOMConte<header>
    <div class="header-left">

      <a href="index.html" class="logo-link">
        <h1>任性的人</h1>
      </a>


    </div>
    <div class="header-right">

      <div id="search-box">
        <input type="text"> <!-- <button id="search-btn">搜尋</button> -->
      </div>
      <a href="#" id="search-icon"><i class="fas fa-search"></i></a>
      <a href="login.html"><i class="fas fa-user"></i></a>
      <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    </div>
  </header>ntLoaded', function () {
      document.getElementById('search-icon').addEventListener('click', function () {
        var searchBox = document.getElementById('search-box');
        searchBox.classList.toggle('active');
      });
    });
  </script>

  <div class="registration-container">
    <h2>註冊</h2>

    <form action="http://127.0.0.1/demo/register.php" method="POST">
      <div class="form-group">
        <label for="username">輸入Email</label>
        <input type="text" id="username" name="username" required onkeyup="validateEmail();checkFormValidity()">

      </div>

      <div class="form-group">
        <div id="emailWarning" class="email-warning"></div>
      </div>

      <div class="form-group">
        <label for="password">輸入密碼</label>
        <div class="password-input">
          <input type="password" id="password" name="password" required
            onkeyup="validatePassword();checkFormValidity()">
          <span class="toggle-password" onclick="togglePasswordVisibility('password')">
            <i class="fas fa-eye"></i>
          </span>
        </div>
      </div>


      <div class="form-group">
        <label for="confirmPassword">確認密碼</label>
        <div class="password-input">

          <input type="password" id="confirmPassword" name="confirmPassword" required
            onkeyup="validateConfirmPassword()">
          <span class="toggle-confirm-password" onclick="toggleConfirmPasswordVisibility();checkFormValidity()">
            <i class="fas fa-eye"></i>
          </span>

        </div>
      </div>

      <div class="form-group">
        <div class="password-requirements" id="passwordRequirements"></div>
      </div>
      <div class="form-group">
        <div class="login-button">
          <button type="submit" id="registerButton" disabled>註冊</button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>

<?php
        include "db_connect.php";

        // 確認表單已提交
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 獲取表單提交的資料
            $email = $_POST["username"];
            $password = $_POST["password"];

            // 檢查使用者是否已經存在
            $checkUserQuery = "SELECT * FROM Users WHERE email='$email'"; 
            $checkUserResult = $conn->query($checkUserQuery);
            if ($checkUserResult->fetch(PDO::FETCH_ASSOC)) {
                echo "錯誤：該使用者已存在";
            } else {
                //將資料插入資料庫
                $insertQuery = "INSERT INTO Users(Email,Password) VALUES ('$email', '$password')";
                $qury = $conn->query($insertQuery) ;
                if($qury){
                  echo '<script>
                  if (confirm("註冊成功，是否前往登入頁面？")) {
                    window.location.href = "login.php";
                  }
                </script>';
                }else{
                  echo"出問題了喔";
                }
            }

            // 關閉資料庫連線
            $conn->close();
        }
    ?>