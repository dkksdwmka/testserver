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
		$order_column = array('num', 'id', 'place_name', 'phonenum', 'sido', 'location');
		$main_query = "
						SELECT num, id, place_name, phonenum, sido, location from admin
					";
		$search_query = 'where ';

		# input[search]에 값이 들어왔을 때, 아래 쿼리문 진행
		if(isset($_POST["search"]["value"]))
		{
			$search_query .= '(id LIKE "%'.$_POST["search"]["value"].'%" OR place_name LIKE "%'.$_POST["search"]["value"].'%" OR phonenum LIKE "%'.$_POST["search"]["value"].'%" OR sido LIKE "%'.$_POST["search"]["value"].'%")';
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
			$order_by_query = 'ORDER BY num ASC ';
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
						<form action='./mypage.php' method='POST'>
							<input type='hidden' name='id' value='".$row['id']."' readonly />
							<input type='hidden' name='place_name' value='".$row['place_name']."' readonly />
							<input type='hidden' name='phonenum' value='".$row['phonenum']."' readonly />
							<input type='hidden' name='location' value='".$row['location']."' readonly />
							<input type='submit' class='button-3' value='상세보기' />
						</form>
					";

			$sub_array = array();
			$sub_array[] = $row['num'];
			$sub_array[] = $row['id'];
			$sub_array[] = $row['sido'];
			$sub_array[] = $row['place_name'];
			$sub_array[] = $row['phonenum'];
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