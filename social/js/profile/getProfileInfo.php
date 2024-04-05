<?php
include_once '../application/db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION["id"];

    $query = "SELECT email, created, info FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($email, $created, $info);
    $stmt->fetch();
    $stmt->close();
    $userInfo = $email . '|' . $created . '|' . $info;
    echo $userInfo;
} else {
    echo "error|Нодопустимый метод запроса.";
    exit;
}
