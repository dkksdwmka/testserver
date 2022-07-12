<?php

//action.php

# PDO를 이용한 mysql 데이터베이스 연동
$connect = new PDO("mysql:host=localhost:3308;dbname=zeiss", "admin", "q1w2e3r4!!");

# action 포스트가 전달을 받았을 때,
if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		# 쿼리문 입력
		$order_column = array('num', 'username', 'location', 'reservation_date', 'visit_date', 'phonenum', 'visit_bool', 'goods', 'design', 'lens', 'refractive');
		$main_query = "
						SELECT num, username, location, reservation_date, visit_date, phonenum, visit_bool, goods, design, lens, refractive from user_info
					";
		$search_query = 'WHERE reservation_date <= "'.date('Y-m-d').'" AND ';

		# 날짜 세팅
		if(isset($_POST["start_date"], $_POST["end_date"]) && $_POST["start_date"] != '' && $_POST["end_date"] != '')
		{
			$search_query .= 'reservation_date >= "'.$_POST["start_date"].'" AND reservation_date <= "'.$_POST["end_date"].'" AND ';
		}

		# input[search]에 값이 들어왔을 때, 아래 쿼리문 진행
		if(isset($_POST["search"]["value"]))
		{
			$search_query .= '
								(num LIKE "%'.$_POST["search"]["value"].'%" 
								OR username LIKE "%'.$_POST["search"]["value"].'%" 
								OR location LIKE "%'.$_POST["search"]["value"].'%" 
								OR reservation_date LIKE "%'.$_POST["search"]["value"].'%" 
								OR phonenum LIKE "%'.$_POST["search"]["value"].'%" 
								OR visit_bool LIKE "%'.$_POST["search"]["value"].'%" 
								OR goods LIKE "%'.$_POST["search"]["value"].'%")';
		}

		# order by 쿼리문
		$order_by_query = "";

		# order by 쿼리문 입력(필터)
		if(isset($_POST["order"]))
		{
			$order_by_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_by_query = 'ORDER BY num DESC ';
		}

		# 출력되는 row 개수 지정
		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		# 위에 입력한 쿼리문 작동 대기 및 실행
			# row 개수 출력 // 필터링 적용 // array로 변환
		# 쿼리문 1 실행
		$statement = $connect->prepare($main_query . $search_query . $order_by_query);
		$statement->execute();
		$filtered_rows = $statement->rowCount();

		# 쿼리문 2 실행
		$statement = $connect->prepare($main_query);
		$statement->execute();
		$total_rows = $statement->rowCount();

		# 쿼리문 3 실행
		# ToDo == count 실행문

		# result 쿼리문 실행
		$result = $connect->query($main_query . $search_query . $order_by_query . $limit_query, PDO::FETCH_ASSOC);
		$data = array();

		# 위에서 array로 변환한 데이터 변수 선언
		foreach($result as $row)
		{
			$input = "
						<form action='./server/member.php?mode=change_product' method='POST' style='display:flex;'>
							<select class='select_lens' name='design'>
								<option value='".$row['design']."' selected hidden>".$row['design']."</option>
								<option value='스마트라이프'>스마트라이프</option>
								<option value='스마트라이프 프로'>스마트라이프 프로</option>
							</select>
							<select class='select_lens' name='lens'>
								<option value='".$row['lens']."' selected hidden>".$row['lens']."</option>
								<option value='스마트라이프 디지털'>스마트라이프 디지털</option>
								<option value='스마트라이프 디지털 인디비주얼'>스마트라이프 디지털 인디비주얼</option>
								<option value='스마트라이프 누진 인디비주얼'>스마트라이프 누진 인디비주얼</option>
								<option value='스마트라이프 누진 플러스'>스마트라이프 누진 플러스</option>
								<option value='스마트라이프 누진 퓨어'>스마트라이프 누진 퓨어</option>
								<option value='스마트라이프 누진 슈퍼브'>스마트라이프 누진 슈퍼브</option>
								<option value='스마트라이프 단초점'>스마트라이프 단초점</option>
								<option value='스마트라이프 단초점 인디비주얼'>스마트라이프 단초점 인디비주얼</option>
							</select>
							<select class='select_lens' name='refractive'>
								<option value='".$row['refractive']."' selected hidden>".$row['refractive']."</option>
								<option value='1.5'>1.5</option>
								<option value='1.6'>1.6</option>
								<option value='1.67'>1.67</option>
								<option value='1.74'>1.74</option>
							</select>
							<input type='hidden' name='num' value=".$row['num']." />
							<input type='submit' class='button-3' value='저장' />
						</form>
					";
			$sub_array = array();
			$sub_array[] = $row['username'];
			$sub_array[] = $row['location'];
			$sub_array[] = $row['reservation_date'];
			$sub_array[] = $row['visit_date'];
			$sub_array[] = $row['phonenum'];
			$sub_array[] = $row['goods'];
			$sub_array[] = $input;
			$data[] = $sub_array;
		}

		# ajax로 전달
		$output = array(
			"draw"			=>	intval($_POST["draw"]),
			"recordsTotal"	=>	$total_rows,
			"recordsFiltered" => $filtered_rows,
			"data"			=>	$data
		);

		# 변수 선언한 데이터 값 출력
		echo json_encode($output);
	}
}

?>