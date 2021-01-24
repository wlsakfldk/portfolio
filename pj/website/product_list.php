<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>프로그램 리스트</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/product.css">
</head>
<body>
	<header>
		<?php include "./header.php" ?>
	</header>
	<section>
			<div id="main_img_bar" class="subpage">
					<div class="main_img_cont">
							<div class="frame">
									<div class="main_img_txt">
											<div class="main_img_title">
													<h3>100% Free <span>Online Courses</span></h3>
													<h1>Get Future's Skills Today!</h1>
											</div>
									</div>
							</div>
					</div>
			</div>

			<div id="product_box">
				<h2 id="product_title">프로그램 > 리스트</h2>
				<ul id="product_list">
<?php
	include "./db_con.php";
	$sql = "select * from products order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);

	for($i=0; $i<$total_record; $i++){
		mysqli_data_seek($result, $i);
		$row = mysqli_fetch_array($result);
		$num = $row["num"];
		$title = $row["title"];
		$sub = $row["sub"];
		$content = $row["content"];
		$price = number_format($row["price"]);
		$fav = $row["fav"];
		$file_copied = "./data/".$row["file_copied"];
?>
					<li onclick="location.href='product_view.php?num=<?=$num?>'">
						<div class="pd_img">
							<img src="<?=$file_copied?>" alt="<?=$title?>">
						</div>
						<h3 class="pd_title"><?=$title?></h3>
						<p class="pd_sub"><?=$sub?></p>
						<div class="pd_info">
							<div class="pd_price"><span><?=$price?></span>원</div>
							<div class="pd_fav">좋아요&nbsp;<span><?=$fav?></span></div>
						</div>
					</li>
<?php
	}
?>
				</ul>
<?php
	//로그인 한 상태이며 (레벨값이 6 미만인 경우)
	if($userid){
//		if($userlevel < 6){
?>
				<ul class="buttons">
					<li><button type="button" onclick="location.href='./product_form.php'">등록하기</button></li>
				</ul>
<?php
//		}
	}
?>
			</div>
	</section>

	<footer>
			<?php include "./footer.php"; ?>
	</footer>			
</body>
</html>