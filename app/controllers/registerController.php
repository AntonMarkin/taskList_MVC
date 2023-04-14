<?php

require_once 'loginController.php';
require_once 'app/models/userModel.php';

class registerController extends Controller
{
    function __construct()
    {
        $this->model = new userModel();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->view->generate('register_view.php');
    }

    public function actionRegister()
    {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        if (!empty($login) && !empty($password)) {

            $query = $this->model->login();
            $query->execute(array($login));

            if ($query->rowCount() == 0) {
                $query = $this->model->register();
                $query->execute([$login, password_hash($password, PASSWORD_BCRYPT)]);
            }
        }
        $login = new loginController();
        $login->actionLogin();
    }

}