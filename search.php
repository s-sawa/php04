<?php
//s_r_rateとs_r_kindはチェックした数だけ配列で取得
$s_name = $_POST['s_name'] ?? '';
$s_r_name = $_POST['s_r_name'] ?? '';
$s_r_kinds = $_POST['s_r_kinds'] ?? [];
$s_visit_date = $_POST['s_visit_date'] ?? '';
$s_rates = $_POST['s_rates'] ?? [];

// 0:投稿者、飲食店、訪問の入力なし
$flag = 0;

if (!empty($s_name) || !empty($s_r_name) || !empty($s_r_kinds) || !empty($s_visit_date) || !empty($s_rates)) {
  $sql = "SELECT * FROM my_tabelog2 WHERE";
  //投稿者検索
  if (!empty($s_name)) {
    $search_words[] = ' name = "' . $s_name . '"';
    $flag = 1;
  }
  //お店検索
  if (!empty($s_r_name)) {
    $search_words[] = ' r_name = "' . $s_r_name . '"';
    $flag = 1;
  }
  //訪問日検索
  if (!empty($s_visit_date)) {
    $search_words[] = ' visit_date = "' . $s_visit_date . '"';
    $flag = 1;
  }
  if ($flag == 1) {
    $sql .= implode(' AND ', $search_words);
  }
  //お店ジャンル検索
  if (!empty($s_r_kinds)) {
    // ジャンル単体検索の場合
    if ($flag == 0) {
      $flag = 1;
      if (count($s_r_kinds) == 1) {
        $sql .= ' r_kind = "' . $s_r_kinds[0] . '"';
      } else if (count($s_r_kinds) > 1) {
        $i = 0;
        while ($i < count($s_r_kinds)) {
          $search_words_kinds[] = ' r_kind = "' . $s_r_kinds[$i] . '"';
          $i++;
        }
        $sql .= "(";
        $sql .= implode(' OR ', $search_words_kinds);
        $sql .= ")";
      }
      //他の要素と組み合わせ検索の場合
    } else if ($flag == 1) {
      $flag = 1;
      if (count($s_r_kinds) == 1) {
        echo "aaaa";
        $sql .= " AND ";
        $sql .= ' r_kind = "' . $s_r_kinds[0] . '"';
      } else if (count($s_r_kinds) > 1) {
        $i = 0;
        while ($i < count($s_r_kinds)) {
          $search_words_kinds[] = ' r_kind = "' . $s_r_kinds[$i] . '"';
          $i++;
        }
        $sql .= " AND ";
        $sql .= "(";
        $sql .= implode(' OR ', $search_words_kinds);
        $sql .= ")";
      }
    }
  }
  //お店評価検索
  if (!empty($s_rates)) {
    // ジャンル単体検索の場合
    if ($flag == 0) {
      $flag = 1;
      if (count($s_rates) == 1) {
        $sql .= ' rate = "' . $s_rates[0] . '"';
      } else if (count($s_rates) > 1) {
        $i = 0;
        while ($i < count($s_rates)) {
          $search_words_rates[] = ' rate = "' . $s_rates[$i] . '"';
          $i++;
        }
        $sql .= implode(' OR ', $search_words_rates);
      }
      //他の要素と組み合わせ検索の場合
    } else if ($flag == 1) {
      $flag = 1;
      if (count($s_rates) == 1) {
        $sql .= " AND ";
        $sql .= ' rate = "' . $s_rates[0] . '"';
      } else if (count($s_rates) > 1) {
        $i = 0;
        while ($i < count($s_rates)) {
          $search_words_rates[] = ' rate = "' . $s_rates[$i] . '"';
          $i++;
        }
        $sql .= " AND ";
        $sql .= "(";
        $sql .= implode(' OR ', $search_words_rates);
        $sql .= ")";
      }
    }
  }
}

//rateのみ検索
if (!empty($s_rates)) {
  // $sql .= ' AND ';
  // $sql .= '(';
  $rateCondition = [];
  foreach ($s_rates as $s_rate) {
    $rateCondition[] = ' rate = "' . $s_rate . '"';
  }
  $rateCondition = implode(' OR ', $rateCondition);
  // $sql .= $rateCondition .')';
  // $rateCondition = ')';
}

require_once 'funcs.php';
/** @var PDO $pdo */
$pdo = db_conn();
// $sql .= $rateCondition;
// if (!empty($s_r_kinds)) {
//   $sql .= $kindCondition;
// }
echo $sql;
// $sql = "SELECT * FROM my_tabelog WHERE rate = :s_rate;";
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':s_rate', $s_rate, PDO::PARAM_STR);
$status = $stmt->execute(); //実行が成功したか失敗したか true or false
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
echo "<br/>";
echo "検索結果:";
echo (count($values) . "件");
foreach ($values as $v) { ?>
  <div>
    <p><a href="u_view.php?id=<?= $v['id']; ?>"><?= h($v["r_name"]) ?></a> <a href="<?= h($v["r_url"]) ?>" <?php if ($v["r_url"] == "") echo "hidden"; ?>>お店のページへ</a></p>
    <p>ジャンル：<?= h($v["r_kind"])  ?></p>
    <p>評価：<?= h($v["rate"])  ?></p>
    <p>訪問:<?= h($v["visit_date"])  ?></p>
    <p>投稿者:<?= h($v["name"])  ?></p>
    <p>投稿日時:<?= h($v["indate"])  ?></p>
    <p>感想：<?= h($v["impression"])  ?></p>
    <img src="./img/deletebtn.svg" alt="" onclick='getId(<?= $v["id"] ?>)' width="25px">
  </div>
  <div>
  </div>
  <hr>
<?php } ?>