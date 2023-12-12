<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    include('database.php');
    session_start();
    

    $sql = "DELETE FROM posts WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "오류: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
