<?php

class LoginController extends Controller
{
    function __construct()
    {
        $this->model = new user();
        $this->view = new View();
    }

    public function actionIndex()
    {
        if (isset($_SESSION['session_username'])) {
            header('Location: /');
        } else {
            $this->view->generate('login_view.php');
        }
    }

    public function actionLogin()
    {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        if (!empty($login) && !empty($password)) {
            $user = $this->model->login($login);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['session_username'] = $user['id'];
                header('Location: /');
            }
        }
    }
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['session_username']);
        session_destroy();
        header('Location: /Login/Index');
    }

}