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
  <link href="library/daterangepicker.css" rel="stylesheet" />
  
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
  <script src="library/daterangepicker.min.js"></script>
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
        <div>
          <div class="title-area">
            <?php 
                echo 
                '
                <div class="container-fluid d-flex h-90 mt-3">
                    <div class="data_area container">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col col-sm-9">예약 현황</div>
                                    <div class="col col-sm-3">
                                        <input type="text" id="daterange_textbox" class="form-control" readonly />
                                        <a class="button-2 w-button" href="./server/reservation_csv.php" style="margin-left: 10px;">CSV 다운로드</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="order_table">
                                  <thead>
                                    <tr>
                                      <th style="min-width:60px;">예약자</th>
                                      <th>지점명</th>
                                      <th>예약일자</th>
                                      <th>방문일자</th>
                                      <th>연락처</th>
                                      <th>상품</th>
                                      <th style="max-width: 500px;">렌즈</th>
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

        var referer_chart;

        $('#btn_remove').click(function(){
            $('form').submit();
        })

        function fetch_data(start_date = '', end_date = '')
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
                // SEARCH FORM 노출 X
                "searching" : false,
                // INFO 노출 X
                "info" : false,
                "processing" : false,
                "serverSide" : true,
                "order" : [],
                "ajax" : {
                    url:"./server/data_reservation.php",
                    type:"POST",
                    data:{action:'fetch', start_date:start_date, end_date:end_date}
                },
                "drawCallback" : function(settings)
                {
                    var referer_date = [];
                    var referer = [];

                    for(var count = 0; count < settings.aoData.length; count++)
                    {
                        referer_date.push(settings.aoData[count]._aData[1]);
                        referer.push(parseFloat(settings.aoData[count]._aData[3]));
                    }

                    var chart_data = {
                        labels:referer_date,
                        datasets:[
                            {
                                label : '총 방문자',
                                backgroundColor : 'rgb(255, 205, 86)',
                                color : '#fff',
                                data:referer
                            }
                        ],

                    };

                    var group_chart3 = $('#bar_chart');

                    if(referer_chart)
                    {
                        referer_chart.destroy();
                    }

                    referer_chart = new Chart(group_chart3, {
                        type:'bar',
                        data:chart_data
                    });
                }
            });
        }

        $('#daterange_textbox').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            ranges:{
                '오늘' : [moment(), moment()],
                '어제' : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '일주일 전' : [moment().subtract(6, 'days'), moment()],
                '30일 전' : [moment().subtract(29, 'days'), moment()],
                '이번 달' : [moment().startOf('month'), moment().endOf('month')],
                '저번 달' : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            },
            format : 'YY-MM-DD'
        }, function(start, end){

            $('#order_table').DataTable().destroy();
            fetch_data(start.format('YY-MM-DD'), end.format('YY-MM-DD'));
        });
        
        // 사용자 지정
        $('.ranges ul li:last-child').text('사용자 지정');
    });
  </script>
</body>
</html>