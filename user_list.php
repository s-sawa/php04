<?php
session_start();
include "funcs.php";
sschk();
?>
<?php
//変数がセットされている場合に実行させる
if (isset($_GET["order"])) {
  $order = $_GET["order"];
} else {
  //デフォルト
  $order = "desc";
}
if (isset($_GET["rate"])) {
  $s_rate = $_GET["rate"];
  echo $s_rate;
}
//1.  DB接続します
require_once 'funcs.php';
// $pdoの型指定  $pdoがPDOという型であることを示す。これを書かないとintelephenseでエラー表示となる。動きには問題ない
/** @var PDO $pdo */
$pdo = db_conn();

//２．データ登録SQL作成
$sql = 'SELECT * FROM gs_user_table ORDER BY kanri_flg ' . h($order) . ';';
// $sql = 'SELECT * FROM gs_user_table ORDER BY id ' . h($order) . ';';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:" . $error[2]);
}
//全データ取得 object変数として全て(ALL)渡す
$userlists =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う
$json = json_encode($userlists, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>tabelog</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }

    .pointer-cursor {
      cursor: pointer;
    }

    .test {
      display: flex;
    }

    tr {
      width: 100px;
    }

    td {
      border: 1px solid black;
      padding: 5px;
      text-align: center;
    }
  </style>
</head>

<body id="main">
  <!-- Head[Start] -->
  <header>
    <?php include("menu.php"); ?>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <div>
    <div class="container jumbotron">
      <div>
        <?php foreach ($userlists as $userlist) { ?>
          <table>
            <tr>
              <td style="width:120px">
                名前:<?= h($userlist["name"])  ?>
              </td>
              <td style="width:120px">
                管理フラグ：<?= h($userlist["kanri_flg"])  ?>
              </td>
              <td style="width:120px">
                ライフフラグ:<?= h($userlist["life_flg"])  ?>
              </td>
              <td>
                <a href="delete_user.php?id=<?= $userlist["id"] ?>"><img src="./img/deletebtn.svg" alt=""  width="20px" class="pointer-cursor"></a>
              </td>
            </tr>
          </table>
          <!-- <p>名前<?= h($userlist["name"])  ?></p>
            <p>管理フラグ：<?= h($userlist["kanri_flg"])  ?></p>
            <p>ライフフラグ:<?= h($userlist["life_flg"])  ?></p>
            <a href="delete.php?id=<?= $userlist["id"] ?>"><img src="./img/deletebtn.svg" alt="" onclick='getId(<?= $v["id"] ?>)' width="25px" class="pointer-cursor"></a> -->
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Main[End] -->
  <script>
    //JSON受け取り
    const json = JSON.parse('<?= $json ?>');
    console.log(json);

    function getIndex(id) {
      const index = json.findIndex(ele => ele.id == id);
      return index;
    }
  </script>
</body>

</html>