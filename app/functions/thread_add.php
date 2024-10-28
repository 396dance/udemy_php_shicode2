<?php
  $error_message = array();


  // submitButtonが押された時に走る処理
  if (isset($_POST["threadSubmitButton"])) {

    // スレッド名入力チェック
    if (empty($_POST["title"])){
      $error_message["title"] = "タイトルを入力してください";
    } else {
      // エスケープ処理
      $escaped["title"] = htmlspecialchars($_POST["title"],ENT_QUOTES,"UTF-8");
    }

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
  
      // トランザクション開始
      $pdo->beginTransaction();

      
      try {
        // スレッドを追加
      $sql= "INSERT INTO `thread` (`title`) VALUES (:title);";
      $statement= $pdo->prepare($sql);
  
      // 値をセットする
      $statement->bindParam(":title",$escaped["title"], PDO::PARAM_STR);
     
      // SQL実行
      $statement->execute();
      
      // コメントも追加
      $sql= "INSERT INTO `comment` (`username`,`body`,`post_date`,`thread_id`) 
      VALUES (:username, :body, :post_date, (SELECT id FROM thread WHERE title = :title));";
      $statement= $pdo->prepare($sql);
      
      // 値をセットする
      $statement->bindParam(":username",$escaped["username"], PDO::PARAM_STR);
      $statement->bindParam(":body",$escaped["body"], PDO::PARAM_STR);
      $statement->bindParam(":post_date",$post_date, PDO::PARAM_STR);
      $statement->bindParam(":title",$escaped["title"], PDO::PARAM_STR);
      
      // SQL実行
      $statement->execute();

      $pdo->commit();
      } catch (Exception $e) {
        $pdo->rollback();
      }
      // 掲示板ページに遷移する
      header("Location: http://localhost:8888/udemy_php_shincode2/");
      
    }

  }

  