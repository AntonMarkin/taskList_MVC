<?php

include_once('connection.php');

class userModel extends Model
{
    public static function getCurrentUser()
    {
        $pdo = connectDB();
        $user = $pdo->prepare('select * from users where id = ?');
        $id = $_SESSION['session_username'];
        settype($id, 'integer');
        $user->execute(array($id));
        return $user->fetch();
    }
    public function login()
    {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where login = ?');
        return $query;
    }
    public function register()
    {
        $pdo = connectDB();
        $query = $pdo->prepare('insert into users(login, password) values(?, ?)');
        return $query;
    }
}