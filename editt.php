<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>編輯留言</title>
</head>
<body>

  <h1>編輯留言</h1>

  <form action="edit.php" method="POST">
    <!-- 假設這是第 1 筆留言 -->
    <input type="hidden" name="id" value="1">

    <label for="name">名字：</label><br>
    <input type="text" id="name" name="name" value="小美"><br><br>

    <label for="message">留言內容：</label><br>
    <textarea id="message" name="message" rows="5" cols="40">這個留言板好可愛！</textarea><br><br>

    <input type="submit" value="儲存留言">
    <a href="./index.php" target="_blank" rel="noopener noreferrer">取消</a>
  </form>

</body>
</html>