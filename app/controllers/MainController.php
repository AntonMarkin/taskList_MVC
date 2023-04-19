<?php

class MainController extends Controller
{
    public $user;

    function __construct()
    {
        $this->model = new Task();
        $this->view = new View();

        $id = $_SESSION['session_username'];
        if (isset($id)) {
            settype($id, 'integer');
            $this->user = User::getCurrentUser($id)->fetch();
        }
    }

    public function actionIndex()
    {
        if (!isset($_SESSION['session_username'])) {
            header('Location: /Login/Index');
        } else {
            $tasks = $this->model->getUserTasks($this->user['id']);
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
            $data['user'] = $this->user;
            $this->view->generate('main_view.php', $data);
        }
    }

    public function actionAddTask()
    {
        if (!empty($_POST['description'])) {
            $description = htmlspecialchars($_POST['description']);
            $this->model->addTask($this->user['id'], $description);
        }
        header('Location: /');
    }

    public function actionChangeTaskStatus()
    {
        if (!empty($_POST['id']) && !empty($_POST['status'])) {
            $id = $_POST['id'];
            settype($id, 'int');
            $status = htmlspecialchars($_POST['status']);
            $this->model->changeTaskStatus($status, $id, $this->user['id']);
        }
        header('Location: /');
    }

    public function actionDeleteTask()
    {
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            settype($id, 'int');
            $this->model->deleteTask($id, $this->user['id']);
        }
        header('Location: /');
    }

    public function actionReadyAllTasks()
    {
        $tasks = $this->model->getUserTasks($this->user['id']);
        if (isset($tasks)) {
            foreach ($tasks as $task) {
                $this->model->changeTaskStatus('Ready', $task['id'], $task['user_id']);
            }
        }
        header('Location: /');
    }

    public function actionRemoveAllTasks()
    {
        $tasks = $this->model->getUserTasks($this->user['id']);
        if (isset($tasks)) {
            $this->model->deleteAllTasks($this->user['id']);
        }
        header('Location: /');
    }
}
