<?php
require_once 'db.php';
require_once 'functions.php';
require_once 'header.php';

$pdo = getPDO();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    if (!ctype_digit($id)) {
        die("錯誤：無效的 ID 格式");
    }

    $message = getMessageById($pdo, $id);

    if (!$message) {
        die("錯誤：查無此筆留言，無法刪除");
    }

    if (deleteMessage($pdo, $id)) {
        header("Location: index.php");
        exit();
    } else {
        die("刪除留言失敗");
    }
}
require_once('footer.php');
?>
