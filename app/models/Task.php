<?php

include_once('connection.php');

class Task extends Model
{
    public function getUserTasks($userId)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from tasks where user_id = ?');
        $query->execute(array($userId));
        return $query;
    }
    public function addTask($user_id, $description)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('insert into tasks (user_id, description, status) values(?, ?, ?)');
        $check = $query->execute([$user_id, $description, 'Unready']);
        return $check;
    }
    public function changeTaskStatus($status, $id, $user_id)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('update tasks set status = ? where id = ? and user_id = ?');
        $check = $query->execute([$status, $id, $user_id]);
        return $check;
    }
    public function deleteTask($id, $user_id)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('delete from tasks where id = ? and user_id = ?');
        $check = $query->execute([$id, $user_id]);
        return $check;
    }
    public function deleteAllTasks($user_id)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('delete from tasks where user_id = ?');
        $check = $query->execute(array($user_id));
        return $check;
    }
}
