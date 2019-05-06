<?php
  session_start();
  session_regenerate_id(true);
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

  require_once('../common/common.php');

  $post = sanitize($_POST);

  $onamae = $post['onamae'];
  $email = $post['email'];
  $tel = $post['tel'];

  print $onamae.'様 <br>';
  print 'ご注文ありがとうございました。 <br>';
  print $email.'にメールをお送りしましたのでご確認ください。 <br>';

  $honbun = '';
  $honbun .= $onamae." 様\n\nこの度はご注文ありがとうございました。\n";
  $honbun .= "\n";
  $honbun .= "ご注文商品 \n";
  $honbun .= "-----------------\n";

  $cart = $_SESSION['cart'];

  $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT name,price FROM mst_product WHERE code=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $cart[0];
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  $name = $rec['name'];
  $price = $rec['price'];

  $honbun .= $name.' ';
  $honbun .= $price. "円 \n\n\n";

  $sql = 'INSERT INTO dat_sales (code_member,name,email,tel) VALUES (?,?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data = array();
  $data[] = 0;
  $data[] = $onamae;
  $data[] = $email;
  $data[] = $tel;
  $stmt->execute($data);

  $sql = 'SELECT LAST_INSERT_ID()';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $lastcode = $rec['LAST_INSERT_ID()'];

  $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price) VALUES (?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data = array();
  $data[] = $lastcode;
  $data[] = $cart[0];
  $data[] = $price;
  $stmt->execute($data);

  $dbh = null;

  $honbun .= "************************************\n";
  $honbun .= "有限会社〇〇〇〇\n";
  $honbun .= "\n";
  $honbun .= "沖縄県那覇市\n";
  $honbun .= "TEL:098-000-0000\n";
  $honbun .= "mail:okicoro@gmail.com\n";
  $honbun .= "************************************\n";

  // print '<br>';
  // print nl2br($honbun);

} catch (Exception $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}


    ?>

  </body>
</html>
