
<?php
$host = "localhost";
$dbname = "board";
$user = "root";
$pass = "";

try {
    // 建立 PDO 連線
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // 設定錯誤模式為拋出例外
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo("連線失敗：" . $e->getMessage());
}
?>