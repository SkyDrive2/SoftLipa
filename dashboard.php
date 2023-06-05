  <?php
  include "./component/header.php";
  session_start();

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
    function enableEdit() {
      var inputs = document.querySelectorAll(".value");
      var submitBtn = document.querySelector(".submit");
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute("readonly");
      }
      submitBtn.style.display = "block"; 
    }

      function addAnimation() {
      var submitBtn = document.querySelector(".submit");
      submitBtn.classList.add("animate");
    }



    function selectMenuItem(item) {
      // 重置所有項目的文字顏色為預設值
      var menuItems = document.getElementsByClassName('menu-item');
      for (var i = 0; i < menuItems.length; i++) {
        menuItems[i].style.color = 'black';
      }

      // 設置被點擊項目的文字顏色為橘色
      var selectedItem = document.querySelector('.menu-item[data-item="' + item + '"]');
      selectedItem.style.color = 'orange';

      // 根據被點擊的項目執行相應的操作
      switch (item) {
        case 'profile':
          document.querySelector('.section.profile-section').style.display = 'block';
          break;
        case 'purchaseList':
          document.querySelector('.section.profile-section').style.display = 'none';
          break;
        default:
          break;
      }
    }

  </script>

  </head>



  <body class="all">
    <div class = "for-header"></div>

  <div class="profile-section-wrapper">
  <div class="dashboard-container">
    <div class="sidebar">
      <div class="user-profile">

        <img src="images/user.png" class="user-photo">
      <div class = "user-edit">
        <div class="user-name"><?php echo $_SESSION['UserName']; ?></div>
        <div class="edit-data" onclick="enableEdit()"><i class="fas fa-edit"></i>編輯資料</div>
      </div>
      </div>
      <div class="menu">
    <div class="menu-item"  data-item="profile" onclick = "selectMenuItem('profile')"><i class="fa-solid fa-file" style = "color:rgb(20, 110, 190);"></i><span class="menu-label" >個人檔案</span></div>
    <div class="menu-item" data-item="purchaseList" onclick = "selectMenuItem('purchaseList')"><i class="fa-regular fa-clipboard" style = "color:rgb(20, 110, 190);"></i><span class="menu-label">購買清單</span></div>
    <div class="menu-item" onclick="location.href='logout.php'"><i class="fa-solid fa-right-from-bracket" style = "color:red;"></i><span class="menu-label">帳戶登出</span></div>
  </div>


    </div>

    <div class="main-content">
      
    <div class="section profile-section">
    <div class="section-header">
      <h1 class="content">我的檔案</h1>
      <div class="ex">這個頁面可以管理檔案喔喔喔喔 </div>
    </div>
    <div class="section-content">
    <div class = "profile-content">
      <form method="POST" action="update.php">
        <table class = "input">
            <tr >
              <td class = "profile-name">
                <lable>使用者名稱</lable>
              </td>
              <td class="profile-value">
                  <div class="input-value">
                  <input type="text" id="UserName" name = "UserName" class="value" value="<?php echo $_SESSION['UserName']; ?>" readonly>
                </div>
              </td>
            </tr>
            <tr >
              <td class = "profile-name">
                <lable>Email</lable>
              </td>
              <td class="profile-value">
                  <div class="input-value">
                  <input type="text" id= "Email" name = "Email" class="value" value="<?php echo $_SESSION['Email']; ?>" readonly>
                </div>
              </td>
            </tr>
            <tr >
              <td class = "profile-name">
                <lable>聯絡資訊</lable>
                </td>
              <td class="profile-value">
                  <div class="input-value">
                  <input type="text" id = "ContactInfo" name = "ContactInfo" class="value" value="<?php echo $_SESSION['ContactInfo']; ?>" readonly>
                </div>
              </td>
            </tr>
            <tr >
              <td class = "profile-name">
                <lable>地址</lable>
              </td>
              <td class="profile-value">
                  <div class="input-value">
                  <input type="text" id = "Address" name = "Address" class="value" value="<?php echo $_SESSION['Address']; ?>" readonly>
                </div>
              </td>
            </tr>
            <tr >
              <td class = "profile-name">
                <lable></lable>
              </td>
              <td class="submit-profile">
        <button type="submit" class="submit" onclick="addAnimation()">儲存</button>
  </td>

            </tr>
        </table>  
    </form>
    </div>
    <div class="photo">
      <div class="photo-area">
        <img src="images/user.png" class="user-photo">
        <div class = "discript">我看你很喜歡蛋堡喔</div>
        </div>
      </div>

  </div>

        </div>
      </div>
    </div>
  </div>

  </div>
        </div>
      </div>
    </div>

  </body>

  </html>
  </html>

