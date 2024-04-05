<?php
include("../application/users.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="device-width, initial-scale=1.0">
<title>Редактировать профиль</title>
<link rel="stylesheet" href="../css/editer-styles.css">
<link rel="stylesheet" href="../css/menu.css">
</head>
<body>
<header>
<h1>Редактировать профиль</h1>
</header>
<?php
include("../menu.php");
?>
<section id="edit-profile-form">
<form action="editer_profile.php" method="post">
<label for="name">ФИО:</label><br>
<input type="text" id="user-name" name="user-name" value="<?php echo isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?>"><br>
<label for="age">Возраст:</label><br>
<input type="text" id="user-age" name="user-age" value="<?php echo isset($_SESSION['age']) ? $_SESSION['age'] : ''; ?>"><br>
<label for="email">Email:</label><br>
<input type="email" id="user-email" name="user-email"><br>
<label for="info">О себе:</label><br>
<textarea id="user-info" name="user-info"></textarea><br>
<label for="password">Пароль:</label><br>
<input type="password" name="pass-first"><br>
<label for="confirm_password">Повторите пароль:</label><br>
<input type="password" name="pass-second"><br>
<button name="button-upd" type="submit">Отправить</button>
</form>
</section>
</form>
<script src="../js/profile.js" defer></script>
</body>
</html>
