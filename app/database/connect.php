<?php

  $user="root";
  $pass="root";

  try {
    // DBと接続
    $pdo = new PDO('mysql:host=localhost;dbname=2chan-bbs2', $user, $pass);
    // echo "DBとの接続を成功しました";
  } catch (PDOException $error) {
    // 例外メッセージを取得するための関数を使い、それをecho文で画面出力する
    echo $error ->getMessage();
    echo "DBとの接続を失敗しました";
  }
?>