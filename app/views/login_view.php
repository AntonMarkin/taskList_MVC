<div class="container">
    <div id="login">
        <h1>Вход</h1>
        <form action="/login/Login" method="post" >
            <p><label for="user_login">Логин<br>
                    <input class="input" id="login" name="login" size="20"
                           type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password" size="20"
                           type="password" value=""></label></p>
            <p class="submit"><input class="btn btn-primary" name="logIn" type="submit" value="Вход"></p>
            <p class="regtext">Еще не зарегистрированы? <a href="/register">Регистрация</a>!</p>
        </form>
    </div>
</div>
