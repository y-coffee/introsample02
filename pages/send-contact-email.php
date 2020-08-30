<?php

// フォーム上のPOSTパラメータを受け取る
$guest_name = $_POST['guest_name'];
$guest_email = $_POST['guest_email'];
$mail_subject = $_POST['mail_subject'];
$mail_body = $_POST['mail_body'];

$is_validated = true;
if(! filter_var( $guest_email, FILTER_VALIDATE_EMAIL )) {
  // 不正メールアドレス
  $is_validated = false;
}

if( empty($mail_subject) || empty($mail_body) ) {
  // 件名もしくは本文なし
  // エラー
  $is_validated = false;
}

// サイト管理者に問合せメールを送る
$result = mb_send_mail(
  'admin@example.com', $email_subject, $email_body,
  'Form: '.mb_encode_mimeheader($guest_name).'<'.$guest_email.'>'

);
?>


<?php if( $is_validated && $result ): ?>
  <p>お問合せを受け付けました。ありがとうございます。</p>

<?php else: ?>
  <p>内容に不備があります。再度、確かめてください。</p>
  <a href="#" onclick="history.back();">送信フォームへ戻る</a>
<?php endif ?>




<!-- セキュリティ対策用コード -->
<?php
  $recaptcha_response = $_POST['recaptcha_response'];
  $recaptcha_secret = '6Le_lrIZAAAAAJVpgLg8Zpins89cyO8tyjvcSJOQ';
  
  $recaptch_url = 'https://www.google.com/recaptcha/api/siteverify?secret=';
  $recaptcha = file_get_contents( 
    $recaptch_url.$recaptcha_secret. '&response='.$recaptcha_response
  );
  $recaptcha = json_decode($recaptcha);
  
  print_r('$recaptcha->score : '.var_export($recaptcha->score,true));
  if ($recaptcha->score >= 0.5) {
    // reCAPTCHA合格
  } else {
    // reCAPTCH不合格。ボットの可能性があるので、送信しない
  }

?>