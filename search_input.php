<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>データ検索</title>
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

    <!-- <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="">データ検索</a></div>
      </div>
    </nav> -->
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <!-- <p><a href="index.php">TOP</a></p>
  <p><a href="input.php">データ登録</a></p>
  <p><a href="select.php">データ一覧</a></p> -->
  <form method="post" action="search.php">
    <div class="jumbotron">
      <fieldset>
        <legend>検索</legend>
        <label>投稿者：<input type="text" name="s_name"></label><br>
        <label>飲食店：<input type="text" name="s_r_name"></label><br>
        <label>ジャンル：
          <input type="checkbox" id="genre-wa" name="s_r_kinds[]" value="和食"><label for="genre-wa">和食</label>
          <input type="checkbox" id="genre-chu" name="s_r_kinds[]" value="中華"><label for="genre-chu">中華</label>
          <input type="checkbox" id="genre-you" name="s_r_kinds[]" value="洋食"><label for="genre-you">洋食</label>
          <input type="checkbox" id="genre-other" name="s_r_kinds[]" value="その他"><label for="genre-other">その他</label>
        </label><br>
        <label>訪問：<input type="date" name="s_visit_date"></label><br>
        <label>評価：
          <input type="checkbox" id="rate-1" name="s_rates[]" value="☆"><label for="rate-1">⭐️1</label>
          <input type="checkbox" id="rate-2" name="s_rates[]" value="☆☆"><label for="rate-2">⭐️2</label>
          <input type="checkbox" id="rate-3" name="s_rates[]" value="☆☆☆"><label for="rate-3">⭐️3</label>
          <input type="checkbox" id="rate-4" name="s_rates[]" value="☆☆☆☆"><label for="rate-4">⭐️4</label>
          <input type="checkbox" id="rate-5" name="s_rates[]" value="☆☆☆☆☆"><label for="rate-5">⭐️5</label>
        </label><br>
        <input type="submit" value="検索">
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->
</body>

</html>