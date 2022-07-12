<?php
  session_start();

  if(isset($_POST['id']))
  {
    $id = $_POST['id'] ;
    $place_name = $_POST['place_name'] ;
    $phonenum = $_POST['phonenum'] ;
    $location = $_POST['location'] ;
  }


  if(!isset($_SESSION['id']))
  {
    echo "<script>
            alert('접근 권한이 없습니다. \\n로그인 후 이용해주세요.');
            location.href = './login.php';
          </script>";
  }
?>
<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Wed Jul 06 2022 05:33:54 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="62c24621261b69f15b2d3f52" data-wf-site="62bd59b32b15ac506983c3f2">
<head>
  <meta charset="utf-8">
  <title>계정관리 랜딩</title>
  <meta content="계정관리 랜딩" property="og:title">
  <meta content="계정관리 랜딩" property="twitter:title">
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
  <div class="adminheader">
    <div class="_95percent">
      <div class="div-block-13">
        <a href="./admin.php" class="w-inline-block"><img src="../img/logo.svg" loading="lazy" alt="" class="image-2"></a>
        <div class="div-block-7">
          <div class="text-block-2">안녕하세요,</div>
          <div class="div-block-28">
            <div class="text-block-4">
              <?php 
                // ADMIN은 기본으로 그 외는 (안경원) 추가
                  if($_SESSION['place_name'] == 'ADMIN')
                  {
                    echo $_SESSION['place_name']."님";
                  }else
                  {
                    echo $_SESSION['place_name']."안경원님";
                    echo "<a href='./mypage.php' class='button-3'>정보수정</a>";
                  }
                ?>
            </div>
          </div>
        </div>
      </div>
      <div class="div-block-13">
        <a href="./server/member.php?mode=logout" class="button w-button">로그아웃</a>
      </div>
    </div>
  </div>
  <?php 
    if(!isset($_POST['id']))
    {
      echo 
      '
        <div class="section-3 wf-section">
        <div data-current="Tab 2" data-easing="ease" data-duration-in="300" data-duration-out="100" class="tabs w-tabs">
          <div class="navbar w-tab-menu">
            <a href="./admin.php" class="div-block-24 w-inline-block w--current"><img src="../img/icon_tomato_2.svg" loading="lazy" alt="" class="image-4">
              <div class="text-block-19">접속 통계</div>
            </a>
            <a href="./account.php" class="div-block-24 w-inline-block"><img src="../img/icon_tomato_1.svg" loading="lazy" alt="" class="image-4">
              <div class="text-block-19">계정 관리</div>
            </a>
            <a href="./reservation.php" class="div-block-24 w-inline-block"><img src="../img/icon_tomato_3.svg" loading="lazy" alt="" class="image-4">
              <div class="text-block-19">예약 관리</div>
            </a>
          </div>
          <div class="tabs-content w-tab-content">
            <div data-w-tab="Tab 1" class="tab-pane-tab-1 w-tab-pane"></div>
            <div data-w-tab="Tab 2" id="idpw" class="tab-pane-tab-2 w-tab-pane w--tab-active">
              <div class="title-area">
                <div class="div-block-33">
                  <div class="text-block-15">계정 관리</div>
                </div>
                <div class="w-form">
                  <form action="./server/member.php?mode=mypage" id="email-form" name="email-form" data-name="Email Form" method="post">
                    <div class="div-block-38">
                      <div class="text-block-22">아이디</div>
                      <input type="hidden" class="text-field-2 w-input" maxlength="256" name="userid" value="'. $_SESSION['id'].'" readonly />
                      <div class="text-block-23">'.$_SESSION['id'].'</div>
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">비밀번호</div>
                      <input type="password" class="text-field-2 w-input" maxlength="256" name="userpass" placeholder="변경할 비밀번호를 입력해주세요">
                      <input type="submit" class="button-2-copy w-button" value="변경">
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">지점명</div>
                      <div class="text-block-23">'.$_SESSION['place_name'].'</div>
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">전화번호</div>
                      <div class="text-block-23">'.$_SESSION['phonenum'].'</div>
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">주소</div>
                      <div class="text-block-23">'.$_SESSION['location'].'</div>
                    </div>
                  </form>
                  <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                  </div>
                  <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                  </div>
                </div>
              </div>
            </div>
            <div data-w-tab="Tab 3" class="tab-pane-tab-3 w-tab-pane"></div>
          </div>
        </div>
      </div>
      ';
    }else
    {
      echo 
      '
        <div class="section-3 wf-section">
        <div data-current="Tab 2" data-easing="ease" data-duration-in="300" data-duration-out="100" class="tabs w-tabs">
          <div class="navbar w-tab-menu">
            <a href="./admin.php#Tab-1" class="div-block-24 w-inline-block"><img src="../img/icon_tomato_2.svg" loading="lazy" alt="" class="image-4">
              <div class="text-block-19">접속 통계</div>
            </a>
            <a data-w-tab="Tab 2" class="div-block-24 w-inline-block w-tab-link w--current"><img src="../img/icon_tomato_1.svg" loading="lazy" alt="" class="image-4">
              <div class="text-block-19">계정 관리</div>
            </a>
            <a href="./admin.php#Tab-3" class="div-block-24 w-inline-block"><img src="../img/icon_tomato_3.svg" loading="lazy" alt="" class="image-4">
              <div class="text-block-19">예약 관리</div>
            </a>
          </div>
          <div class="tabs-content w-tab-content">
            <div data-w-tab="Tab 1" class="tab-pane-tab-1 w-tab-pane"></div>
            <div data-w-tab="Tab 2" id="idpw" class="tab-pane-tab-2 w-tab-pane w--tab-active">
              <div class="title-area">
                <div class="div-block-33">
                  <div class="text-block-15">계정 관리</div>
                </div>
                <div class="w-form">
                  <form action="./server/member.php?mode=mypage" id="email-form" name="email-form" data-name="Email Form" method="post">
                    <div class="div-block-38">
                      <div class="text-block-22">아이디</div>
                      <input type="hidden" class="text-field-2 w-input" maxlength="256" name="userid" value="'.$id.'" readonly />
                      <div class="text-block-23">'.$id.'</div>
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">비밀번호</div>
                      <input type="password" class="text-field-2 w-input" maxlength="256" name="userpass" placeholder="변경할 비밀번호를 입력해주세요">
                      <input type="submit" class="button-2-copy w-button" value="변경">
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">지점명</div>
                      <div class="text-block-23">'.$place_name.'</div>
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">전화번호</div>
                      <div class="text-block-23">'.$phonenum.'</div>
                    </div>
                    <div class="div-block-38">
                      <div class="text-block-22">주소</div>
                      <div class="text-block-23">'.$location.'</div>
                    </div>
                  </form>
                  <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                  </div>
                  <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                  </div>
                </div>
              </div>
            </div>
            <div data-w-tab="Tab 3" class="tab-pane-tab-3 w-tab-pane"></div>
          </div>
        </div>
      </div>
      ';
    }
  ?>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=62bd59b32b15ac506983c3f2" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="../js/index.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>