<?php
$id = $_POST["id"];
$name = $_POST["name"];
$r_name = $_POST["r_name"];
$r_url = $_POST["r_url"];
$r_kind = $_POST["r_kind"];
$visit_date = $_POST["visit_date"];
$rate = $_POST["rate"];
$impression = $_POST["impression"];

//1.  DB接続します
require_once 'funcs.php';
// $pdoの型指定  $pdoがPDOという型であることを示す。これを書かないとintelephenseでエラー表示となる。動きには問題ない
/** @var PDO $pdo */
$pdo = db_conn();

$sql = 'UPDATE my_tabelog2 SET name=:name, r_name=:r_name, r_url=:r_url, r_kind=:r_kind, visit_date=:visit_date, rate=:rate, impression=:impression WHERE id=:id;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':r_name', $r_name, PDO::PARAM_STR);
$stmt->bindValue(':r_url', $r_url, PDO::PARAM_STR);
$stmt->bindValue(':r_kind', $r_kind, PDO::PARAM_STR);
$stmt->bindValue(':visit_date', $visit_date, PDO::PARAM_STR);
$stmt->bindValue(':rate', $rate, PDO::PARAM_STR);
$stmt->bindValue(':impression', $impression, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false) {
  sql_error($stmt); //関数実行 
}else {
  redirect("select.php");
}
?>