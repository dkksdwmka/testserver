<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Wed Jul 06 2022 05:33:54 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="62beb1698195b41563e9f1d2" data-wf-site="62bd59b32b15ac506983c3f2">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="Login" property="og:title">
  <meta content="Login" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="../css/normalize.css" rel="stylesheet" type="text/css">
  <link href="../css/basic.css" rel="stylesheet" type="text/css">
  <link href="../css/style.css" rel="stylesheet" type="text/css">
  <script src="https://use.typekit.net/rbu6rhq.js" type="text/javascript"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="../img/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="../img/webclip.png" rel="apple-touch-icon">
</head>
<body>
  <div class="section-4 wf-section">
    <div class="div-block-30">
      <div class="div-block-32">
        <div class="div-block-31"><img src="../img/logo.svg" loading="lazy" alt="" class="image-6"></div>
        <div class="form-block w-form">
          <form action="./server/member.php?mode=login" id="email-form" name="email-form" method="post">
            <input type="text" class="text-field w-input" maxlength="256" name="adminid"  placeholder="ID" required="">
            <input type="password" class="text-field w-input" maxlength="256" name="adminpw" placeholder="Password" required="">
            <input type="submit" class="submit-button w-button" value="로그인"/>
          </form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
      <a href="index.html" class="link-4">이벤트 페이지 바로가기</a>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=62bd59b32b15ac506983c3f2" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="../js/index.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>