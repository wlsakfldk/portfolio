<?php
	//http://localhost/website/board_delete.php?num=13&page=1
	$num = $_GET["num"];
	$page = $_GET["page"];

	include "./db_con.php";

	//만약 게시글을 삭제할 경우, 첨부파일도 삭제처리
	$sql="select * from board where num='$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	//data라는 디렉토리에 실제로 저장된 파일명을 지칭 -> 삭제
	$copied_name = $row["file_copied"];  //2020_12_11_17_52_50.jpg
	if($copied_name){
		$file_path = "./data/".$copied_name;   //경로까지 연결한 파일명
		unlink($file_path);  //unlink(경로까지 포함된 변수명) : 서버에 위치한 파일을 삭제처리
	}

	//본인이 보고 있던 게시글을 삭제(DB에 저장된 문자 또는 숫자 데이터를 삭제)
	$sql2 = "delete from board where num='$num'";
	mysqli_query($con, $sql2);
	mysqli_close($con);

	echo ("
		<script>
			location.href = 'board_list.php?page=$page';
		</script>
	");

?>