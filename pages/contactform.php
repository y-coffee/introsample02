<?php
session_start();
$mode = 'input';
$errmessage = array();
file_put_contents("./testlog.log",print_r($_POST,true));
if( isset($_POST['back']) && $_POST['back'] ){
	// 何もしない
} else if( isset($_POST['confirm']) && $_POST['confirm'] ){
	// 確認画面
	if( !$_POST['fullname'] ) {
		$errmessage[] = "名前を入力してください";
	} else if( mb_strlen($_POST['fullname']) > 100 ){
		$errmessage[] = "名前は100文字以内にしてください";
	}
	$_SESSION['fullname']	= htmlspecialchars($_POST['fullname'], ENT_QUOTES);

	if( !$_POST['email'] ) {
		$errmessage[] = "Eメールを入力してください";
	} else if( mb_strlen($_POST['email']) > 200 ){
		$errmessage[] = "Eメールは200文字以内にしてください";
	} else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
		$errmessage[] = "メールアドレスではありません";
	}
	$_SESSION['email']	= htmlspecialchars($_POST['email'], ENT_QUOTES);

	if( !$_POST['message'] ){
		$errmessage[] = "お問い合わせ内容を入力してください";
	} else if( mb_strlen($_POST['message']) > 500 ){
		$errmessage[] = "お問い合わせ内容は500文字以内にしてください";
	}
	$_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

	if( $errmessage ){
		$mode = 'input';
	} else {
	  $token = bin2hex(random_bytes(32));                                   
	  $_SESSION['token']  = $token;
		$mode = 'confirm';
	}
} else if( isset($_POST['send']) && $_POST['send'] ){
	// 送信ボタンを押したとき
  if( !$_POST['token'] || !$_SESSION['token'] || !$_SESSION['email'] ){
	  $errmessage[] = '不正な処理が行われました';
	  $_SESSION     = array();
	  $mode         = 'input';
  } else if( $_POST['token'] != $_SESSION['token'] ){
    $errmessage[] = '不正な処理が行われました';
    $_SESSION     = array();
    $mode         = 'input';
  } else {
	  $message = "お問い合わせを受け付けました \r\n"
	             . "名前: " . $_SESSION['fullname'] . "\r\n"
	             . "email: " . $_SESSION['email'] . "\r\n"
	             . "お問い合わせ内容:\r\n"
	             . preg_replace( "/\r\n|\r|\n/", "\r\n", $_SESSION['message'] );
	  mail( $_SESSION['email'], 'お問い合わせありがとうございます', $message );
	  mail( 'kesagatame007@yahoo.co.jp', '以下のお問い合わせを受けました。', $message );
	  $_SESSION = array();
	  $mode     = 'send';
  }
} else {
	$_SESSION['fullname'] = "";
	$_SESSION['email']    = "";
	$_SESSION['message']  = "";
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link href="../css/style.css" rel="stylesheet" media="screen and (max-width:480px)">
  <link href="../css/style.css" rel="stylesheet" media="screen and (min-width:480px) and (max-width:896px)">
  <script src="https://kit.fontawesome.com/e724bfc0f5.js" crossorigin="anonymous"></script>
  <script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <style>

    #contact.wrapper {
        height: 100%;
    }
    
    
    #contact-top{
        /*height: 100%;*/
        background-color: rgba(211,203,221,0.7);
    }
    
    .alert-box {
      padding-top: 100px;
      margin-bottom: -100px;
    
    }
    
    .alert {
        width: 80%;
        margin: 0 auto;
    }
    
    .form-box{
        width: 80%;
        padding-top: 120px;
        padding-bottom: 120px;
        margin: 0 auto;
        margin-top: 0px;
 
        height: 100vh;
 
        
    }
    .form-box-check{
        width: 80%;
        margin: 0 auto;
        padding-top: 100px;
   
 
        
    }
    
    .btn-box{
        margin-top: 0px;
        text-align: center;
        padding-bottom: 30px;
    }
    
    .btn {
        width: 25%;
    }
    
    
    
    .confirm-box {
        padding-top: 50px;
 
    }
    
    .confirm-list {
        background-color: #ffffff;
        padding-top: 20px;
        margin-bottom: 30px;
        border-radius: 10px;
        box-shadow: 0px 10px 10px 0 rgba(0, 0, 0, 0.5);

    }
    
    .confirm-list p {
        margin-left: 20px;
        margin-right: 20px;
        color: #000000;
        margin-bottom: 20px;
    }
    
    .submit-done {
        /*color: #ffffff;*/
        font-weight: bold;
        font-size: 30px;
        text-align: center;
        margin-top: 150px;
    }
    
    .pc-global-nav  {
        margin-top: -17px;
    }
    .pc-global-nav h2 {
        font-weight: bold;
        line-height: 2;

    }
    
    
            .contact-content {
            height: 250px;
            overflow: scroll;
        }

    
    
    @media screen and (max-width: 480px) {
        #contact-top {
            height: 100%;
        }
        
        #contact.wrapper {
            height: 100%;
        }
        
        
        .form-box {
            padding-top: 170px;
            height: 100%;
            padding-bottom: 100px;
        }
        
        .form-box-check {
            font-size: 3vw;
            padding-top: 120px;
            width: 80%;
            margin: 0 auto;
            height: 100vh;
            padding-bottom: 600px;

        }
        
        .contact-content {
            height: 200px;
            overflow: scroll;
        }

        
        .confirm-list {
            height: 100%;
        }
        
        .alert-box {
            margin-bottom: -150px;
            padding-top: 100px;
        }
        
        .form-param {
            font-size: 3vw;
        }
        .alert {
            font-size: 2.5vw;
        }
        
        .btn {
            font-size: 3vw;
        }
    }
    
    
    .submit-done {
        font-size: 4vw;
        padding-bottom: 140px;
    }
    
    
    
    
    @media screen and (min-width:480px) and (max-width:896px) {

        #contact-top{
            height: 100%;
        }

        .form-box {
            padding-top: 250px;
            padding-bottom: -400px;
        }
        
        .form-box-check {
            padding-top: 100px;
            width: 80%;
            margin: 0 auto;
        }
        
        .confirm-box {
            padding-top: 100px;
            margin-bottom: -200px;
        }
        
        .form-box form {
            font-size: 2.5vw;
        }
        
        .alert-box {
            margin-bottom: -170px;
            padding-top: 200px;
        }
        
        .contact-content {
            height: 500px;
        
    }
    
    
    
  </style>

<title>Contact</title>
<link rel="icon" href="../images/favicon.ico">
</head>
<body>
  <div class="wrapper" id="contact">
    <header class="header-works">
      <!-- 隠れh1開始 -->
      <h1 class="hidden-h1">週末フォトグラファーSHOTS|TOP</h1>
      <div class="clearfix"></div>
      <!-- 隠れh1終了 -->
      <!-- PC開始 -->
      <nav class="pc-global-nav">
        <ul>
          <li><h2><a href="../index.html">TOP</a></h2></li>
          <li><h2><a href="works.html">Works</a></h2></li>
          <li><h2><a href="about.html">About</a></h2></li>
        </ul>  
      </nav>
      <!-- PC終了 -->
      <!-- スマホ開始 -->
      <span class="humberger" id="humberger">
        <span class="fa-layers fa-fw">
          <i class="fa fa-square fa-inverse" aria-hidden="true" data-fa-transform="up-3px"></i>
          <i class="fa fa-bars" data-fa-transform="shrink-5 up-3px"></i>
        </span>
      </span>
      <!-- スマホ終了 -->
    </header>
    <div class="menu" id="menu">
      <nav>
        <ul>
          <li><a href="../index.html">TOP</a></li>
          <li><a href="works.html">Works</a></li>
          <li><a href="about.html">About</a></li>
        </ul>
      </nav>
    </div>



    <div id="contact-top">
      <?php if( $mode == 'input' ) { ?>

        <!-- 入力画面のコード -->
        <!-- 入力エラーがあった場合 -->
        <?php
          if( $errmessage ) {
            echo '<div class="alert-box">';
            echo '<div class="alert alert-danger" role="alert">';
            echo implode('<br>', $errmessage);
            echo '</div>';
            echo '</div>';
          }
        ?>

        <!-- 入力エラーがなかった場合 -->
        <div class="form-box">
        <form class="form-param" action="./contactform.php" method="post">
          お名前<input class="form-control" type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>"><br>
          Eメール<input class="form-control" type="email" name="email" value="<?php echo $_SESSION['email'] ?>"><br>
          お問合せ内容<br>
          <textarea class="form-control" name="message" cols="40" rows="8" value="<?php echo $_SESSION['message'] ?>"></textarea><br>
          <div class="btn-box">
          <input class="btn btn-dark btn-lg" type="submit" name="confirm" value="確認" />
          </div>
        </form>
        </div>

      <?php } else if( $mode == 'confirm' ) { ?>
        <!-- 確認画面のコード -->
        <div class="form-box-check">
        <form action="./contactform.php" method="post" class="confirm-box">
          <div class="confirm-list">
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
              <p>お名前: <?php echo $_SESSION['fullname'] ?></p><br>
              <p>Eメール: <?php echo $_SESSION['email'] ?></p><br>
              <div class="contact-content">
              <p>お問合せ内容: <br>
              <?php echo nl2br($_SESSION['message']) ?></p><br>
          </div>
          </div>
          <div class="btn-box">
          <input class="btn btn-dark btn-lg" type="submit" name="back" value="戻る">
          <input class="btn btn-dark btn-lg" type="submit" name="send" value="送信">
          </div>
        </div>
        </form>
        

      <?php } else { ?>
        <!-- 完了画面のコード -->
        <div class="form-box">
        　　<p class="submit-done">送信致しました。お問合せありがとうございました。<br>
        　　TOPページなどにお戻りください。
        　　</p>
        </div>
      <?php } ?>



        </div>

    </div>
  
  
    <footer class="footer-works">
      <p>(C)2020 Smash Create</p>
    </footer>
  </div>
  <script src="../js/humberger.js"></script>
  <script src="../js/slide.js"></script>
</body>
