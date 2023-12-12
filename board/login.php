<?php
include('database.php');
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $errorMessage = "잘못된 비밀번호입니다.";
        }
    } else {
        $errorMessage = "사용자를 찾을 수 없습니다.";
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
    <title>로그인</title>
</head>
<body>

<h2>로그인</h2>

<?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">사용자명:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">비밀번호:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="로그인">
</form>

<p>아직 계정이 없으신가요? <a href="register.php">회원가입</a></p>

</body>
</html>
