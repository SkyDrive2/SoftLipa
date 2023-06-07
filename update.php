<?php

session_start();

// 確認表單已提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 獲取表單提交的資料
  $userName = $_POST["UserName"];
  $email = $_POST["Email"];
  $contactInfo = $_POST["ContactInfo"];
  $address = $_POST["Address"];
  $userId = $_SESSION['UserID'];
  include "db_connect.php";
  // 更新資料庫
  $updateQuery = "UPDATE Users SET UserName= N'$userName', Email='$email', ContactInfo='$contactInfo', Address=N'$address' WHERE UserId=$userId";
  $updateResult = $conn->query($updateQuery);
  if ($updateResult) {
    // 更新 $_SESSION 中的資料
    $_SESSION['UserName'] = $userName;
    $_SESSION['Email'] = $email;
    $_SESSION['ContactInfo'] = $contactInfo;
    $_SESSION['Address'] = $address;

    // 顯示成功訊息或其他處理
    echo '<script>
                  if (confirm("更改資料成功")) {
                    window.location.href = "dashboard.php";
                  }
                </script>';
  } else {
    // 顯示錯誤訊息或其他處理
    echo '錯誤';
  }

  // 關閉資料庫連線
  $conn->close();
}
?>