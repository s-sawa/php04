<?php
session_start();
include "funcs.php";
sschk();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>TOP</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        .box {
            margin: 10px;
            padding: 20px;
            font-size: 18px;
            background-color: cornflowerblue;
            border-radius: 10px;
            width: 150px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class=container>
        <h2 class="heading-016">Hello! <?php echo $_SESSION["name"]; ?>さん!</h2>
        <div class="box box-text"><a href="input.php">データ登録</a></div>
        <div class="box"><a href="select.php">データ一覧</a></div>
        <div class="box"><a href="search_input.php">検索</a></div>
        <?php if ($_SESSION["kanri_flg"] == 1) { ?>
            <div class="box"><a href="user.php">ユーザー登録</a></div>
            <div class="box"><a href="user_list.php">ユーザー一覧</a></div>
        <?php } ?>
        <div class="box"><a href="logout.php">ログアウト</a></div>
    </div>
    <!-- <div><a href=""></a></div> -->
</body>

</html>