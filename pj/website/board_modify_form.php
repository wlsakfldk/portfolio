<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>게시판 수정하기</title>
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/board.css">
</head>
<body>
	<header>
		<?php include "./header.php"?>
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

			<div id="board_box">
				<h2 id="board_title">게시판 > 수정</h2>
				<!--
						데이터를 전송하는 방식(method)에는 get 방식과 post 방식 + enctype 속성의 multipart/form-data
						get 방식은 URL 창에 폼의 데이터가 노출되는 방식. 입력내용에 대한 길이 제한이 존재 (256~4096byte 데이터를 전송 가능)
						post 방식은 URL 창에 폼의 데이터가 노출되지 않는 방식. 입력내용에 대한 길이 제한은 없음. 보낼 수있는 데이터의 양은 한계가 반드시 존재. 이를 보완하고자 큰 용량의 파일이나 데이터 전송간 문제점이 발생하지 않도록 폼 태그 내부에 enctype="multipart/form-data" 추가하면 문제점이 발생하지 않음. (이미지 파일은 1x1 Pixel 4byte의 데이터 값을 갖고 있음.  4byte/pixel)
				-->
<?php
	//http://localhost/website/board_modify_form.php?num=3&page=1
	$num = $_GET["num"];
	$page = $_GET["page"];

	include "./db_con.php";

	$sql = "select * from board where num = '$num'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	
	$name = $row["name"];
	$subject = $row["subject"];
	$content = $row["content"];
	$file_name = $row["file_name"];
?>				

				<form name="board_form" action="board_modify.php?num=<?=$num?>&page=<?=$page?>" method="post" enctype="multipart/form-data">
					<ul id="board_form">
						<li>
							<div class="label">
								<label>이름 : </label>
							</div>
							<div class="input">
								<p><?=$userid?></p> <!--session으로부터 받아온 $userid, $username, DB로부터 받아온 $name-->
							</div>
						</li>
						<li>
							<div class="label">
								<label for="subject">제목 : </label>
							</div>
							<div class="input">
								<input type="text" name="subject" value="<?=$subject?>">
							</div>
						</li>
						<li>
							<div class="label">
								<label for="content">내용 : </label>
							</div>
							<div class="input">
								<textarea name="content"><?=$content?></textarea>
							</div>
						</li>
						<li>
							<div class="label">
								<label for="upfile">첨부파일 : </label>
							</div>
							<div class="input">
								<p class="origin_file"><?=$file_name?></p>
								<!-- <input type="file" class="upload" name="upfile" value="<?=$file_name?>"> -->
								<!--type=file의 경우 value 값은 세팅이 불가능-->
							</div>
						</li>
					</ul>

					<ul class="buttons">
						<li><button type="button" onclick="check_input();">작성 완료</button></li>
						<li><button type="button" onclick="location.href='board_list.php?page=<?=$page?>'">목록 보기</button></li>
					</ul>
				</form>
			</div>

	</section>

	<footer>
			<?php include "./footer.php"; ?>
	</footer>	

	<script src="./js/board.js"></script>
</body>
</html>