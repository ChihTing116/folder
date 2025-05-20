 <h1>註冊</h1>
  <form action="edit.php" method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    <label for="password">密碼</label>             
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="提交">
  </form>


   <?php
      if(!empty($keyword)):?>
        <a href="index.php">清除搜尋</a>
  <?php endif;?>
    </form>

