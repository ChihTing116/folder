<?php
function addMessage($pdo, $name, $message) {
    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (:name, :message)");
    return $stmt->execute([
        ':name' => $name,
        ':message' => $message
    ]);
}

function deleteMessage($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

function updateMessage($pdo, $id, $name, $message) {
    $stmt = $pdo->prepare("UPDATE messages SET name = :name, message = :message, updated_at = :updated_at WHERE id = :id");
    return $stmt->execute([
        ':name' => $name,
        ':message' => $message,
        ':updated_at' => date("Y-m-d H:i:s"),
        ':id' => $id
    ]);
}

function getMessageById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllMessages($pdo) {
    $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchMessages($pdo, $keyword) {
    $stmt = $pdo->prepare("SELECT * FROM messages WHERE name LIKE :keyword OR message LIKE :keyword ORDER BY created_at DESC");
    $stmt->execute([':keyword' => "%$keyword%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
