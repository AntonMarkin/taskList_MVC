<?php

require_once 'model_task.php';

class mainController extends Controller
{
    function __construct()
    {
        $this->model = new taskModel();
        $this->view = new View();
    }
    public function actionIndex()
    {
        $data = $this->model->getdata();
        $this->view->generate('portfolio_view.php', 'template_view.php', $data);
    }
    public function actionAddTask()
    {

    }
    public function actionChangeTaskStatus()
    {

    }
    public function actionDeleteTask()
    {

    }
    public function actionReadyAllTasks()
    {

    }
    public function actionRemoveAllTasks()
    {

    }
}
