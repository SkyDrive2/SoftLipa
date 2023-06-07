<?php
include "./component/header.php";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>歡迎！！</title>
  <link rel="stylesheet" type="text/css" href="./component/global_style.css">
  <link rel="stylesheet" type="text/css" href="./styles/login.css">
  <link rel="stylesheet" type="text/css" href="./styles/wave.css">
  <style>
    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateX(-20px);
      }

      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .welcome {
      animation: fadeIn 1s forwards;
    }

    .button-container {
      margin-top: 20px;
      display: flex;
      flex-direction: row;
      justify-content: flex-end;
      gap: 10px;
    }

    .button {
      display: flex;
      padding: 20px 10px;
      background-color: #4CAF50;
      color: #ffffff;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }

    .button.left-button {
      margin-right: auto;
    }

    .button.right-button {
      margin-left: auto;
    }

    .button:hover {
      background-color: #45a049;
    }

    .button:active {
      transform: scale(0.95);
      opacity: 0.8;

    }
  </style>
</head>

<body>
  <div class="login-container">
    <h1 class="welcome">歡迎回來</h1>

    <div class="button-container">
      <a href="index.php" class="button">快去花錢</a>
      <a href="dashboard.php" class="button">編輯嗎？</a>
    </div>

    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>
</body>

</html>