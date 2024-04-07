<?php
session_start(); // Инициализация сессии
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="device-width, initial-scale=1.0">
<title>Профиль пользователя</title>
<link rel="stylesheet" href="../css/profile-styles.css">
<link rel="stylesheet" href="../css/menu.css">
</head>
<body>
<header>
<h1>Профиль пользователя</h1>
<!-- HTML-код для кнопки выхода -->
<form action="logout.php" method="post">
<button type="submit" name="logoutButton">Выйти</button>
</form>
</header>
<?php
include("../menu.php");
?>
<section id="profile-info">
<h2>Информация о пользователе</h2>
<!-- Контейнер для отображения изображения -->
<div id="profile-picture-container">
<img id="profile-picture" src="avatars/placeholder.png" alt="avatars/placeholder.png">
</div>
<!-- Вставляем имя пользователя из сессии -->
<p>ФИО: <span class="info" id="user-name"><?php echo isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?></span><p>
<!-- Вставляем возраст пользователя из сессии -->
<p>Возраст: <span class="info" id="user-age"><?php echo isset($_SESSION['age']) ? $_SESSION['age'] : ''; ?></span></p>
<p>Дата создания аккаунта: <span class="info" id="account-creation-date"></span></p>
<p>Email: <span class="info" id="user-email"></span></p>
<p>О себе: <span class="info" id="user-info"></span></p>
<h3>Панель управления</h3>
<button id="edit-profile">Редактировать Профиль</button>
<button id="admin-chat">Написать администратору</button>
<!-- Кнопка обновления картинки -->
<button id="update-picture">Обновить картинку</button>
<!-- Кнопка удаления картинки -->
<button id="delete-picture">Удалить картинку</button>
<!-- Элемент для загрузки новой картинки -->
<input type="file" id="file-input" accept="image/*" style="display: none">
</section>
<section id="user-posts">
<h2>Мои посты</h2>
<!-- Здесь будут отображаться ранее созданные посты с их лайками и комментариями -->
<ul id="posts-list">
<!-- Пример поста -->
<li>
<p>Текст поста</p>
<p>Комментарии: <span class="comments-count">5</span></p>
</li>
</ul>
<h3>Панель управления</h3>
<button onclick="document.location='editer_profile.php'" id="edit-profile">Редактировать Профиль</button>
</section>
<script src="../js/profile.js" defer></script>
</body>
</html>
