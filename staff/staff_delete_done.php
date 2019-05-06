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
        $staff_code = $_POST['code'];

        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        $sql = 'DELETE FROM mst_staff WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);

        $dbh = null;

      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>

    削除しました。<br>
    <br>

    <a href="staff_list.php"> 戻る </a>

  </body>
</html>
