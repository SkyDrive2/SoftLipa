<div class="section profile-section">
  <div class="section-header">
    <h1 class="content">我的檔案</h1>
    <div class="ex">這個頁面可以管理檔案喔喔喔喔 </div>
  </div>
  <div class="section-content">
    <div class="profile-content">
      <form method="POST" action="update.php">
        <table class="input">
          <tr>
            <td class="profile-name">
              <lable>使用者名稱</lable>
            </td>
            <td class="profile-value">
              <div class="input-value">
                <input type="text" id="UserName" name="UserName" class="value"
                  value="<?php echo $_SESSION['UserName']; ?>" readonly>
              </div>
            </td>
          </tr>
          <tr>
            <td class="profile-name">
              <lable>Email</lable>
            </td>
            <td class="profile-value">
              <div class="input-value">
                <input type="text" id="Email" name="Email" class="value" value="<?php echo $_SESSION['Email']; ?>"
                  readonly>
              </div>
            </td>
          </tr>
          <tr>
            <td class="profile-name">
              <lable>聯絡資訊</lable>
            </td>
            <td class="profile-value">
              <div class="input-value">
                <input type="text" id="ContactInfo" name="ContactInfo" class="value"
                  value="<?php echo $_SESSION['ContactInfo']; ?>" readonly>
              </div>
            </td>
          </tr>
          <tr>
            <td class="profile-name">
              <lable>地址</lable>
            </td>
            <td class="profile-value">
              <div class="input-value">
                <input type="text" id="Address" name="Address" class="value" value="<?php echo $_SESSION['Address']; ?>"
                  readonly>
              </div>
            </td>
          </tr>
          <tr>
            <td class="profile-name">
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
        <img src="images/unname.png" class="user-photo">
        <div class="discript">我看你很喜歡蛋堡喔</div>
      </div>
    </div>

  </div>

</div>