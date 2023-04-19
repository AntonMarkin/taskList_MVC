<?php

include_once('connection.php');

class User extends Model
{
    public static function getCurrentUser($id)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where id = ?');
        $query->execute(array($id));
        return $query;
    }

    public function login($login)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('select * from users where login = ?');
        $query->execute(array($login));
        return $query->fetch();
    }

    public function register($login, $password)
    {
        $pdo = connectDB();
        $query = $pdo->prepare('insert into users(login, password) values(?, ?)');
        $query->execute(array($login, $password));
        return $query;
    }
}