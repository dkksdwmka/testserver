<?php
    header( "Content-type: application/vnd.ms-excel;charset=UTF-8");
    header( "Expires: 0" );
    header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
    header( "Pragma: public" );
    header( "Content-Disposition: attachment; filename=reservation".date('Ymd').".xls" );

    include('../../db.php'); //TODO require_once 디렉토리 변경 필요

    $sql = $conn -> prepare( "
                            select num, username, location, phonenum, birthday, sex, reservation_date, visit_bool, goods, design, lens, refractive
                            from user_info order by num ASC
                            " );
    $sql -> execute();
    // 테이블 상단 만들기
    $EXCEL_STR = "
        <h1> 계정 관리 </h1>
        <table border='1'>
            <tr>
                <td>Num</td>
                <td>예약자명</td>
                <td>안경원명</td>
                <td>휴대폰번호</td>
                <td>생년월일</td>
                <td>성별</td>
                <td>예약일자</td>
                <td>방문여부</td>
                <td>상품</td>
                <td>주문 디자인</td>
                <td>주문 렌즈 종류</td>
                <td>주문 굴절률</td>
            </tr>";
    //위에 talbe은 자신이 가져올 값들의 컬럼 명이 되겠다.
    while($row = $sql -> fetch()) {
       $EXCEL_STR .= "
            <tr>
                <td>".$row['num']."</td>
                <td>".$row['username']."</td>
                <td>".$row['location']."</td>
                <td>".$row['phonenum']."</td>
                <td>".$row['birthday']."</td>
                <td>".$row['sex']."</td>
                <td>".$row['reservation_date']."</td>
                <td>".$row['visit_bool']."</td>
                <td>".$row['goods']."</td>
                <td>".$row['design']."</td> 
                <td>".$row['lens']."</td> 
                <td>".$row['refractive']."</td> 
            </tr>
       ";
    }

    $EXCEL_STR .= "</table>";
    echo $EXCEL_STR;
?>