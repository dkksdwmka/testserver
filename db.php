<?php
    ini_set('display_errors', '1');

    $conn_sql = mysqli_connect("localhost", "admin", "q1w2e3r4!!", "zeiss", "3308") or die("연결 실패");

    // <?php echo의 축약어는 <?= 이다.
    $serverName = "localhost:3308";
    $username = "admin";
    $password = "q1w2e3r4!!";

    try
    {
        $conn = new PDO("mysql:host=$serverName; dbname=zeiss", $username, $password);
        // PDO 오류 모드를 예외로 설정한다
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "PDO 연결 실패" . $e->getMessage();
    }

    function errMsg($msg){
        echo "
        <script>
            window.alert('$msg');
            history.back(1);
        </script>";
        exit;
    }

    function success($msg){
        echo "
        <script>
            window.alert('$msg');
        </script>";
        exit;
    }

?>