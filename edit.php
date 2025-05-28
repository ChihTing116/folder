<?php require_once 'db.php'; 
date_default_timezone_set("Asia/Taipei");

$error = "";




// 如果表單送出，進行更新
if ($_SERVER["REQUEST_METHOD"] === "POST") {

     
    if (!isset($_POST["id"])) {
        die("錯誤：沒有指定要更新的留言");
    }
    $id = $_POST["id"];

    if (!ctype_digit($id)) {
        die("錯誤：沒有指定或無效的 ID");
    }
    
    $id = intval($id);

    if ($id > 2147483647) {
        die("錯誤:ID 超出允許範圍");
    }

    
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($message)) {
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


// if(!empty($id)||isset($_GET["id"]))

}else {
    // GET 請求，取得 id(進入編輯前檢查處理)
    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        if ($id === 0) {
            die("錯誤：無效的留言 ID");//輸入字串或0的時候
        }
    }else {
        die("錯誤：沒有指定要編輯的留言");//網址中完全沒有帶 id 參數
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
</body>
</html>
