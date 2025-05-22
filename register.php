<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"] ?? "";
  $password = $_POST["password"] ?? "";

  if (!empty($email) && !empty($password)) {
    header("Location: index.php");
    exit;
  } else {
    echo "請填寫完整的 Email 和密碼。";
  }
}
?>