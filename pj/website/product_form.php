<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>프로그램 등록</title>
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
				<h2 id="product_title">프로그램 > 등록하기</h2>
				<form name="product_form" action="product_insert.php" method="post" enctype="multipart/form-data">
					<ul id="product_form">
						<li>
								<div class="label">
									<label for="">이름 : </label>
								</div>
								<div class="input">
									<p><?=$userid?></p>
								</div>
						</li>
						<li>
								<div class="label">
									<label for="title">제목 : </label>
								</div>
								<div class="input">
									<input type="text" name="title">
								</div>
						</li>
						<li>
								<div class="label">
									<label for="sub">부제 : </label>
								</div>
								<div class="input">
									<input type="text" name="sub">
								</div>
						</li>
						<li>
								<div class="label">
									<label for="content">상세내용 : </label>
								</div>
								<div class="input">
									<textarea name="content"></textarea>
								</div>
						</li>
						<li>
								<div class="label">
									<label for="price">가격(원/1H) : </label>
								</div>
								<div class="input">
									<input type="text" name="price">
								</div>
						</li>
						<li>
								<div class="label">
									<label for="upfile">대표 이미지 : </label>
								</div>
								<div class="input">
									<input type="file" class="upload" name="upfile">
								</div>
						</li>
					</ul>
					<ul class="buttons">
						<li><button type="button" onclick="check_input();">등록하기</button></li>
						<li><button type="button" onclick="location.href='./product_list.php'">목록보기</button></li>
					</ul>
				</form>
			</div>
	</section>

	<footer>
			<?php include "./footer.php"; ?>
	</footer>

	<script src="./js/product.js"></script>
</body>
</html>