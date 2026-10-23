<?php
require_once 'env.php';


//ユーザ登録フォームの作成


function connect()
{
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        // 関数内では echo せず、リモコン($pdo)を返すだけにする
        return $pdo;

    } catch (PDOException $e) {
        echo "データベース接続失敗: " . $e->getMessage();
        exit();
    }   
}

// 1回だけ接続を実行して変数に入れる
$pdo = connect();

// 変数 $pdo が入っていれば（接続が成功していれば）メッセージを出す
if ($pdo) {
    echo "データベース接続成功";
}