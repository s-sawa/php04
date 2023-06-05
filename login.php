<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <!-- <link rel="stylesheet" href="css/main.css" /> -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
  <title>ログイン</title>
</head>

<body>
  <!-- <h2 class="heading-016">CSS見出しデザイン</h2> -->
  <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
  <!-- 見えないようにPOSTで送る -->
  <div class="w-full max-w-xs mx-auto flex items-center h-screen">
    <form class="bg-white shadow-md rounded px-8 " name="form1" action="login_act.php" method="post">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
          ID
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="lid" placeholder="ID" />
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="lpw" placeholder="PASSWORD" />
        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="LOGIN" />
        <a href="./user.php">Signup</a>
      </div>
    </form>
  </div>


</body>

</html>