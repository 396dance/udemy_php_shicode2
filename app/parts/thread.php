<?php

  // データベースへ接続
  include_once("./app/database/connect.php");
  // コメントデータを登録する
  include("app/functions/comment_add.php"); 
  // スレッドデータを取得する
  include("app/functions/thread_get.php"); 

?>

<?php foreach ($thread_array as $thread) : ?>
<!-- スレッドエリア -->
<div class="threadWrapper">
    <div class="childWrapper">
      <div class="threadTitle">
        <span>【タイトル】</span>
        <h1><?php echo $thread["title"] ?></h1>
      </div>
      
      <?php include("app/parts/commentSection.php"); ?>
      <?php include("app/parts/commentForm.php"); ?>

      
    </div>
</div>
<?php endforeach ?>