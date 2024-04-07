<?php
include_once '../application/db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $userId = $_SESSION["id"];
// Запрос на получение информации о пользователе
 $query = "SELECT email, created, info FROM users WHERE id = ?";
 $stmt = $conn->prepare($query);
 $stmt->bind_param("i", $userId);
 $stmt->execute();
 $stmt->bind_result($email, $created, $info);
 $stmt->fetch();
 $stmt->close();
// Формируем строку с данными о пользователе, разделенными символом '|'
 $userInfo = $email . '|' . $created . '|' . $info;
// Отправляем данные
 echo $userInfo;
} else {
 echo "error|Недопустимый метод запроса.";
exit;
}
?>
