<?php
    require_once('/xampp/htdocs/zeiss/db.php'); //TODO require_once 디렉토리 변경 필요
    session_start();
    

    switch($_GET['mode'])
    {
        // 로그인 PHP
        case 'login':
            include_once('./password.php');
            
            $adminid = $_POST['adminid'];
            $adminpw = $_POST['adminpw'];

            $sql = $conn -> prepare('select * from admin where id = :adminid');
            $sql -> bindParam(':adminid', $adminid);
            $sql -> execute();
            $row = $sql -> fetch();

            if(!$adminid)
            {
                errMsg("아이디를 입력해주세요.");
            }elseif(!isset($row['id']))
            {
                errMsg("존재하지 않는 아이디입니다.");
            }elseif(!$adminpw)
            {
                errMsg("비밀번호를 입력해주세요.");
            }elseif(!password_verify($adminpw, $row['pass']))
            {
                errMsg("비밀번호가 일치하지 않습니다.");
            }

            $_SESSION['id'] = $row['id'];
            $_SESSION['place_name'] = $row['place_name'];
            $_SESSION['phonenum'] = $row['phonenum'];
            $_SESSION['location'] = $row['location'];
            
        header('location: ../admin.php');
        break;

        // 로그아웃
        case 'logout':
            session_unset();
            header('location: ../login.php');
        break;

        // 비밀번호 변경
        case 'mypage':
            
            $userid = $_POST['userid'];
            $pass = $_POST['userpass'];
            $userpass = password_hash($pass, PASSWORD_DEFAULT);

            $sql = $conn -> prepare('update admin set pass = :userpass where id = :userid');
            $sql -> bindParam(":userid", $userid);
            $sql -> bindParam(":userpass", $userpass);
            $sql -> execute();

            
            echo "
                <script>
                    alert('비밀번호가 변경되었습니다.\\n다시 로그인을 해주세요. ');
                    location.href='../login.php';
                </script>";
            session_unset();
        break;

        case 'check':

            include_once('./password.php');

            $adminid = $_POST['adminid'];
            
            $sql = $conn -> prepare('select * from admin where id = :adminid');
            $sql -> bindParam(':adminid', $adminid);
            $sql -> execute();
            $row = $sql -> fetch();

            if(!$adminid)
            {
                errMsg("지점 암호를 입력해주세요.");
            }elseif(!isset($row['id']))
            {
                errMsg("암호가 일치하지 않습니다.");
            }
            
            $_SESSION['sido'] = $row['sido'];
            $_SESSION['gugun'] = $row['gugun'];
            $_SESSION['place_name'] = $row['place_name'];

        header('location: ./index.php');
        break;

        // 삭제
        case 'remove':
            $pk = $_POST['pk'];

            $sql = $conn -> prepare('delete from admin where num = :num');
            $sql -> bindParam(':num', $pk);
            $sql -> execute();

        // header('location: ./index.php');
        break;

        case 'change_product' :
        
            $num = $_POST['num'];
            $design = $_POST['design'];
            $lens = $_POST['lens'];
            $refractive = $_POST['refractive'];

            $sql = $conn -> prepare('update user_info set design = :design, lens = :lens, refractive = :refractive where num = :num');
            $sql -> bindParam(':num', $num);
            $sql -> bindParam(':design', $design);
            $sql -> bindParam(':lens', $lens);
            $sql -> bindParam(':refractive', $refractive);
            $sql-> execute();
        
        echo "
        <script>
            alert('성공적으로 수정되었습니다.. ');
            location.href='../reservation.php';
        </script>";
        
        break;
    };
?>