<?php
// Подключение к базе данных и запуск сеанса
include_once '../application/db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Получение действия из POST-запроса
 $action = $_POST["action"];
// Обработка действия в зависимости от полученного значения
if ($action === "delete") {
// Удаление картинки профиля
 $userId = $_SESSION["id"];
 $fileToDelete = "avatars/{$userId}.*";
// Получение списка файлов по маске
 $files = glob($fileToDelete);
// Удаление каждого найденного файла
foreach ($files as $file) {
 unlink($file);
 }
// Обновление записи в базе данных, указывая NULL в качестве пути к изображению профиля
 updateProfilePicturePath($userId, NULL);
// Возвращение только пути к изображению после успешного удаления
 echo getProfilePicturePath($userId);
exit;
 } elseif ($action === "update") {
// Обработка обновления картинки профиля
 $userId = $_SESSION["id"];
// Проверка наличия загруженного файла
if (!empty($_FILES["image"]["name"])) {
 $targetDir = "avatars/";
 $targetFile = $targetDir . $userId . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
// Перемещение загруженного файла в целевую директорию
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
// Обновление записи в базе данных с новым путем к изображению профиля
 updateProfilePicturePath($userId, $targetFile);
// Возвращение только пути к изображению после успешного обновления
 echo getProfilePicturePath($userId);
exit;
 } else {
 echo "error|Произошла ошибка при загрузке файла.";
 exit;
}
} else {
echo "error|Файл не был загружен.";
exit;
}
} elseif ($action === "getProfilePicture") {
// Запрос на получение пути к текущему изображению профиля
$userId = $_SESSION['id'];
// Возвращение только пути к изображению
echo getProfilePicturePath($userId);
exit;
} else {
echo "error|Некорректное действие.";
exit;
}
} else {
echo "error|Недопустимый метод запроса.";
exit;
}
// Функция для обновления пути к изображению профиля в базе данных
function updateProfilePicturePath($userId, $filePath) {
global $conn;
$updateQuery = "UPDATE users SET profile_picture = ? WHERE id = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("si", $filePath, $userId);
$stmt->execute();
$stmt->close();
}
// Функция для получения пути к изображению профиля из базы данных
function getProfilePicturePath($userId) {
global $conn;
$query = "SELECT profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($profilePicture);
$stmt->fetch();
$stmt->close();
// Если путь к изображению не NULL, возвращаем его, в противном случае возвращаем путь к placeholder
return ($profilePicture !== null) ? $profilePicture : "avatars/placeholder.png";
}
?>