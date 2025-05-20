 <?php
// 檢查是否送出表單
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? "";
    $message = $_POST["message"] ?? "";
    if (empty($username) || empty($message)) {
        echo "請填寫完整的名字與留言內容。";
    } else {
        echo "<h2>留言送出成功！</h2>";
        echo "<p><strong>名字：</strong>" . htmlspecialchars($username) . "</p>";
        echo "<p><strong>留言內容：</strong>" . nl2br(htmlspecialchars($message)) . "</p>";
    }
} else {
    echo "請透過表單送出資料。";
}
?>


