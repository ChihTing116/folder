

<?php require_once 'db.php'?>

   <h1>註冊</h1>
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   </head>
   <body>
    <form action="register.php" method="POST">
  <label for="email">Email</label>
  <input type="email" name="email" id="email">
  <br>
  <label for="password">密碼</label>
  <input type="password" name="password" id="password">
  <br>
  <input type="submit" value="提交">
</form>
   </body>
   </html>

