<?php
$blog = $_POST;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ</title>
</head>
<body>
    <h2>タイトル: <?php echo htmlspecialchars($blog['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
    <p>カテゴリ: <?php echo htmlspecialchars($blog['category'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
    <p>投稿日時: <?php echo htmlspecialchars($blog['post_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
    <p>本文:</p>
    <p><?php echo nl2br(htmlspecialchars($blog['content'] ?? '', ENT_QUOTES, 'UTF-8')); ?></p>
    <hr>
</body>
</html>