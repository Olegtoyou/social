<?php
include("application/users.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/log.css">
    <title>Авторизация</title>
</head>

<body>
    <?php
    include("menu.php");
    ?>
    <div class="container">
        <form class="reg" method="post" action="auth.php">
            <h3>Авторизация</h3>
            <!-- Адрес электронной почты -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</labe <p>
                    </p>
                    <input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Мы никогда и никому не передадим вашу почт
                    </div>
            </div>
            <!-- Пароль -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <p></p>
                <input name='password' type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <!-- Кнопки Входа или Регистрации -->
            <button name="button-log" type="submit" class="btn btn-primary">Войти</button>
            <a href="registration.php">Зарегистрироваться</a>
            <div class="form-text1">Если еще не регистрировались</div>
        </form>
    </div>
    <!-- Конец Формы авторизации -->
</body>

</html>