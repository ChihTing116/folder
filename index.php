<?php
require_once 'db.php';
require_once 'functions.php';
require_once 'header.php';

$pdo = getPDO();
$keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]) : "";

if ($keyword !== "") {
    $messages = searchMessages($pdo, $keyword);
} else {
    $messages = getAllMessages($pdo);
}

?>
<?php if (isset($_GET['error'])): ?>
  <div class="alert alert-danger">
    <?php if ($_GET['error'] === 'empty') echo '姓名與留言皆為必填。'; ?>
    <?php if ($_GET['error'] === 'toolong') echo '留言長度不能超過 255 字。'; ?>
  </div>
<?php endif; ?>

<form class="mb-4" method="GET" action="index.php">
  <div class="input-group">
    <input type="text" class="form-control" name="keyword" placeholder="搜尋留言…" value="<?= htmlspecialchars($keyword) ?>">
    <button class="btn btn-outline-secondary" type="submit">搜尋</button>
  </div>
</form>

<?php if (count($messages) === 0): ?>
  <p class="text-muted">目前沒有留言。</p>
<?php else: ?>
  <?php foreach ($messages as $msg): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($msg['name']) ?></h5>
        <p class="card-text"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
        <p class="card-text">
          <small class="text-muted">
            發佈時間：<?= $msg['created_at'] ?><br>
            <?= $msg['updated_at'] ? "更新時間：{$msg['updated_at']}" : "" ?>
          </small>
        </p>
        <div class="d-flex gap-2">
          <a href="edit.php?id=<?= $msg['id'] ?>" class="btn btn-sm btn-primary">編輯</a>
          <form method="POST" action="delete.php" onsubmit="return confirm('確定要刪除這則留言嗎？')">
            <input type="hidden" name="id" value="<?= $msg['id'] ?>">
            <button type="submit" class="btn btn-sm btn-danger">刪除</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php
require_once('footer.php');
?>