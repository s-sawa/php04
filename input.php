<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>データ登録</title>
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
    <?php include("menu.php"); ?>
  </header>
  <form method="post" action="insert.php" enctype="multipart/form-data">
    <div class="jumbotron">
      <fieldset>
        <legend>食べログ</legend>
        <label>投稿者：<input type="text" name="name" value="<?= $_SESSION["name"] ?>" required></label><br>
        <label>飲食店：<input type="text" name="r_name" required></label><br>
        <label>URL(任意)：<input type="text" name="r_url"></label><br>
        <label>ジャンル：
          <input type="radio" id="genre-wa" name="r_kind" value="和食" checked><label for="genre-wa">和食</label>
          <input type="radio" id="genre-chu" name="r_kind" value="中華"><label for="genre-chu">中華</label>
          <input type="radio" id="genre-you" name="r_kind" value="洋食"><label for="genre-you">洋食</label>
          <input type="radio" id="genre-other" name="r_kind" value="その他"><label for="genre-other">その他</label>
        </label><br>
        <label>訪問：<input type="date" name="visit_date" required></label><br>
        <!-- <label>訪問：<input type="text" name="visit_date" required></label><br> -->
        <label>評価：
          <input type="radio" id="rate-1" name="rate" value="☆" checked><label for="rate-1">⭐️1</label>
          <input type="radio" id="rate-2" name="rate" value="☆☆"><label for="rate-2">⭐️2</label>
          <input type="radio" id="rate-3" name="rate" value="☆☆☆"><label for="rate-3">⭐️3</label>
          <input type="radio" id="rate-4" name="rate" value="☆☆☆☆"><label for="rate-4">⭐️4</label>
          <input type="radio" id="rate-5" name="rate" value="☆☆☆☆☆"><label for="rate-5">⭐️5</label>
        </label><br>
        <label>感想<textArea name="impression" rows="4" cols="40" required></textArea></label><br>
        <input type="file" name="upload_image"><br>
        <input type="submit" value="送信">
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->
</body>
</html>