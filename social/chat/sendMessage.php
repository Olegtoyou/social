<?php
require_once '../application/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 session_start();
if (isset($_SESSION['id'])) {
 $senderId = $_SESSION['id'];
 } else {
 echo json_encode(["status" => "error", "message" => "Error: User not authenticated"]);
exit;
 }
 $receiverId = $_POST['receiver_id'];
 $messageText = $_POST['message'];
// Используем параметризованный запрос, чтобы избежать SQL-инъекций
 $sql = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("iis", $senderId, $receiverId, $messageText);
// Добавим вывод в консоль для проверки
if ($stmt->execute()) {
 echo json_encode(["status" => "success", "message" => "Message sent successfully"]);
 } else {
 echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
 }
 $stmt->close();
}
?>
