<?php

  // 指定したファイルを１回だけ読み込む
  include_once("./app/database/connect.php");

  $error_message = array();


  // submitButtonが押された時に走る処理
  if (isset($_POST["submitButton"])) {

    // お名前の入力チェック
    if (empty($_POST["username"])){
      $error_message["username"] = "お名前を入力してください";
    } else {
      // エスケープ処理
      $escaped["username"] = htmlspecialchars($_POST["username"],ENT_QUOTES,"UTF-8");
    }
    // コメントの入力チェック
    if (empty($_POST["body"])){
      $error_message["body"] = "コメントを入力してください";
    } else {
      // エスケープ処理
      $escaped["body"] = htmlspecialchars($_POST["body"],ENT_QUOTES,"UTF-8");
    }

    if(empty($error_message)) {
      // 日付を取得する
      $post_date = date("Y-m-d H:i:s");
  
      $sql= "INSERT INTO `comment` (`username`,`body`,`post_date`) VALUES (:username, :body, :post_date);";
      $statement= $pdo->prepare($sql);
  
      // 値をセットする
      $statement->bindParam(":username",$escaped["username"], PDO::PARAM_STR);
      $statement->bindParam(":body",$escaped["body"], PDO::PARAM_STR);
      $statement->bindParam(":post_date",$post_date, PDO::PARAM_STR);
    
      $statement->execute();
    }

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

  <!-- バリデーションチェックのエラー文 -->
  <?php if (isset($error_message)): ?>
    <ul class="errorMessage">
      <?php foreach ($error_message as $error) : ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>

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