<?php
$title = "PHPテスト";
$content = "PHPのテストです。";
$post_at = "2026/10/5";
$tag = ['PHP','プログラミング'];
$status = true;

const ID = 1;

$blog1 = array(
    'id' => ID,
    'title' => $title,
    'content' => $content,
    'post_at' => $post_at,
    'tag' => $tag,
    'status' => $status
);
//blog2
$blog2 = array(
    'id2' => ID,
    'title2' => $title,
    'content2' => $content,
    'post_at2' => $post_at,
    'tag2' => $tag,
    'status2' => $status
);
//多次元配列
//$blogs = array(
//    $blog1,
  //  $blog2
//);
// echo 'pre>';
// var_dump($blogs);
// echo '</pre>';
foreach($blog1 as $blog){
    echo $blog;
}