<?php require_once 'db.php'; 
date_default_timezone_set("Asia/Taipei");

$error = "";




// 如果表單送出，進行更新
if ($_SERVER["REQUEST_METHOD"] === "POST") {

     
    if (!isset($_POST["id"]) || !ctype_digit((string)$_POST["id"])){
        die("錯誤：沒有指定要更新的留言");
    }
    $id = $_POST["id"];
    $id = (int)$_POST["id"];
    if ($id < 0 || $id > 2147483647) {
        die("錯誤：ID 超出允許範圍");
    }

    
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if (strlen($name) > 0 && strlen($message) > 0) {
        $stmt = $pdo->prepare("UPDATE messages SET name = :name, message = :message , updated_at =:updated_at WHERE id = :id");
        $success=$stmt->execute([
            ':name' => $name,
            ':message' => $message,
            ':updated_at'=>date("Y-m-d H:i:s"),
            ':id' => $id
           
        ]);
    if (!$success) {
            print_r($stmt->errorInfo());
            $error=  "更新失敗";
    }else{
      
        header("Location: index.php");
        exit;
    }
    } else {
        $error = "編輯不成功:姓名和留言不能空白";
    }




}else {

if (!isset($_GET["id"]) || !ctype_digit((string)$_GET["id"])) {
    die("錯誤：沒有指定或無效的 ID");
    }
    $id = (int)$_GET["id"];
    if ($id < 0 || $id > 2147483647) {
        die("錯誤：ID 超出允許範圍");
    }
 }

// 查詢原始留言資料 保留內容
$stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
$stmt->execute([':id' => $id]);
$messageData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$messageData) {
    die("找不到該留言");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>編輯留言</title>
</head>
<body>
    <div style="max-width: 700px; margin: 0 auto;">
    <h1>編輯留言</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    
    <form method="post" action="edit.php">

        <input type="hidden" name="id" value="<?=htmlspecialchars($messageData["id"])?>">

        <label>名字：</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($messageData['name']) ?>" required><br><br>

        <label>留言內容：</label><br>
        <textarea name="message" rows="5" cols="40" required><?= htmlspecialchars($messageData['message']) ?></textarea><br><br>

        <button type="submit">更新留言</button>
        <a href="index.php">取消</a>
        
    </form>
    </div>
</body>
</html>
