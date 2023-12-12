<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    include('database.php');
    session_start();

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "오류: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>

<h2>글쓰기</h2>

<form method="POST" action="">
    <label for="title">제목:</label><br>
    <input type="text" id="title" name="title" required><br>

    <label for="content">내용:</label><br>
    <textarea id="content" name="content" rows="4" required></textarea><br>

    <input type="submit" value="글쓰기">
</form>

</body>
</html>
