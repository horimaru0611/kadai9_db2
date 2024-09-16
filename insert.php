<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$bname   = $_POST["bname"];
$burl  = $_POST["burl"];
$comment = $_POST["comment"];


//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(bname,burl,comment,indate)VALUES(:bname, :burl, :comment, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bname', $bname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':burl', $burl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("index.php");
}
