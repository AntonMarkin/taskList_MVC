<?php

class userModel extends Model
{
    public function getCurrentUser()
    {
        $pdo = connectDB();
        $user = $pdo->prepare('select * from users where id = ?');
        $id = $_SESSION['session_username'];
        settype($id, 'integer');
        $user->execute(array($id));
        return $user->fetch();
    }
}