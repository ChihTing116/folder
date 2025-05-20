<?php require_once 'db.php'; 

// 確認是否有接收到 id
if (!isset($_GET['id'])) {
    die("錯誤：沒有指定要編輯的留言");
}

$id = intval($_GET['id']); // 將 id 轉為整數以防 SQL 注入

// 如果表單送出，進行更新
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($message)) {
        $stmt = $pdo->prepare("UPDATE messages SET name = :name, message = :message WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':message' => $message,
            ':id' => $id
        ]);
        header("Location: index.php");
        exit;
    } else {
        $error = "姓名和留言不能空白";
    }
}

// 查詢原始留言資料
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
    <h1>編輯留言</h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>名字：</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($messageData['name']) ?>" required><br><br>

        <label>留言內容：</label><br>
        <textarea name="message" rows="5" cols="40" required><?= htmlspecialchars($messageData['message']) ?></textarea><br><br>

        <button type="submit">更新留言</button>
        <a href="index.php">取消</a>
    </form>
</body>
</html>
