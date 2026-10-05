<?php
// データベース接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs_yt;charset=utf8', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "データベース接続失敗: " . $e->getMessage();
    exit();
}

$comment_array = array();

// 投稿ボタンが押された場合
if (!empty($_POST["submitButton"])) {
    $username = $_POST["username"] ?? '';
    $comment = $_POST["comment"] ?? '';

    // 簡単なバリデーション（空でないか）
    if (!empty($username) && !empty($comment)) {
        $sql = "INSERT INTO bbs_table (username, comment, postDate) VALUES (:username, :comment, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();

        // 二重投稿防止のためにリロード
        header("Location: " . $_SERVER['SCRIPT_NAME']);
        exit;
    }
}

// データベースからコメントを取得
try {
    $sql = "SELECT id, username, comment, postDate FROM bbs_table ORDER BY postDate DESC";
    $stmt = $pdo->query($sql);
    $comment_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "データ取得失敗: " . $e->getMessage();
}

// 接続を閉じる
$pdo = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>PHP掲示板</title>
</head>
<body>
    <h1 class="title">PHPで掲示板アプリ</h1>
    <hr>
    <div class="boardWrapper">
        <section>
            <article>
                <?php if (!empty($comment_array)): ?>
                    <?php foreach ($comment_array as $comment) : ?>
                        <div class="wrapper">
                            <div class="nameArea"> 
                                <span>名前:</span>
                                <p class="username"><?php echo htmlspecialchars($comment["username"], ENT_QUOTES, 'UTF-8'); ?></p>
                                <time>:<?php echo htmlspecialchars($comment["postDate"], ENT_QUOTES, 'UTF-8'); ?></time>
                            </div>
                            <p class="comment"><?php echo nl2br(htmlspecialchars($comment["comment"], ENT_QUOTES, 'UTF-8')); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>まだコメントはありません。</p>
                <?php endif; ?>
            </article>   
        </section>

        <form class="formWrapper" method="POST">
            <div>
                <label for="username">名前 :</label>
                <input type="text" id="username" name="username">
            </div>
            <div>
                <textarea class="commentTextArea" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" value="書き込む" name="submitButton">
            </div>
        </form>
    </div>
</body>
</html>