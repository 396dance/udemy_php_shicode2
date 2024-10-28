<?php

// 配列をつくる
  $comment_array = array();

  // コメントデータをテーブルから取得する
  $sql = "SELECT * FROM comment";
  // SQLを実行する準備をする
  $statement = $pdo->prepare($sql);
  // 上記のSQLを実行する
  $statement->execute();

  // SQL文で取得したデータを連想配列で取得する
  $comment_array = $statement;

  