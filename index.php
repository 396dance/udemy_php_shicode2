<?php

  // 指定したファイルを１回だけ読み込む
  include_once("./app/database/connect.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2ちゃんねる掲示板</title>
  <link rel="stylesheet" href="./asets/css/style.css">
</head>
<body>
  <!-- タイトルの2ちゃんねる掲示板表示 -->
  <?php include("app/parts/header.php"); ?>
  <!-- バリデーションエラーメッセージ表示 -->
  <?php include("app/parts/validation.php"); ?>
  <!-- スレッドを表示する -->
  <?php include("app/parts/thread.php"); ?>
  <!-- 新規スレッド書き込みボタン -->
  <?php include("app/parts/newThreadButton.php"); ?>
  
</body>
</html>