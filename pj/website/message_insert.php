<?php
//http://localhost/website/message_insert.php?send_id=abc
	$send_id = $_GET["send_id"];

	$rv_id = $_POST["rv_id"];
	$subject = str_replace("'", "&#39;", $_POST["subject"]);
	$content = str_replace("'", "&#39;", $_POST["content"]);
	$regist_day = date("Y-m-d (H:i)");

	include "./db_con.php";

	//#1. members라는 테이블로 접근하여 받는 사람 입력값(아이디)이 현재 회원으로 등록되어 있는가를 확인
	$sql = "select * from members where id='$rv_id'";
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);
	//$num_record = 1이면 받는 사람 아이디가 존재한다는 경우(true)
	//$num_record = 0이면 받는 사람 아이디가 존재하지 않는 경우(false)
	if($num_record){   //받는 사람이 존재할 경우
		
		$sql_m = "insert into message (send_id, rv_id, subject, content, regist_day) values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		mysqli_query($con, $sql_m);
		//values('$send_id', '$rv_id', '$subject', '$content', '$regist_day') -> 문자형 데이터를 지칭,  숫자형 values(10000)

	}else{   //받는 사람이 존재하지 않는 경우
		echo ("
			<script>
				alert('현재 입력한 회원은 존재하지 않습니다. 확인 후 입력 바랍니다.');
				history.go(-1);
			</script>
		");
		exit;
	}
	mysqli_close($con);

	//추후 수정파트!!!!  메시지 목록 페이지(작성한 리스트)로 이동
	echo ("
		<script>
			location.href = 'message_box.php?mode=send';
		</script>
	");


?>

