<?php
    header( "Content-type: application/vnd.ms-excel;charset=UTF-8");
    header( "Expires: 0" );
    header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
    header( "Pragma: public" );
    header( "Content-Disposition: attachment; filename=account".date('Ymd').".xls" );

    include('../../db.php'); //TODO require_once 디렉토리 변경 필요

    $sql = $conn -> prepare( "
                            select num, prenum, id, place_name, vc_before, vc_now, partnership_date, partnership, ipp, 
                            location, sido, gugun, phonenum, socialmedia, socialmedia2, socialmedia3
                            from admin order by num ASC
                            " );
    $sql -> execute();
    // 테이블 상단 만들기
    $EXCEL_STR = "
        <h1> 계정 관리 </h1>
        <table border='1'>
            <tr>
                <td>Num</td>
                <td>PreNum</td>
                <td>안경원명</td>
                <td>안경원 주소</td>
                <td>이전 담당</td>
                <td>담당 VC</td>
                <td>자이스 파트너십 조인 시기</td>
                <td>파트너십</td>
                <td>i.PP 보유</td>
                <td>안경원 주소</td>
                <td>지역</td>
                <td>구</td>
                <td>전화번호</td>
                <td>소셜미디어</td>
                <td>소셜미디어2</td>
                <td>소셜미디어3</td>
            </tr>";
    //위에 talbe은 자신이 가져올 값들의 컬럼 명이 되겠다.
    while($row = $sql -> fetch()) {
       $EXCEL_STR .= "
            <tr>
                <td>".$row['num']."</td>
                <td>".$row['prenum']."</td>
                <td>".$row['id']."</td>
                <td>".$row['place_name']."</td>
                <td>".$row['vc_before']."</td>
                <td>".$row['vc_now']."</td>
                <td>".$row['partnership_date']."</td>
                <td>".$row['partnership']."</td>
                <td>".$row['ipp']."</td>
                <td>".$row['location']."</td> 
                <td>".$row['sido']."</td> 
                <td>".$row['gugun']."</td> 
                <td>".$row['phonenum']."</td> 
                <td>".$row['socialmedia']."</td> 
                <td>".$row['socialmedia2']."</td> 
                <td>".$row['socialmedia3']."</td> 
            </tr>
       ";
    }

    $EXCEL_STR .= "</table>";
    echo $EXCEL_STR;
?>