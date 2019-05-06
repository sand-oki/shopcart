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

    商品追加<br>
    <br>
    <form action="pro_add_check.php" method="post">
      商品名を入力してください。<br>
      <input type="text" name="name" style="width:200px"><br>
      価格を入力してください。<br>
      <input type="text" name="price" style="width:50px"><br>
      <br>
      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="OK">
    </form>
  </body>
</html>