<?php

require_once 'app/models/userModel.php';

class loginController extends Controller
{
    function __construct()
    {
        $this->model = new userModel();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->view->generate('login_view.php');
    }

    public function actionLogin()
    {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        if (!empty($login) && !empty($password)) {

            $query = $this->model->login();
            $userExist = $query->execute(array($login));
            $user = $query->fetch();
            if ($userExist && password_verify($password, $user['password'])) {
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
        $this->actionIndex();
    }

}