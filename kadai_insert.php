<?php
//1. POSTデータ取得
$title = $_POST["title"];
$author = $_POST["author"];
$url = $_POST["url"];
$coment  = $_POST["coment"]; //追加されています

//*** 外部ファイルを読み込む ***
include("kadai_funcs.php");
$pdo = db_conn();

//2. DB接続します


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(title,author,url,coment,indate)VALUES(:title,:author,:url,:coment,sysdate())");
$stmt->bindValue(':title',  $title,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',   $url,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':coment',$naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化を使う！*****************
    sql_error($stmt);
    //$error = $stmt->errorInfo();
    //exit("SQLError:".$error[2]);
}else{
    //*** function化を使う！*****************
    //header("Location: kadai_index.php");
    redirect("kadai_index.php");
    exit();
}

?>
