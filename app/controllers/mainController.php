<?php

require_once 'app/models/taskModel.php';
require_once 'app/models/userModel.php';

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
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $status = $task['status'];
                $taskData = [
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

                    $taskData['text'] = 'text-success';
                }
                $taskData += [
                    'taskId' => $task['id'],
                    'description' => $task['description'],
                    'buttonStatus' => $buttonStatus,
                    'button' => $button,
                    'statusClass' => $statusClass,
                    'newStatus' => $newStatus,
                ];
                $data[] = $taskData;
            }
        }
        $this->view->generate('main_view.php', $data);
    }

    public function actionAddTask()
    {
        $this->model->addTask($this->userId, $_POST['description']);
        header('Location: /');
    }

    public function actionChangeTaskStatus()
    {
        $id = $_POST['id'];
        settype($id, 'int');
        $this->model->changeTaskStatus($id, $_POST['status'], $this->userId);
        header('Location: /');
    }

    public function actionDeleteTask()
    {
        $id = $_POST['id'];
        settype($id, 'int');
        $this->model->deleteTask($id, $this->userId);
        header('Location: /');
    }

    public function actionReadyAllTasks()
    {
        $tasks = $this->model->getUserTasks($this->userId);
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $this->model->changeTaskStatus($task['id'], 'Ready', $task['user_id']);
            }
        }
        header('Location: /');
    }

    public function actionRemoveAllTasks()
    {
        $tasks = $this->model->getUserTasks($this->userId);
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $this->model->deleteTask($task['id'], $task['user_id']);
            }
        }
        header('Location: /');
    }
}
