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

      require_once('../common/common.php');

      $post = sanitize($_POST);

      try {
        $pro_name = $post['name'];
        $pro_price = $post['price'];

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO mst_product(name,price) VALUES (?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $stmt->execute($data);

        $dbh = null;

        print $pro_name;
        print 'を追加しました。<br>';
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>

    <a href="pro_list.php"> 戻る </a>

  </body>
</html>
