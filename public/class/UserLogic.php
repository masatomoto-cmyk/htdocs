<?php

require_once '../dbconnect.php';

class UserLogic
{
    /**
     * ユーザを登録する
     * @param string $username ユーザ名
     * @param string $email メールアドレス
     * @param string $password パスワード
     */
    public static function createUser($username, $email, $password)
    {
        // データベースにユーザを登録するロジック
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    try {   
        connect()->prepare($sql)->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    } catch (PDOException $e) {
        echo "ユーザ登録失敗: " . $e->getMessage();
        exit();
    }
    }
}