<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"]; //id
$lpw = $_POST["lpw"]; //password

//1.  DB接続します
include("funcs.php");
// $pdoの型指定  $pdoがPDOという型であることを示す。これを書かないとintelephenseでエラー表示となる。動きには問題ない
/** @var PDO $pdo */
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$sql = "SELECT * FROM gs_user_table WHERE lid=:lid AND life_flg=0"; //passハッシュ化されていてここではイコールできない
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if ($status == false) {
  sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()



//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
//ハッシュ化した文字と入力した文字を比較する
$pw = password_verify($lpw, $val["lpw"]); //true or false
if ($pw) {  //trueだったらの意味
  //Login成功時
  //サーバーに以下を預ける
  $_SESSION["chk_ssid"]  = session_id(); //自分のセッションIDを取得する。
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  //Login成功時（リダイレクト）
  redirect("index.php");
} else {
  //Login失敗時(Logoutを経由：リダイレクト)
  redirect("login.php");
}
exit();
