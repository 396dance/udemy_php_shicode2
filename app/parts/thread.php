<?php

  // 指定したファイルを１回だけ読み込む
  include_once("./app/database/connect.php");

  // コメントデータを登録する
  include("app/functions/comment_add.php");

  // コメントデータを取得する
  include("app/functions/comment_get.php"); 

?>


<!-- スレッドエリア -->
<div class="threadWrapper">
    <div class="childWrapper">
      <div class="threadTitle">
        <span>【タイトル】</span>
        <h1>2ちゃんねる掲示板を作ってみた</h1>
      </div>
      
      <?php include("app/parts/commentSection.php"); ?>
      <?php include("app/parts/commentForm.php"); ?>

      
    </div>
</div>