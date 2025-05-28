<?php

require_once 'db.php'; // 確保裡面是 $pdo = new PDO(...);
$maxLength = 255;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if (!isset($name) || trim($name) === '' || !isset($message) || trim($message) === '') {
    header("Location:index.php?error=empty");
    exit();
}

    
    if (mb_strlen($message) > $maxLength) {
        header("Location:index.php?error=toolong");
        exit();
        }

    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (:name, :message)");
    $stmt->execute([
        ':message' => $message,
        ':name' => $name
    ]);
     header("Location: index.php");
    exit();
       
}
?>