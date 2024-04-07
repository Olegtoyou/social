<?php
session_start();
require_once '../application/db.php'; // Подключаем файл db.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Подключение к базе данных уже установлено в файле db.php, поэтому нет необходимости создавать новое соединение
global $conn; // Используем глобальную переменную $conn из файла db.php
// Проверяем, установлена ли сессия с идентификатором пользователя
if (isset($_SESSION['id'])) {
 $senderId = $_SESSION['id'];
 } else {
 echo "Error: Unauthorized access";
exit;
 }
// Получаем идентификатор получателя сообщения из POST-запроса
 $receiverId = $_POST['receiver_id'];
// Подготавливаем SQL запрос для выборки сообщений
 $stmt = $conn->prepare("SELECT messages.message_text, messages.timestamp, sender.us_name AS sender_name
FROM messages
JOIN users AS sender ON messages.sender_id = sender.id
WHERE
(messages.sender_id = ? AND messages.receiver_id = ?) OR
(messages.sender_id = ? AND messages.receiver_id = ?)
ORDER BY messages.timestamp");
// Проверяем, была ли ошибка при подготовке запроса
if (!$stmt) {
 echo "Error in SQL query: " . $conn->error;
exit;
 }
// Привязываем параметры к подготовленному запросу
 $stmt->bind_param("iiii", $senderId, $receiverId, $receiverId, $senderId);
// Выполняем запрос
 $stmt->execute();
// Проверяем, была ли ошибка при выполнении запроса
if ($stmt->error) {
 echo "Error executing SQL query: " . $stmt->error;
exit;
 }
// Получаем результат запроса
$result = $stmt->get_result();
$messages = [];
// Обрабатываем результаты запроса
while ($row = $result->fetch_assoc()) {
$messages[] = $row;
}
// Выводим сообщения в формате: "Имя отправителя: текст сообщения (время отправки)"
foreach ($messages as $message) {
$senderName = isset($message['sender_name']) ? $message['sender_name'] : 'Unknown User';
echo "$senderName: {$message['message_text']} ({$message['timestamp']})\n";
}
// Закрываем запрос и соединение с базой данных
$stmt->close();
}
?>
