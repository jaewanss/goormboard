<?php

include('database.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// 게시글 목록 조회
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// 게시글 목록 출력
echo "<h2>게시판</h2>";
echo "<a href='write.php'>글작성</a><br><br>";
echo "<a href='logout.php'>로그아웃</a><br><br>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>{$row['title']}</h3>";
        echo "<p>{$row['content']}</p>";
        echo "<p>작성일: {$row['created_at']}</p>";
        echo "<a href='edit.php?id={$row['id']}'>수정</a> ";
        echo "<a href='delete.php?id={$row['id']}'>삭제</a>";
        echo "<hr>";
    }
} else {
    echo "등록된 게시글이 없습니다.";
}

$conn->close();
?>
