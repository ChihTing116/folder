<?php
require_once 'db.php';
require_once 'functions.php';
require_once 'header.php';

$pdo = getPDO();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if (!ctype_digit($id) || $name === '' || $message === '') {
        $error = "編輯不成功: 姓名和留言不能空白";
    } else {
        if (updateMessage($pdo, $id, $name, $message)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "更新失敗";
        }
    }
} else {
    if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
        die("錯誤：沒有指定或無效的 ID");
    }
    $id = $_GET["id"];
    $messageData = getMessageById($pdo, $id);

    if (!$messageData) {
        die("找不到該留言");
    }
}
?>

<h2 class="mb-4">編輯留言</h2>

<?php if ($error): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="edit.php">
  <input type="hidden" name="id" value="<?= $messageData['id'] ?>">
  <div class="mb-3">
    <label class="form-label">姓名</label>
    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($messageData['name']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">留言內容</label>
    <textarea name="message" class="form-control" rows="4" required><?= htmlspecialchars($messageData['message']) ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">更新留言</button>
</form>

<?php
require_once('footer.php');
?>
