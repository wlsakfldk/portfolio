<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>프로그램 상세 페이지</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/product.css">
</head>
<body>
	<header>
		<?php include "./header.php" ?>
	</header>

<?php
	//http://localhost/website/product_view.php?num=3
	$num = $_GET["num"];

	include "./db_con.php";
	$sql = "select * from products where num='$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$title = $row["title"];
	$sub = $row["sub"];
	$content = $row["content"];
	$price = number_format($row["price"]);
	$file_copied = "./data/".$row["file_copied"];
	$fav = $row["fav"];
	$hit = $row["hit"];

	$new_hit = $hit + 1;
	$sql = "update products set hit='$new_hit' where num='$num'";
	mysqli_query($con, $sql);
?>

	<section>
		<div id="product_box">
			<div id="product_detail">
				<div class="pd_view" style="background-image:url(<?=$file_copied?>);"></div>
				<div class="pd_txt">
					<h3 class="pd_title"><?=$title?></h3>
					<h4 class="pd_sub_title"><?=$sub?></h4>
					<p class="pd_content"><?=$content?></p>
					<div class="pd_etc">
						<div class="pd_price"><span><?=$price?></span>원/H</div>
						<div class="pd_fav" rel="<?=$num?>"><a href="">좋아요 <span><?=$fav?></span></a></div>
					</div>
					<!--rel="<?=$num?>"의 의미 : 현재 페이지가 어떤 페이지로 표현되는 가를 인지하게끔 만들어주는 하나의 도구-->

				</div>
			</div>
		</div>
	</section>
	<footer>
		<?php include "./footer.php"; ?>
	</footer>	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/product_view.js"></script>

</body>
</html>