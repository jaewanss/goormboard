<?php
$host = 'localhost';
$dbuser = 'jw98';
$dbpassword = 'vHspWxO4R@5]lH@N';
$dbname = 'board';

$conn = new mysqli($host, $dbuser, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
