<?php
include('database.php');
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $errorMessage = "회원가입에 실패했습니다.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>

<h2>회원가입</h2>

<?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">사용자명:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">비밀번호:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="회원가입">
</form>

<p>이미 계정이 있으신가요? <a href="login.php">로그인</a></p>

</body>
</html>
