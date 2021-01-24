<?php
	//http://localhost/website/admin_member_delete.php?num=9
	$num = $_GET["num"];  //회원의 고유번호

	include "./db_con.php";

	$sql = "delete from members where num='$num'";
	mysqli_query($con, $sql);
	mysqli_close($con);
	echo ("
		<script>
			location.href='./admin.php';
		</script>
	");
?>