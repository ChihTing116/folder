<?php require_once 'db.php'; 

// 確認是否有接收到 id
if (!isset($_POST['id'])) {
    die("錯誤：沒有指定要刪除的留言");
}

// 先拿到id
$id = $_POST['id'];
if (!ctype_digit($id)) {
    die("錯誤：無效的 ID 格式");
}
$id = (int)$id;

// 確認有沒有這筆留言
$checkStmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
$checkStmt->execute([':id' => $id]);
$message = $checkStmt->fetch(PDO::FETCH_ASSOC);

// 如果有的話就刪除
$deleteStmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
$deleteStmt->execute([':id' => $id]);

// 沒有的話，返回訊息給使用者  查無此筆留言，無法刪除
if (!$message) {
    die("錯誤：查無此筆留言，無法刪除");
    }
// 回到首頁
header("Location: index.php");
exit;
?>
