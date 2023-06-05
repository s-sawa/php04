<?php
session_start();
include "funcs.php";
sschk();
?>
<?php
$id = $_GET["id"];
// echo $id;
require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();

$sql = "SELECT * FROM my_tabelog2 WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //:idに$idを渡す
$status = $stmt->execute();

$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ編集</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ編集</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>食べログ</legend>
                <label>投稿者：<input type="text" name="name" value="<?= $row["name"] ?>" required></label><br>
                <label>飲食店：<input type="text" name="r_name" value="<?= $row["r_name"] ?>" required></label><br>
                <label>URL：<input type="text" name="r_url" value="<?= $row["r_url"] ?>"></label><br>
                <label>ジャンル：
                    <input type="radio" id="genre-wa" name="r_kind" value="和食" <?php if ($row["r_kind"] == "和食") echo "checked"; ?>><label for="genre-wa">和食</label>
                    <input type="radio" id="genre-chu" name="r_kind" value="中華" <?php if ($row["r_kind"] == "中華") echo "checked"; ?>><label for="genre-chu">中華</label>
                    <input type="radio" id="genre-you" name="r_kind" value="洋食" <?php if ($row["r_kind"] == "洋食") echo "checked"; ?>><label for="genre-you">洋食</label>
                    <input type="radio" id="genre-other" name="r_kind" value="その他" <?php if ($row["r_kind"] == "その他") echo "checked"; ?>><label for="genre-other">その他</label>
                </label><br>
                <label>訪問：<input type="text" name="visit_date" value="<?= $row["visit_date"] ?>" required></label><br>
                <label>評価：
                    <input type="radio" id="rate-1" name="rate" value="☆" <?php if ($row["rate"] == "☆") echo "checked"; ?>><label for="rate-1">⭐️1</label>
                    <input type="radio" id="rate-2" name="rate" value="☆☆" <?php if ($row["rate"] == "☆☆") echo "checked"; ?>><label for="rate-2">⭐️2</label>
                    <input type="radio" id="rate-3" name="rate" value="☆☆☆" <?php if ($row["rate"] == "☆☆☆") echo "checked"; ?>><label for="rate-3">⭐️3</label>
                    <input type="radio" id="rate-4" name="rate" value="☆☆☆☆" <?php if ($row["rate"] == "☆☆☆☆") echo "checked"; ?>><label for="rate-4">⭐️4</label>
                    <input type="radio" id="rate-5" name="rate" value="☆☆☆☆☆" <?php if ($row["rate"] == "☆☆☆☆☆") echo "checked"; ?>><label for="rate-5">⭐️5</label>
                </label><br>
                <label>感想<textArea name="impression" rows="4" cols="40" required><?= $row["impression"] ?></textArea></label><br>
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <input type="submit" value="送信" onclick="send()">
            </fieldset>
            <a href="./select.php">結果を見る</a>
        </div>
    </form>
    <!-- Main[End] -->
</body>

</html>