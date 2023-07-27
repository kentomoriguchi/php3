<?php
//１．PHP
//select.phpの[PHPコードだけ！]をマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("kadai_funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id"); //SQLをセット
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $row = $stmt->fetch();//1レコードだけ取得する方法
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>Gs Book</legend>
     <label>タイトル：<input type="text" name="title" value="<?=$row["title"]?>"></label><br>
     <label>著者：<input type="text" name="author" value="<?=$row["author"]?>"></label><br>
     <label>url:<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
     <label>コメント<textArea name="coment" rows="4" cols="40"><?=$row["coment"]?></textArea></label><br>
     <!-- idを隠して送信 -->
     <input type="hidden" name="id" value="<?=$id?>">
     <!-- idを隠して送信 -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

