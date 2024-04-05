<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "social";
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
