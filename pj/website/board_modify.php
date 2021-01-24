<?php
	//http://localhost/website/board_modify.php?num=3&page=1

	$num = $_GET["num"];  //board 라는 테이블에 저장된 고유번호
	$page = $_GET["page"];

	$subject = str_replace("'", "&#39;", $_POST["subject"]);
	$content = str_replace("'", "&#39;", $_POST["content"]);

	include "./db_con.php";

	$sql = "update board set subject='$subject', content='$content' where num='$num'";
	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("
		<script>
			location.href='board_list.php?page=$page';
		</script>
	");
?>