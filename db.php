
<?php
function getPDO() {
    $host = "localhost";
    $dbname = "board";
    $user = "root";
    $pass = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("連線失敗：" . $e->getMessage());
    }
}
?>