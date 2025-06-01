<?php
require_once 'db.php';
require_once 'functions.php';
require_once 'header.php';

$pdo = getPDO();



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $message = trim($_POST["message"]);

    if ($name === '' || $message === '') {
        header("Location: index.php?error=empty");
        exit();
    }

    if (mb_strlen($message) > 255) {
        header("Location: index.php?error=toolong");
        exit();
    }

    if (addMessage($pdo, $name, $message)) {
        header("Location: index.php");
        exit();
    } else {
        die("新增留言失敗");
    }
}
?>
<?php
 if (isset($_GET['error'])): ?>
  <div class="alert alert-danger">
    <?php if ($_GET['error'] === 'empty') echo '姓名與留言皆為必填。'; ?>
    <?php if ($_GET['error'] === 'toolong') echo '留言長度不能超過 255 字。'; ?>
  </div>
<?php endif; ?>


<h2 class="mb-4">新增留言</h2>
<form method="POST" action="add_handler.php">
  <div class="mb-3">
    <label for="name" class="form-label">姓名</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="mb-3">
    <label for="message" class="form-label">留言內容</label>
    <textarea class="form-control" id="message" name="message" rows="4" maxlength="255" required></textarea>
    <small class="form-text text-muted">最多 255 字</small>

  </div>
  <button type="submit" class="btn btn-success">送出留言</button>
</form>


<?php
require_once('footer.php');
?>

