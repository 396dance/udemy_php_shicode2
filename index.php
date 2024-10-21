<?php

  // 指定したファイルを１回だけ読み込む
  include_once("./app/database/connect.php");

  // submitButtonが呼ばれたらtrueとなる
  if (isset($_POST["submitButton"])) {
    $username = $_POST["username"];
    $body = $_POST["body"];
    var_dump($username);
    var_dump($body);
  }

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
  <header>
    <h1 class="title">2ちゃんねる掲示板</h1>
    <hr>
  </header>
  

  <!-- スレッドエリア -->
   <div class="threadWrapper">
    <div class="childWrapper">
      <div class="threadTitle">
        <span>【タイトル】</span>
        <h1>2ちゃんねる掲示板を作ってみた</h1>
      </div>
      <section>
        <?php foreach($comment_array as $comment) :?>
        <article>
          <div class="wrapper">
            <div class="nameArea">
              <span>名前：</span>
              <p class="username"><?php echo $comment["username"];?></p>
              <time>：<?php echo $comment["post_date"];?></time>
            </div>
            <p class="comment"><?php echo $comment["body"];?> </p>
          </div>
        </article>
        <?php endforeach ?>
      </section>

      <form class="formWrapper" method="POST">
        <div>
          <input type="submit" value="書き込む" name="submitButton">
          <label>名前：</label>
          <input type="text" name="username">
        </div>
        <div>
          <textarea class="commentTextArea" name="body"></textarea>
        </div>
      </form>
    </div>
   </div>
</body>
</html>