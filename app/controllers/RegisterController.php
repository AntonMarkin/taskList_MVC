<?php

class RegisterController extends Controller
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
            $this->view->generate('register_view.php');
        }
    }

    public function actionRegister()
    {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        if (!empty($login) && !empty($password)) {
            $query = $this->model->login($login);
            if ($query->rowCount() == 0) {
                $this->model->register($login, password_hash($password, PASSWORD_BCRYPT));
            }
        }
        header('Location: /Login/Login');
    }

}