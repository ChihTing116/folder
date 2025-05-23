
<?php require_once 'db.php'; 

$keyword=isset($_POST['keyword'])?  $_POST['keyword']:"";
if(!empty($keyword)){
 $sql = "SELECT * FROM messages 
            WHERE name LIKE ? OR message LIKE ? 
            ORDER BY created_at DESC";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(["%$keyword%", "%$keyword%"]);

        
}else{
  $sql="SELECT * FROM messages ORDER BY created_at DESC";
  $stmt=$pdo->query($sql);
}
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<?php if (isset($_GET["error"]) && $_GET["error"] == "empty"): ?>
    <p style="color:red;">請填寫姓名與留言</p>
<?php endif; ?>





<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>留言板</title>
</head>
<body>


 <h1>搜尋留言</h1>
     <form method="POST">
       <input type="text" name="keyword" placeholder="輸入關鍵字" value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">搜尋</button>
         <?php if(!empty($keyword)): ?>
    <a href="index.php">清除搜尋</a>
  <?php endif; ?>
</form>
 

 
  <hr>

  <h2>新增留言</h2>
  <form action="add.php" method="POST">
    <label>名字：</label><br>
    <input type="text" name="name" required><br><br>

    <label>留言內容：</label><br>
    <textarea name="message" rows="5" cols="40" required></textarea><br><br>

    <button type="submit">送出留言</button> 
  </form>

  <hr>
  <h3>留言區：</h3>
  <div>
    <?php if (count($results)>0): ?>
      <?php foreach($results as $row): ?>
        <p><strong><?= htmlspecialchars($row['name']) ?>：</strong><?= nl2br(htmlspecialchars($row['message'])) ?></p>
        <small>時間：
        <?= htmlspecialchars(!empty($row['updated_at']) ? $row['updated_at'] : $row['created_at']) ?>
      </small><br>
        <a href="edit.php?id=<?= $row['id'] ?>">編輯留言</a>
         |
        <form action="delete.php" method="post" style="display:inline;" onsubmit="return confirm('確定要刪除嗎？')">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <button type="submit">刪除留言</button>
    </form>

    <hr>
  <?php endforeach; ?>
<?php else: ?>
  <p>目前尚無留言</p>

    <?php endif; ?>
  </div>


</body>
</html>
