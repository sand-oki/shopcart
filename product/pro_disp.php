<?php
  session_start();
  session_regenerate_id(true);
  if (isset($_SESSION['login']) == false) {
    print 'ログインされていません。<br>';
    print '<a href="../staff_login/staff_login.html"> ログイン画面へ </a>';
    exit();
  } else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br>';
    print '<br>';
  }
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>旅行サイト例</title>
  </head>
  <body>
    <?php

      try {

        $pro_code = $_GET['procode'];

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name,price FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];

        $dbh = null;

      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
      }

    ?>

    商品情報参照<br>
    <br>
    商品コード<br>
    <?php print $pro_code; ?>
    <br>
    商品名<br>
    <?php print $pro_name; ?>
    <br>
    価格<br>
    <?php print $pro_price; ?> 円
    <br>
    <br>
    <form>
      <input type="button" onclick="history.back()" value="戻る">
    </form>

  </body>
</html>
