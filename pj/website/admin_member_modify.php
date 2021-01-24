<?php
	//http://localhost/website/admin_member_modify.php?num=11
	$num = $_GET["num"];
	$level = $_POST["level"];
	$point = $_POST["point"];

	include "./db_con.php";

	//set 방식 : create, insert into, update, delete
	//get 방식 : select ~ from
	$sql = "update members set level='$level', point='$point' where num='$num'";
	mysqli_query($con, $sql);
	mysqli_close($con);

	echo ("
		<script>
			location.href='./admin.php';
		</script>
	");

?>