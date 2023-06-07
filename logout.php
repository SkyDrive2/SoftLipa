<?php
include "./component/header.php";
session_start();


session_unset();

// 銷毀會話
session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>登出成功</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/login.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">

  <script>
    function redirectToLogin() {
      window.location.href = "login.php";
    }
  </script>
</head>

<body>
  <div class="login-container">
    <h1>成功登出</h1>
    <p>真的不花錢嗎？</p>

    <button onclick="redirectToLogin()">確定</button>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>

</body>

</html>