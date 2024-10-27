<?php

// 配列をつくる
  $thread_array = array();

  // コメントデータをテーブルから取得する
  $sql = "SELECT * FROM thread";
  // SQLを実行する準備をする
  $statement = $pdo->prepare($sql);
  // 上記のSQLを実行する
  $statement->execute();

  // SQL文で取得したデータを連想配列で取得する
  $thread_array = $statement;

  // DB接続を切る
  $pdo = null;
  $statement = null;

  ?>