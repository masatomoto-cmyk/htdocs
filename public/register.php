<?php
require_once '../class/UserLogic.php';
// エラーメッセージ配列
$err = [];

// POSTリクエストの場合のみバリデーションを実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTデータの取得
    $username      = filter_input(INPUT_POST, 'username');
    $email         = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password      = filter_input(INPUT_POST, 'password');
    $password_conf = filter_input(INPUT_POST, 'password_conf');

    // ユーザ名
    if (!$username) {
        $err['username'] = 'ユーザ名を入力してください。';
    }

    // メールアドレス
    if (!$email) {
        $err['email'] = '正しいメールアドレスを入力してください。';
    }

    // パスワード
    if (!$password) {
        $err['password'] = 'パスワードを入力してください。';
    } elseif (!preg_match('/\A[a-z\d]{8,100}\z/i', $password)) {
        $err['password'] = 'パスワードは半角英数字8文字以上100文字以下で入力してください。';
    }

    // パスワード（確認用）
    if ($password !== $password_conf) {
        $err['password_conf'] = 'パスワードと確認用パスワードが一致しません。';
    }

    // エラーがなければここでデータベース保存などの登録処理を行う
    if (count($err) === 0) {
        // 例: registerUser($username, $email, $password);
        UserLogic::createUser($username, $email, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録完了画面</title>
    <style>
        .error-message {
            color: red;
            background-color: #fde8e8;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 15px;
        }
        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <!-- エラーがある場合の表示 -->
    <?php if (count($err) > 0): ?>
        <div class="error-message">
            <p><strong>入力内容にエラーがあります：</strong></p>
            <ul>
                <?php foreach ($err as $e): ?>
                    <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <p><a href="sign-up_form.php">フォームに戻って再入力する</a></p>

    <!-- エラーがなく正常に処理された場合の表示 -->
    <?php else: ?>
        <p>ユーザ登録が完了しました。ログインしてください。</p>
        <p><a href="login.php">ログイン画面へ</a></p>
    <?php endif; ?>

</body>
</html>