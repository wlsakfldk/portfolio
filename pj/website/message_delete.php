<?php
	//http://localhost/website/message_delete.php?mode=send&num=11
	$mode = $_GET["mode"];
	$num = $_GET["num"];

	include "./db_con.php";

	$sql = "delete from message where num='$num'";
	mysqli_query($con, $sql);
	mysqli_close($con);

	if($mode == "send"){  //삭제를 진행한 페이지 : 만약 [송신함 > 상세보기]에서 삭제를 진행했다면, 송신함 리스트로 이동
		$target_url = "message_box.php?mode=send";
	}else{  //삭제를 진행한 페이지 : 만약 [수신함 > 상세보기]에서 삭제를 진행했다면, 수신함 리스트로 이동
		$target_url = "message_box.php?mode=rv";
	}

	echo ("
		<script>
			location.href='$target_url';
		</script>
	");
	//'$target_url' : 단순 문자열을 가져오는 것이 아니기 때문에, php문구의 변수로부터 값을 가져와서 스크립트와 연동을 시키기 위해 작은 따옴표를 기입함

?>