<?php
  session_start();

  if($_SESSION['id'] !== 'ADMIN')
  {
    echo "<script>
            alert('접근 권한이 없습니다. \\n로그인 후 이용해주세요.');
            location.href = './login.php';
          </script>";
  }
?>
<!DOCTYPE html>
<html data-wf-page="62beab96af52b777021279f0" data-wf-site="62bd59b32b15ac506983c3f2">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <meta content="Admin" property="og:title">
  <meta content="Admin" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">

  <!-- Bootstrap CSS -->
  <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
  
  <!-- LOCAL CSS -->
  <link href="../css/normalize.css" rel="stylesheet" type="text/css">
  <link href="../css/basic.css" rel="stylesheet" type="text/css">
  <link href="../css/style.css" rel="stylesheet" type="text/css">
  
  <!-- Scripts -->
  <script src="https://use.typekit.net/rbu6rhq.js" type="text/javascript"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  
  <!-- SUB JS -->
  <script src="library/jquery.min.js"></script>
  <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
  <script src="library/moment.min.js"></script>
  <script src="library/Chart.bundle.min.js"></script>
  <script src="library/jquery.dataTables.min.js"></script>
  <script src="library/dataTables.bootstrap5.min.js"></script>
</head>
<body class="body">
  <div class="adminheader">
    <div class="_95percent">
      <div class="div-block-13">
        <a href="./admin.php" aria-current="page" class="w-inline-block w--current"><img src="../img/logo.svg" loading="lazy" alt="" class="image-2"></a>
        <div class="div-block-7">
          <div class="text-block-2">안녕하세요,</div>
          <div class="div-block-28">
            <div class="text-block-4">
              <?php 
                echo $_SESSION['place_name']."님";
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
  <div class="section-3 wf-section">
    <div data-easing="ease" data-duration-in="300" data-duration-out="100" class="tabs w-tabs">
      <div class="navbar w-tab-menu">
        <a href="./admin.php" class="div-block-24 w-inline-block"><img src="../img/icon_tomato_2.svg" loading="lazy" alt="" class="image-4">
          <div class="text-block-19">접속 통계</div>
        </a>
        <a href="./account.php" class="div-block-24 w-inline-block w--current"><img src="../img/icon_tomato_1.svg" loading="lazy" alt="" class="image-4">
          <div class="text-block-19">계정 관리</div>
        </a>
        <a href="./reservation.php" class="div-block-24 w-inline-block"><img src="../img/icon_tomato_3.svg" loading="lazy" alt="" class="image-4">
          <div class="text-block-19">예약 관리</div>
        </a>
      </div>
      <div class="tabs-content w-tab-content">
        <div class="tab-pane-tab-1 w-tab-pane w--tab-active">
          <div class="title-area">
            <?php 
                echo 
                '
                <div class="container-fluid d-flex h-90 mt-3">
                    <div class="data_area container">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col col-sm-9">계정 관리</div>
                                    <div class="download">
                                    <a class="button-3" href="./mypage.php">내 정보 수정</a>
                                    <a class="button-2 w-button" href="./server/account_csv.php" style="margin-left: 10px;">CSV 다운로드</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                  <table class="table table-striped table-bordered" id="order_table">
                                    <thead>
                                      <tr>
                                        <th style="max-width: 150px;">순번</th>
                                        <th style="max-width: 200px;">ID</th>
                                        <th>지역</th>
                                        <th>지점명</th>
                                        <th>연락처</th>
                                        <th>정보수정</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/index.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  <script>
    $(document).ready(function(){
        fetch_data();

        function fetch_data()
        {
            var dataTable = $('#order_table').DataTable({
                "language": {
                    "emptyTable": "데이터가 없습니다.",
                    "lengthMenu": "_MENU_",
                    "info": "현재 _START_ - _END_ / _TOTAL_건",
                    "infoEmpty": "데이터 없음",
                    "infoFiltered": "( _MAX_건의 데이터에서 필터링됨 )",
                    "search": "검색: ",
                    "zeroRecords": "일치하는 데이터가 없어요.",
                    "loadingRecords": "로딩중...",
                    "processing":     "잠시만 기다려 주세요...",
                    "paginate": {
                        "next": "<img class='arrow_img' src='../img/rightarrow1_black.svg' />",
                        "previous": "<img class='arrow_img' src='../img/leftarrow1_black.svg' />"
                    }
                },
                // INFO 노출 X
                "info" : false,
                "processing" : false,
                "serverSide" : true,
                "order" : [],
                "ajax" : {
                    url:"./server/data_account.php",
                    type:"POST",
                    data:{action:'fetch'}
                },

            });
        }
    });
  </script>
</body>
</html>