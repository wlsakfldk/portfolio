<?php
	//product_fav.php?num=3
	$num = $_GET["num"];

	include "./db_con.php";
	$sql = "select * from products where num='$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$fav = $row["fav"];

	$new_fav = $fav + 1;
	$sql = "update products set fav='$new_fav' where num='$num'";
	mysqli_query($con, $sql);
?>
<?=$new_fav?>
<!--최종 결과값만을 문서에 남긴다.-->
