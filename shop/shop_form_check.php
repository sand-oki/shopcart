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

  $onamae = $post['onamae'];
  $email = $post['email'];
  $tel = $post['tel'];

  $okflg = true;

  if ($onamae == '') {
    print 'お名前が入力されていません。<br><br>';
    $okflg = false;
  } else {
    print 'お名前 <br>';
    print $onamae;
    print '<br><br>';
  }

  if (preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$email)==0) {
    print 'メールアドレスを正確に入力してください。<br><br>';
    $okflg = false;
  } else {
    print 'メールアドレス <br>';
    print $email;
    print '<br><br>';
  }

  if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0) {
    print '電話番号を正確に入力してください。<br><br>';
    $okflg = false;
  } else {
    print '電話番号 <br>';
    print $tel;
    print '<br><br>';
  }

  if ($okflg == ture) {
    print '<form method="post" action="shop_form_done.php">';
    print '<input type="hidden" name="onamae" value="'.$onamae.'">';
    print '<input type="hidden" name="email" value="'.$email.'">';
    print '<input type="hidden" name="address" value="'.$tel.'">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK"><br>';
    print '</form>';

  } else {
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';

  }

?>

  </body>
</html>
