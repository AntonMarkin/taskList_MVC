<?php

require_once 'model_task.php';
require_once 'model_user.php';

class mainController extends Controller
{
    public $userId;
    function __construct()
    {
        $this->userId = userModel::getCurrentUser()['id'];
        $this->model = new taskModel();
        $this->view = new View();
    }
    public function actionIndex()
    {
        $tasks = $this->model->getUserTasks($this->userId);
        $data = null;
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $status = $task['status'];
                $taskData = [
                    'description' => $task['description'],
                    'text' => null,
                ];
                if ($status == 'Unready') {
                    $buttonStatus = 'READY';
                    $button = 'btn-outline-success';
                    $statusClass = 'border-dark';
                    $newStatus = 'Ready';
                } elseif ($status == 'Ready') {
                    $buttonStatus = 'UNREADY';
                    $button = 'btn-outline-dark';
                    $statusClass = 'border-success';
                    $newStatus = 'Unready';

                    $taskData = ['text' => 'text-success'];
                }
                $taskData = [
                    'buttonStatus' => $buttonStatus,
                    'button' => $button,
                    'statusClass' => $statusClass,
                    'newStatus' => $newStatus,
                ];
                $data = [$taskData];
            }
        }
        $this->view->generate('main_view.php', $data);
    }
    public function actionAddTask()
    {
        return $this->model->addTask($this->userId, $_POST['description']);
    }
    public function actionChangeTaskStatus()
    {
        $id = $_POST['id'];
        settype($id, 'int');
        return $this->model->changeTaskStatus($id, $_POST['status'], $this->userId);
    }
    public function actionDeleteTask()
    {
        $id = $_POST['id'];
        settype($id, 'int');
        return $this->model->deleteTask($id, $this->userId);
    }
    public function actionReadyAllTasks()
    {
        $tasks = $this->model->getUserTasks($this->userId);
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $this->model->changeTaskStatus($task['id'], 'Ready', $task['user_id']);
            }
        }
    }
    public function actionRemoveAllTasks()
    {
        $tasks = $this->model->getUserTasks($this->userId);
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $this->model->deleteTask($task['id'], $task['user_id']);
            }
        }
    }
}
