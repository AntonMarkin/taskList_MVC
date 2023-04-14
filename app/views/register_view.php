<?php

if(isset($_SESSION['session_username'])){
    header('Location: /');
}
?>
<div class="container">
    <div>
        <h1>Регистрация</h1>
        <form action="/register/Register" id="registerform" method="post" name="registerform">
            <p><label for="user_pass">Логин<br>
                    <input class="input" id="login" name="login" size="32" type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password" size="32" type="password" value=""></label>
            </p>
            <p class="submit"><input class="btn btn-primary" id="register" name="register" type="submit"
                                     value="Зарегистрироваться"></p>
            <p class="regtext">Уже зарегистрированы? <a href="/login">Введите имя пользователя</a>!</p>
        </form>
    </div>
