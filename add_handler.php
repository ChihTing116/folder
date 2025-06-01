<?php
require_once 'db.php';
require_once 'functions.php';

$pdo = getPDO();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if ($name === '' || $message === '') {
        header("Location: add.php?error=empty");
        exit();
    }

    if (mb_strlen($message) > 255) {
        header("Location: add.php?error=toolong");
        exit();
    }

    if (addMessage($pdo, $name, $message)) {
        header("Location: index.php");
        exit();
    } else {
        die("新增留言失敗");
    }
} else {
    header("Location: add.php");
    exit();
}
