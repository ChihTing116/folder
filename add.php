<?php
require_once 'db.php'; // 確保裡面是 $pdo = new PDO(...);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (:name, :message)");
        $stmt->execute([
            ':name' => $name,
            ':message' => $message
        ]);
    }
}

header("Location: index.php");
exit;

