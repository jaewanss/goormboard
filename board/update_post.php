<?php
include('database.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

// 게시글 업데이트
$sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "게시글 수정에 실패했습니다: " . $conn->error;
}

$conn->close();
?>