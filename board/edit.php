<?php
include('database.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// 게시글 조회
$sql = "SELECT * FROM posts WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "해당 게시글이 존재하지 않습니다.";
    exit();
}

// 수정 폼 출력
echo "<h2>게시글 수정</h2>";
echo "<form action='update_post.php' method='post'>";
echo "<input type='hidden' name='id' value='{$id}'>";
echo "제목: <input type='text' name='title' value='{$row['title']}'><br>";
echo "내용: <textarea name='content'>{$row['content']}</textarea><br>";
echo "<input type='submit' value='수정'>";
echo "</form>";

$conn->close();
?>