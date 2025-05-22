<?php require_once 'db.php'; 

// 確認是否有接收到 id
if (!isset($_POST['id'])) {
    die("錯誤：沒有指定要刪除的留言");
}

$id = intval($_POST['id']); // 防止 SQL 注入

// 執行刪除
$stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
$stmt->execute([$id]);

// 回到首頁
header("Location: index.php");
exit;
?>
